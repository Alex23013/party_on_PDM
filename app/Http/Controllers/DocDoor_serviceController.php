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
           $temp->d_service_name=$servicesB[$i];
           $i= $i+1;
        }
        $new = NULL;   
        return view('docdoor_services.d_services')->with(compact('services','new'));
    }

    public function complete($id)
    {
        $d_service = Dservice::find($id);
        $d_service->execution = date('Y-m-d H:i:s');
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
        return view('docdoor_services.new_d_service')->with(compact('services','partners')); 
    }

    public function store(Request $request){
        $rules = [
            'partner_id' => 'required',
            'service_id' => 'required',
            'dni' => 'required|size:8',
            'address_from'=>'required|max:40',
            'address_to'=>'required|max:40',
        ];

        $messages = [
            'partner_id.required' => 'Es necesario "seleccionar un asociado" para registrar una solicitud',
            'service_id.required' => 'Es necesario "seleccionar un servicio" para registrar una solicitud',

            'dni.required' => 'Es necesario ingresar un DNI para registrar una solicitud',
            'dni.size' => 'El DNI debe tener 8 digitos',

            'address_from.required' => 'Es necesario ingresar una "dirección de salida" para registrar una solicitud',
            'address_from.max' => 'Campo "Dirección de salida" es demasiado extenso.',

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
        unset($data['_token']);
        unset($data['dni']);
        foreach ($data as $key => $value) {
            $d_service->$key = $data[$key] ;
        }   
        $d_service->save();
        $services =  DB::table('dservices')
                    ->join('services','dservices.service_id','=','services.id')
                    ->join('users','dservices.user_id','=','users.id')
                    ->join('partners','dservices.partner_id','=','partners.id')
                    ->get();
        $new = $d_service;   
        return view('docdoor_services.d_services')->with(compact('services','new'));
    }

    public function update($id){
        $d_service = Dservice::find($id);
        return view('docdoor_services.d_service_edit')->with(compact('d_service'));
    }

    public function store_update(){
        
    }

    public function delete($id){
    	Dservice::destroy($id);
       	return redirect('/d_services');	
    }

}
