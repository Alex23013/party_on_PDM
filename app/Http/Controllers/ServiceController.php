<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Service;
use App\Partner_service;

class ServiceController extends Controller
{
    public function index()
 	{
        $all_services = Service::all();
        $services=[];
        foreach ($all_services as $key => $value) {
          $num_partners = count(Partner_service::where('service_id',$value->id)->get());
          $services[] = [
            'name' => $value->service_name,
            'id' => $value->id,
            'num_doctors'=> $num_partners,
          ];
        }
        $new = NULL;   
        return view('services.services_index')->with(compact('services','new'));
    }

    public function add($id_P){
    	return view('services.new_service')->with(compact('id_P'));
    }

    public function store(Request $request){
    	$rules = [
            'service_name' => 'required|min:2|max:255| unique:services',
        ];
        $messages = [
            'service_name.required' => 'Es necesario ingresar un nombre para registrar a un usuario',
            'service_name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
            'service_name.max' => 'Campo "Nombre" es demasiado extenso.'
            'service_name.unique'=>'Ya existe un servicio con este nombre-'
        ];

        $this->validate($request, $rules, $messages);   

        $new_service = New Service;
        $new_service->service_name = $request->service_name;
        $new_service->save();
        
        $all_services = Service::all();
        $services=[];
        foreach ($all_services as $key => $value) {
          $num_partners = count(Partner_service::where('service_id',$value->id)->get());
          $services[] = [
            'name' => $value->service_name,
            'id' => $value->id,
            'num_doctors'=> $num_partners,
          ];
        }
        $new = $new_service;   
        if($request->id_P == 0){
        	return view('services.services_index')->with(compact('services','new'));
        }else{
        	return redirect("/p_services/".$request->id_P."/add");
        }
     	
    }
    public function update($id){
		$esp = Service::find($id);    	
		return view('services.services_edit')->with(compact('esp'));
    }
    
    public function store_update(Request $request){
    	$esp = Service::find($request->id);
    	//dd($esp);
        $data = $request->all();
        //dd($data);
        unset($data['_token']);
        unset($data['id']);
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
            if($esp->$key != $data[$key] ){
                $esp->$key=$data[$key];    
            }
           }
        }
        $esp->save();
        return redirect('/services/');
    }

     public function delete($id)
    {
        Service::destroy($id);
        return redirect('/services');
    }
}
