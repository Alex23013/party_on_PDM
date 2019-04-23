<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tuser;
use App\Http\Requests;

class TuserController extends Controller
{
    public function index()
 	{
   		$users = Tuser::all();
        $new_tech = NULL;   
        return view('techs.tuser_index')->with(compact('users','new_tech'));
    }

    public function add(){
    	return view('techs.new_tuser');	
    }

    public function store(Request $request){
    	$rules = [
            'name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'dni' => 'required|size:8|unique:tusers',
            'cellphone' => 'required|size:9'
        ];

        $messages = [
            'name.required' => 'Es necesario ingresar un nombre para registrar a un usuario',
            'name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
            'name.max' => 'Campo "Nombre" es demasiado extenso.',

            'last_name.required' => 'Es necesario ingresar un apellido para registrar a un usuario',
            'last_name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Apellido".',
            'last_name.max' => 'Campo "Apellido" es demasiado extenso.',
            
            'dni.required' => 'Es necesario ingresar un DNI para registrar a un usuario',
            'dni.size' => 'El DNI debe tener 8 digitos',
            'dni.unique' => 'Ya existe un usuario registrado con este DNI',

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

    public function active($id)
    {
        $user = Tuser::find($id);
        $user->active = 1;
        $user->save();
        return redirect('/techs');
    }

    public function deactive($id)
    {
        $user = Tuser::find($id);
        $user->active = 0;
        $user->save();
        return redirect('/techs');
    }

	public function update($id){
		$user = Tuser::find($id);
		return view('techs.tuser_edit')->with(compact('user'));
	}  

	public function store_update(Request $request){
		$user = Tuser::find($request->id);
		$data = $request->all();
		
		unset($data['_token']);
		unset($data['id']);
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
           	$user->$key=$data[$key];
           }
        }
        $user->save();
		return redirect('/techs');
	}  

    public function delete($id)
    {
        Tuser::destroy($id);
        return redirect('/techs');
    }
}
