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
    	//return view('techs.new_tuser');	
    }
    public function store(Request $request){
    	$rules = [
            'name' => 'required|min:2|max:25',
            'ruc' => 'required|size:11|unique:partners',
            'cellphone' => 'required|size:9',
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para registrar a un usuario',
            'name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
            'name.max' => 'Campo "Nombre" es demasiado extenso.',

            'cellphone.required' => 'Es necesario ingresar un número de celular para registrar a un usuario',
            'cellphone.size' => 'El número de celular debe tener 9 digitos'
        ];

        $this->validate($request, $rules, $messages);   

        $user = New Tuser;
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key => $value) {
            $user->$key = $data[$key] ;
        }   
        $user->save();
        return redirect('/techs');
    }
}
