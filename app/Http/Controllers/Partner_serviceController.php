<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Partner;
use App\Partner_service;
use App\Http\Requests;

class Partner_serviceController extends Controller
{
    public function index($idPartner)
 	{
 		$services = DB::table('partner_services')
                    ->where('partner_id',$idPartner)
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
            'name' => 'required|min:2|max:25',
            'service_cost' => 'required',
            'docdoor_cost' => 'required',
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para registrar a un asociado',
            'name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
            'name.max' => 'Campo "Nombre" es demasiado extenso.',

            'service_cost.required' => 'Es necesario ingresar un costo para el servicio para registrar a un asociado',

            'docdoor_cost.required' => 'Es necesario ingresar un costo de ganancia para DocDoor para registrar a un asociado',
        ];

        $this->validate($request, $rules, $messages);   

        $user = New Partner_service;
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key => $value) {
            $user->$key = $data[$key] ;
        }   
        $user->partner_id = $id_P;
        $user->save();
        return redirect('/p_services/'.$id_P);
    }

   	public function active($id_P,$id)
    {
        $user = Partner_service::find($id);
        $user->active = 1;
        $user->save();
        return redirect('/p_services/'.$id_P);
    }

    public function deactive($id_P,$id)
    {
        $user = Partner_service::find($id);
        $user->active = 0;
        $user->save();
        return redirect('/p_services/'.$id_P); 
    }
    
    public function update($id_P,$id){
        $user = Partner_service::find($id); 
        return view('partner_services.p_service_edit')
            ->with(compact('user','id_P')); 
    }   

    public function store_update($id_P,Request $request){
        $user = Partner_service::find($request->id);   
        $data = $request->all();
        
        unset($data['_token']);
        unset($data['id']);
        
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
            if($user->$key != $data[$key] ){
                $user->$key=$data[$key];    
            }
           }
        }
        $user->save();
        return redirect('/p_services/'.$id_P); 
    }

    public function delete($id_P,$id)
    {
        Partner_service::destroy($id);
        return redirect('/p_services/'.$id_P); 
    }

}
