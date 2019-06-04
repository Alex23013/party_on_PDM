<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Partner;
use App\Service;
use App\Partner_service;
use App\Http\Requests;

class Partner_serviceController extends Controller
{
    public function toCapital(){
        $s1 = Service::where('service_name', 'delivery')->first();
        if($s1){
            $s1->service_name = "Delivery";
            $s1->save();    
        }
        $s2 = Service::where('service_name', 'diagnostico')->first();
        if($s2){
        $s2->service_name = "Diagnóstico";
        $s2->save();
        }
        $s3 = Service::where('service_name', 'analisis de sangre')->first();
        if($s3){
        $s3->service_name = "Análisis de sangre";
        $s3->save();
        }
        return "services_names to capital letters process finished";
    }
    public function index($idPartner)
 	{
        $services =  DB::table('services')
                    ->join('partner_services','services.id','=','partner_services.service_id')
                    ->where('partner_id', $idPartner)
                    ->get();     
        $new = NULL;   
        $id_P = $idPartner;
        return view('partner_services.p_services')->with(compact('services','new','id_P'));
   	}

    public function add($id_P){
        return view('partner_services.new_p_service')->with(compact('id_P')); 
    }

    public function store($id_P,Request $request){
        $rules = [
            'service_name' => 'required|min:2|max:25|unique:services',
            'service_cost' => 'required|numeric',
            'docdoor_cost' => 'required|numeric',
        ];

        $messages = [
            'service_name.required' => 'Es necesario ingresar un nombre para registrar a un asociado',
            'service_name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
            'service_name.max' => 'Campo "Nombre" es demasiado extenso.',
            'service_name.unique' => 'Ya existe un servicio registrado con este Nombre',

            'service_cost.required' => 'Es necesario ingresar un costo para el servicio para registrar a un asociado',
            'service_cost.numeric' => 'El costo para el servicio debe ser un número',

            'docdoor_cost.required' => 'Es necesario ingresar un costo de ganancia para DocDoor para registrar a un asociado',
            'docdoor_cost.numeric' => 'El costo de ganancia para DocDoor debe ser un número',
        ];

        $this->validate($request, $rules, $messages);   
        $service = New Service;
        $service->service_name = $request->service_name;
        $service->save();

        $p_service = New Partner_service;
        $data = $request->all();
        unset($data['_token']);
        unset($data['service_name']);
        foreach ($data as $key => $value) {
            $p_service->$key = $data[$key] ;
        }   
        $p_service->partner_id = $id_P;
        $p_service->service_id = $service->id;
        $p_service->save();

        $services =  DB::table('services')
                    ->join('partner_services','services.id','=','partner_services.service_id')
                    ->where('partner_id', $id_P)
                    ->get();     
        $new = $p_service;   
        return view('partner_services.p_services')->with(compact('services','new','id_P'));
    }

   	public function active($id_P,$id)
    {   //TODO: fix this
        $p_service = Partner_service::find($id);
        $p_service->active = 1;
        $p_service->save();
        return redirect('/p_services/'.$id_P);
    }

    public function deactive($id_P,$id)
    {   //TODO: fix this
        //$p_service = Partner::find($id_P)->services->first()->pivot;
        //$p_service=Partner::find($id_P)->services->where('id', $id)->get()->first();
            //->updateExistingPivot($id, ["active" => 0]);
            //->newPivotStatement()
            //->where('id', $id)->update(['active' => 0]);
        //dd($p_service);
        $p_service = Partner_service::find($id);
        $p_service ->active = false;
        $p_service->save();
        
        return redirect('/p_services/'.$id_P); 
    }
    
    public function update($id_P,$id){
        $services = Partner::find($id_P)->services;
        foreach ($services as $service) {
            if($service->id == $id){
                $p_service = $service;
            }
        }
        return view('partner_services.p_service_edit')
            ->with(compact('p_service','id_P')); 
        /*$p_service = Partner_service::find($id); 
           $name = DB::table('services')
                   ->where('id', $p_service->id)
                   ->select('service_name')
                   ->get(); 
           $name = $name[0]->service_name;
           $p_service->name=$name;
           return view('partner_services.p_service_edit')
               ->with(compact('p_service','id_P')); */
    }   

    public function store_update($id_P,Request $request){
        $p_service = Partner_service::find($request->id);   
        $data = $request->all();
        
        unset($data['_token']);
        unset($data['id']);

        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
                if($p_service->$key != $data[$key] ){
                $p_service->$key=$data[$key];    
                }    
           }
        }
        $p_service->save();
        return redirect('/p_services/'.$id_P); 
    }

    public function delete($id_P,$id)
    {
        Partner_service::destroy($id);
        return redirect('/p_services/'.$id_P); 
    }

}
