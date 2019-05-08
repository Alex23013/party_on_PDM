<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\Http\Requests;

class RestPatientsController extends Controller
{
    public function register(Request $request){
    	$email_exists = DB::table('users')
                    ->where('email',$request->email)
                    ->first();
        $dni_exists = DB::table('users')
                    ->where('dni',$request->dni)
                    ->first();
		if($dni_exists){
		return response()
				->json(['status' => '406', 
						'message' => 'ERROR: Este numero DNI ya ha sido registrado']);                           
		}else if ($email_exists){
			return response()
				->json(['status' => '406',
						'message' => 'ERROR: Este email ya ha sido registrado']);  
	    }else{
	        $user = New User;
	        $user->name = $request->name;
	        $user->last_name = $request->last_name;
	        $user->dni =  $request->dni;
	        $user->email = $request->email;
	        $user->password = bcrypt($request->password);
	        $user->cellphone =  $request->cellphone;
	        $user->role =  $request->role;
	        $user->name_role =  "paciente";
	        $user->save();
	        return response()
				->json(['status' => '201',
						'message' => 'Ok']); 
    	}
    }

    public function login(Request $request){
    	$user = DB::table('users')
                    ->where('email',$request->email)
                    ->first(); 
    	if($user != null && Hash::check($request->password, $user->password)){
    		return response()
				->json(['status' => '200',
						'message' => 'Ok']); 
    	}else{
    		return response()
				->json(['status' => '401',
						'message' => 'credenciales no validas']); 
    	}
    }

    public function recover(Request $request){
    	$user = DB::table('users')
                    ->where('email',$request->email)
                    ->first(); 
    	if($user != null ){
    		$user = User::find($user->id);   
    		$user->password = $request->password;
    		$user->save();
    		return response()
				->json(['status' => '200',
						'message' => 'Ok']);
    	}else{
    		return response()
				->json(['status' => '406',
						'message' => 'ERROR: No existe un usuario registrado para ese correo']);
    	}	
    }
}
