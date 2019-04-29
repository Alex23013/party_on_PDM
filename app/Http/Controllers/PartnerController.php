<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
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

    public function delete($id)
    {
        Partner::destroy($id);
        return redirect('/partners');
    }
}
