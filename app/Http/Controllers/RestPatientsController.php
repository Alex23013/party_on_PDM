<?php

namespace App\Http\Controllers;
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
						'message' => 'Este numero de DNI ya ha sido registrado']);                           
		}else if ($email_exists){
			return response()
				->json(['status' => '406',
						'message' => 'Este email ya ha sido registrado']);  
	    }else{
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
	        return response()
				->json(['status' => '201',
						'message' => 'Ok']); 
    	}
    }


    public function profile(Request $request){
    	$user = DB::table('users')
                    ->where('id',$request->id)
                    ->first(); 
    	if($user != null ){
    		$user = User::find($user->id);   
    		$data = $request->all();
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
						        	return response()
										->json(['status' => '406',
												'message' => 'No se pudo actualizar los datos , el email ya tiene una cuenta asignada']);
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
		           	}	           	
	           }
	        }
    		$user->save();
    		$patient->save();
    		return response()
				->json(['status' => '200',
						'message' => 'Ok']);
    	}else{
    		return response()
				->json(['status' => '406',
						'message' => 'No se pudo encontrar los datos del perfil del paciente solicitado']);
    	}	
    }

    
}
