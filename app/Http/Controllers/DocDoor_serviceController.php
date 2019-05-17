<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Dservice;
use App\Http\Requests;

use App\User;
use App\Service;
use App\Partner;

class DocDoor_serviceController extends Controller
{
    public function index()
 	{
        //TODO: optimizar esto
        $services =  DB::table('dservices')
                    ->join('partners','dservices.partner_id','=','partners.id')
                    ->join('users','dservices.user_id','=','users.id')
                    ->join('services','dservices.service_id','=','services.id') 
                    ->get();
        $servicesB =  DB::table('dservices')
                    ->join('partners','dservices.partner_id','=','partners.id')
                    ->join('users','dservices.user_id','=','users.id')
                    ->join('services','dservices.service_id','=','services.id') 
                    ->pluck('dservices.id');
        $i = 0;
        foreach ($services as $temp) {
           $temp->d_service_id=$servicesB[$i];
           $i= $i+1;
        }
        //dd($services);
        $new = NULL;   
        return view('docdoor_services.d_services')->with(compact('services','new'));
    }
    
    public function complete($id)
    {
        $d_service = Dservice::find($id);
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
        $services = Service::all();
        $partners = Partner::all();
        $one = NULL;
        return view('docdoor_services.new_d_service')->with(compact('services','partners','one')); 
    }

    public function postAddDocDoorService(Request $request)
    {
        //check which submit was clicked on
        if($request->chosePartner)
        {
            $partners = Service::find($request->service_id)->partners;
            $one = 1;
            $services = Service::find($request->service_id);
            return view('docdoor_services.new_d_service')->with(compact('services','partners','one')); 
        } 
        elseif($request->registrar) 
        {
            $this->store($request);
        }
    }

    public function partnerByServices(Request $request){
        //$data = $request->all();
        //dd($data);
        $partners = Service::find($request->service_id)->partners;
        //dd($partners);
        $services = Service::find($request->service_id);
        return view('docdoor_services.new_d_service')->with(compact('services','partners'));
    }

    public function store(Request $request){
        $rules = [
            'partner_id' => 'required',
            'service_id' => 'required',
            'dni' => 'required|size:8',
            'address_to'=>'required|max:40',
        ];

        $messages = [
            'partner_id.required' => 'Es necesario "seleccionar un asociado" para registrar una solicitud',
            'service_id.required' => 'Es necesario "seleccionar un servicio" para registrar una solicitud',

            'dni.required' => 'Es necesario ingresar un DNI para registrar una solicitud',
            'dni.size' => 'El DNI debe tener 8 digitos',

            'address_to.required' => 'Es necesario ingresar una "dirección de llegada" para registrar una solicitud',
            'address_to.max' => 'Campo "Dirección de llegada" es demasiado extenso.',
        ];

        $this->validate($request, $rules, $messages);   

        $d_service = New Dservice;
        $id = DB::table('users')
                 ->where('dni', $request->dni)
                 ->pluck('id');
        $id = $id[0];  
        $d_service->user_id = $id;
        
        $data = $request->all();
        //dd($data);
        unset($data['_token']);
        unset($data['dni']);
        foreach ($data as $key => $value) {
            $d_service->$key = $data[$key] ;
        }   
        $partner = Partner::find($data['partner_id']);
        $d_service->address_from= $partner->address;
        $d_service->save();
        $services =  DB::table('dservices')
                    ->join('services','dservices.service_id','=','services.id')
                    ->join('users','dservices.user_id','=','users.id')
                    ->join('partners','dservices.partner_id','=','partners.id')
                    ->get();
        $new = $d_service; 
        $servicesB =  DB::table('dservices')
                    ->join('partners','dservices.partner_id','=','partners.id')
                    ->join('users','dservices.user_id','=','users.id')
                    ->join('services','dservices.service_id','=','services.id') 
                    ->pluck('dservices.id');
        $i = 0;
        foreach ($services as $temp) {
           $temp->d_service_name=$servicesB[$i];
           $i= $i+1;
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
       	return redirect('/d_services');	
    }

}
