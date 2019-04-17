<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Doctor;
use App\Triage;
use Auth;

class UserController extends Controller
{
	public function index()
    {
        $users = User::all();
        $newUser = NULL;   
        return view('users.user_index')->with(compact('users','newUser'));
    }

    public function add($role){
        if($role == 0){
            return view('users.new_admin');   
        }else if($role == 1){
            return view('users.new_doctor'); 
        }else{
            return view('users.new_triage'); 
        }
    }

    public function active($id)
    {
        $user = User::find($id);
        $user->validated = 1;
        $user->save();
        return redirect('/users');
    }

    public function deactive($id)
    {
        $user = User::find($id);
        $user->validated = 0;
        $user->save();
        return redirect('/users');
    }

    public function profile(){
        $user = User::find(Auth:: user()->id);
        if(Auth:: user()->avatar == "default.png"){
            $url_image = "/images/".Auth:: user()->avatar;
        }else{
            $url_image = "/images/uploads/".Auth:: user()->avatar;
        }
        $s_user = NULL;
        if($user->role == 1 ){
            $s_user = DB::table('doctors')
                    ->where('user_id', $user->id)
                    ->first(); 
        } 
        if($user->role == 2 ){
            $s_user = DB::table('triages')
                    ->where('user_id', $user->id)
                    ->first(); 
        } 
        return view('users.user_profile')
            ->with(compact('user','url_image','s_user')); 
    }
 
 
    public function show($id)
    {
        return User::find($id);
    }

    public function store(Request $request)
    {
       // User::create($request->all());
        $rules = [
            'name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'dni' => 'required|size:8|unique:users',
            'cellphone' => 'required|size:9',
            'role' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6'
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
            'cellphone.size' => 'El número de celular debe tener 9 digitos',

            'role.required' => 'Es necesario ingresar un rol para registrar a un usuario',
            
            'email.required' => 'Es necesario ingresar un email para registrar a un usuario.',
            'email.email' => 'Ingrese un email válido.',
            'email.max' => 'Campo "E-mail" es demasiado extenso.',
            'email.unique' => 'Este email ya está en uso',
            
            'password.required' => 'Es necesario ingresar una contraseña para registrar a un usuario.',
            'password.min' => 'Ingrese como mínimo 6 caracteres en el campo "Contraseña".'
        ];

        $this->validate($request, $rules, $messages);       

        $user = New User;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->dni =  $request->dni;
        $user->email = $request->email;
        $user->password =bcrypt($request->password);
        $user->cellphone =  $request->cellphone;
        $user->role =  $request->role;
        if($request->role == 0){
            $user->validated = 1;
        }
        $user->name_role =  $request->name_role;
        $user->save();

        if($request->role == 1){
        $doctor = New Doctor;
        $doctor->user_id = $user->id; 
        $doctor->birth_at = $request->birth_at;
        $doctor->college = $request->college;
        $doctor->address= $request->address;
            if($request->specialty == ''){
                $doctor->specialty = "médico general";
            }else{
                $doctor->specialty= $request->specialty;
            }            
        $doctor->ec_name = $request->ec_name;
        $doctor->ec_last_name = $request->ec_last_name;
        $doctor->ec_cellphone =  $request->ec_cellphone;
        $doctor->save();
        }

        if($request->role == 2){
        $triage = New Triage;
        $triage->user_id = $user->id; 
        $triage->is_a_doctor = $request->is_a_doctor; 
        if($request->is_a_doctor){
            $triage->college = $request->college;    
        }
        $triage->save();        
        }
    
        
        return redirect('/users');
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function delete($id)
    {
        User::destroy($id);
        return redirect('/users');
    }
}
