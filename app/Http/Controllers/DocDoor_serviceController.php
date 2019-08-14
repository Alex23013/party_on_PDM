<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Dservice;
use App\Http\Requests;

use App\User;
use App\Service;
use App\Partner;
use App\Partner_service;
use App\Patient;

use Auth;

class DocDoor_serviceController extends Controller
{
    public function ajax_get_partners(){
        $all_relations = Partner_service::where('service_id', $_POST['valor1'])->get();
        $partners =[];
        foreach ($all_relations as $key => $value) {
            $partner = Partner::find($value->partner_id);
            $partners[]=array(
                    "name" => $partner->partner_name,
                    "id" => $partner->id
                );   
        }
        return $partners;
    }


    public function get_partners($service_id){
        $all_relations = Partner_service::where('service_id',$service_id)->get();
        $partners =[];
        foreach ($all_relations as $key => $value) {
            $partner = Partner::find($value->partner_id);
            $partners[]=array(
                    "name" => $partner->partner_name,
                    "id" => $partner->id
                );   
        }
        return $partners;
    }

    public function index()
 	{
        $all_dservices = Dservice::all();
        $services = [];
        foreach ($all_dservices as $key => $value) {
            $patient_user = User::find($value->user_id);
            $service = Service::find($value->service_id);
            $partner = Partner::find($value->partner_id);

            $services[] = [
                'id'=>$value->id,
                'patient_name'=>$patient_user->name." ".$patient_user->last_name,
                'service_name'=>$service->service_name,
                'partner_name'=>$partner->partner_name,
                'address_from'=>$value->address_from,
                'address_to'=>$value->address_to,
                'payment_status'=>$value->payment_status,
                'complete'=>$value->complete,
                'token_pay'=>$value->token_pay,
                'cost'=> $value->cost,
                'created_at'=>$value->created_at
            ];
        }
        $new = NULL;   
        return view('docdoor_services.d_services')->with(compact('services','new'));
    }
    
    public function complete($id)
    {
        $d_service = Dservice::find($id);
        //dd($d_service );
        $d_service->complete = 1;
        $d_service->save();
        return redirect('/d_services');
    }
    
    public function detail($id){
        $data = Dservice::find($id);
        $user = User::find($data->user_id);
        $service = Service::find($data->service_id);
        $partner = Partner::find($data->partner_id);
        return view('docdoor_services.d_services_detail')  ->with(compact('data','user','service','partner')); 
    }

    public function add(){
        $all_services = Service::all();
        $services =[];
        foreach ($all_services as $key => $value) {
            $num_partners = count(Partner_service::where('service_id',$value->id)->get());
            if($num_partners>0){
                $services[]=$value;
            }
        }
        $u_patients = Patient::all();
            foreach ($u_patients as $patient) {
                $patients[] =array(
                            "name" => $patient->user->name,
                            "id" => $patient->user->id,
                        ); 
            }
        return view('docdoor_services.new_d_service')->with(compact('services','patients')); 
    }

    public function postAddDocDoorService(Request $request)
    {
        $rules1 = [
            'service_id' => 'required',
            'partner_id' => 'required',
            'service_id' => 'required',
            'patient_user_id' => 'required',
            'address_to'=>'required',
        ];

        $messages1 = [
            'service_id.required' => 'Es necesario "seleccionar un servicio" para registrar una solicitud',
            'partner_id.required' => 'Es necesario "seleccionar un asociado" para registrar una solicitud',
            'service_id.required' => 'Es necesario "seleccionar un servicio" para registrar una solicitud',

            'patient_user_id.required' => 'Es necesario ingresar un usuario receptor del servicio para registrar una solicitud',
            'address_to.required' => 'Es necesario ingresar una "dirección de llegada" para registrar una solicitud',
            'address_to.max' => 'Campo "Dirección de llegada" es demasiado extenso.',
        ];

        $this->validate($request, $rules1, $messages1);   
        $data = $request->all();
        $d_service = New Dservice;
        
        $d_service->user_id =$request->patient_user_id;     
        unset($data['_token']);
        unset($data['registrar']);
        unset($data['chosePartner']);
        unset($data['patient_user_id']);
        foreach ($data as $key => $value) {
            $d_service->$key = $data[$key] ;
        }   
        $partner = Partner::find($data['partner_id']);
        $d_service->address_from= $partner->address;
        $d_service->save();
        $new = $d_service; 
        $all_dservices = Dservice::all();
        $services = [];
        foreach ($all_dservices as $key => $value) {
            $patient_user = User::find($value->user_id);
            $service = Service::find($value->service_id);
            $partner = Partner::find($value->partner_id);

            $services[] = [
                'id'=>$value->id,
                'patient_name'=>$patient_user->name." ".$patient_user->last_name,
                'service_name'=>$service->service_name,
                'partner_name'=>$partner->partner_name,
                'address_from'=>$value->address_from,
                'address_to'=>$value->address_to,
                'payment_status'=>$value->payment_status,
                'complete'=>$value->complete,
                'token_pay'=>$value->token_pay,
                'cost'=> $value->cost,
                'created_at'=>$value->created_at
            ];
        }
        return view('docdoor_services.d_services')->with(compact('services','new'));
    }

    public function update($id){
        
        $d_service = Dservice::find($id);
        $partners = Partner::all();
        $partner_name = Partner::find($d_service->partner_id);
        $partner_name = $partner_name->partner_name;
        return view('docdoor_services.d_service_edit')->with(compact('d_service','partners','partner_name'));
    }

    public function store_update(Request $request){
        $d_service = Dservice::find($request->id);
        $data = $request->all();
        
        unset($data['_token']);
        unset($data['id']);
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
            if($d_service->$key != $data[$key] ){
                $d_service->$key=$data[$key];    
            }
           }
        }
        $d_service->save();
        return redirect('/d_services');
        
    }

    public function delete($id){
    	Dservice::destroy($id);
        if(Auth::user()->role == 3){
            return redirect('/patients/my_d_services'); 
        }
       	return redirect('/d_services');	
    }

}
