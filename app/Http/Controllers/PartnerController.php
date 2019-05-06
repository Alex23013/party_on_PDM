<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Partner;
use App\Partner_service;
use App\Http\Requests;

class PartnerController extends Controller
{
    public function index()
 	{
   		$users = Partner::all();
        $new = NULL;   
        return view('partners.partner_index')->with(compact('users','new'));
    }

    public function add(){
    	return view('partners.new_partner');	
    }
    public function store(Request $request){
    	$rules = [
            'name' => 'required|min:2|max:25',
            'sector' => 'required',
            'social_reason'=> 'required',
            'ruc' => 'required|size:11|unique:partners',
            'address'=>'required|max:40',
            'cell_1' => 'required|size:9',
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para registrar a un asociado',
            'name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
            'name.max' => 'Campo "Nombre" es demasiado extenso.',

            'sector.required' => 'Es necesario ingresar un "Rubro" para registrar a un asociado',

            'social_reason.required' => 'Es necesario ingresar una "Razón Social" para registrar a un asociado',

            'ruc.required' => 'Es necesario ingresar un RUC para registrar a un usuario',
            'ruc.size' => 'El RUC debe tener 11 digitos',
            'ruc.unique' => 'Ya existe un asociado registrado con este RUC',

            'address.required' => 'Es necesario ingresar una dirección para registrar a un doctor',
            'address.max' => 'Campo "Dirección" es demasiado extenso.',

            'cell_1.required' => 'Es necesario ingresar un número de celular para registrar a un asociado',
            'cell_1.size' => 'El número de celular debe tener 9 digitos'
        ];

        $this->validate($request, $rules, $messages);   

        $user = New Partner;
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key => $value) {
            $user->$key = $data[$key] ;
        }   
        $user->save();
        return redirect('/partners');
    }

    public function detail($id){
        $user = Partner::find($id);
        $name_services= DB::table('partner_services')
                    ->join('services','partner_services.service_id','=','services.id')
                    ->where('partner_id', $user->id)
                    ->select('name')
                    ->get();
        $name_services_arr = array();
        foreach ($name_services as $temp) {
           $name_services_arr[] = $temp->name;
        }
        return view('partners.partner_detail')  ->with(compact('user','name_services_arr')); 
    }

    public function update($id){
        $user = Partner::find($id);
        return view('partners.partner_edit')
            ->with(compact('user')); 
    }   

    public function store_update(Request $request){
    	$user = Partner::find($request->id);
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
        return redirect('/partners/detail/'.$request->id);
    }

    public function delete($id)
    {
        Partner::destroy($id);
        return redirect('/partners');
    }
}
