<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class UserController extends Controller
{
	public function index()
    {
        $users = User::all();
        $newUser = NULL;   
        return view('users.user_index')->with(compact('users','newUser'));
    }

    public function add(){
        return view('users.new_user');   
    }

    public function profile(){
        $user = User::find(Auth:: user()->id);
        if(Auth:: user()->avatar == "default.png"){
            $url_image = "/images/".Auth:: user()->avatar;
        }else{
            $url_image = "/images/uploads/".Auth:: user()->avatar;
        }
        return view('users.user_profile')->with(compact('user','url_image')); 
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

        //$confirmation_code = str_random(25);
        $user = New User;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->dni =  $request->dni;
        $user->email = $request->email;
        $user->password =bcrypt($request->password);
        $user->cellphone =  $request->cellphone;
        $user->role =  $request->role;
        //$user->confirmation_code = $confirmation_code;
        $user->save();
        /*$data = [
            'confirmation_code' => $confirmation_code,
            'id'=>$user->id,
            'name' => $user->name,
            'email'=> $user->email,
            'password'=>$request->password,
        ];
        Mail::send('emails.confirmation_code', $data, function($message)
        use ($data) {
        $message->to($data['email'], $data['name'])->subject('Por favor confirma tu correo');
        });*/
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
