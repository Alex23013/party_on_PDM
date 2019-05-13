<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Http\Requests;
use Auth;

class PatientController extends Controller
{
    public function index()
 	{
   		$users = DB::table('patients')
                    ->join('users','patients.user_id','=','users.id')
                    ->get();
        $new = NULL;   
        return view('patients.patient_index')->with(compact('users','new'));
    }
    
    public function detail ($id){
    	$user = User::find($id);
        if($user->avatar == "default.png"){
            $url_image = "/images/".Auth:: user()->avatar;
        }else{
            $url_image = "/images/uploads/".Auth:: user()->avatar;
        }
    	$s_user = DB::table('patients')
                    ->where('user_id', $user->id)
                    ->first(); 
        return view('users.user_profile')  ->with(compact('user','url_image','s_user'));
    }

    public function add(){
    	return view('patients.new_patient');	
    }

    public function store(Request $request){
    	$rules = [
                'name' => 'required|min:2|max:255',
                'last_name' => 'required|min:2|max:255',
                'dni' => 'required|size:8|unique:users',
                'cellphone' => 'required|size:9',
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
            $rules1 = [
                'birth_at' => 'required',
            ];
            $messages1 = [
                'birth_at.required' => 'Es necesario ingresar una fecha de nacimiento para registrar a un doctor',
            ];
            if($request->role == 1){ //new_doctor
                $this->validate($request, $rules1, $messages1);       
            }
    	$user = New User;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->dni =  $request->dni;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cellphone =  $request->cellphone;
        $user->role =  3;
        $user->name_role =  "paciente";
        $user->save();

        $patient = New Patient;
        $patient->user_id = $user->id;
        $patient->birth_at = $request->birth_at;
        if($request->ec_name != ''){
            $patient->ec_name = $request->ec_name;
        }
        if($request->ec_last_name != ''){
            $patient->ec_last_name = $request->ec_last_name;
        }
        if($request->ec_cellphone != ''){
            $patient->ec_cellphone = $request->ec_cellphone;
        }
        $patient->save();
        $users = DB::table('patients')
                    ->join('users','patients.user_id','=','users.id')
                    ->get();
        $new = $user;   
        return view('patients.patient_index')->with(compact('users','new'));

    }

    public function update($id){
    	$user = User::find($id);
    	$patient = DB::table('patients')
                    ->where('user_id', $user->id)
                    ->first(); 
    	return view('patients.patient_edit')->with(compact('user','patient'));
    }

    public function store_update(Request $request){
    	$user = User::find($request->id);
        $data = $request->all();
        $error = NULL;
        unset($data['_token']);
        unset($data['id']);
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{ 
           		$pos_coincidence = strpos($key, 'c_');
	           	if($pos_coincidence == false){
	           		if($user->$key != $data[$key] ){
	           			if($key == 'email'){
	           				$user1 = DB::table('users')
					                    ->where('email',$request->email)
					                    ->first();
					        if($user1){
					        	$error = "el email ya esta en uso";
					        }
	           			}
                		$user->$key=$data[$key];
                	}
	           	}else{
	           		$patient = DB::table('patients')
			                    ->where('user_id',$user->id)
			                    ->first(); 
			        $patient = Patient::find($patient->id);
	           		if($patient->$key != $data[$key] ){
                	$patient->$key=$data[$key];}
                	$patient->save();
	           	}	           	
           }
        }
    	$user->save();
    	return redirect('/patients');
    }
    public function delete($id)
    {
    	$patient = DB::table('patients')
                    ->where('user_id', $id)
                    ->first();
     	Patient::destroy($patient->id);
        User::destroy($id);
        return redirect('/patients');
    }
}
