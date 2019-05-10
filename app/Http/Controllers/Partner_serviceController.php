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
            'name' => 'required|min:2|max:25|unique:services',
            'service_cost' => 'required',
            'docdoor_cost' => 'required',
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para registrar a un asociado',
            'name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
            'name.max' => 'Campo "Nombre" es demasiado extenso.',
            'name.unique' => 'Ya existe un servicio registrado con este Nombre',

            'service_cost.required' => 'Es necesario ingresar un costo para el servicio para registrar a un asociado',

            'docdoor_cost.required' => 'Es necesario ingresar un costo de ganancia para DocDoor para registrar a un asociado',
        ];

        $this->validate($request, $rules, $messages);   
        $service = New Service;
        $service->name = $request->name;
        $service->save();

        $p_service = New Partner_service;
        $data = $request->all();
        unset($data['_token']);
        unset($data['name']);
        foreach ($data as $key => $value) {
            $p_service->$key = $data[$key] ;
        }   
        $p_service->partner_id = $id_P;
        $p_service->service_id = $service->id;
        $p_service->save();
        return redirect('/p_services/'.$id_P);
    }

   	public function active($id_P,$id)
    {
        $p_service = Partner_service::find($id);
        $p_service->active = 1;
        $p_service->save();
        return redirect('/p_services/'.$id_P);
    }

    public function deactive($id_P,$id)
    {
        $p_service = Partner_service::find($id);
        $p_service->active = 0;
        $p_service->save();
        return redirect('/p_services/'.$id_P); 
    }
    
    public function update($id_P,$id){

        $p_service = Partner_service::find($id); 
        $name = DB::table('services')
                ->where('id', $p_service->id)
                ->select('name')
                ->get(); 
        $name = $name[0]->name;
        $p_service->name=$name;
        return view('partner_services.p_service_edit')
            ->with(compact('p_service','id_P')); 
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
