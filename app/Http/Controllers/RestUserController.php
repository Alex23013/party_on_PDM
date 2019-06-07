<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use App\Http\Requests;
use App\Token;

class RestUserController extends Controller
{
   public function login(Request $request){
    	$user = User::where('email', $request->email)
               ->first();
    	if($user != null && Hash::check($request->password, $user->password)){
            $user_obj = User::find($user->id);
            if($user_obj->role == 1){
                $doctor_info =  $user_obj->doctor;
            }
            if($user_obj->role == 3){
                $patient_info =  $user_obj->patient;
            }
    		return response()
				->json(['status' => '200',
						'message' => 'Ok',
                        'user'=>$user_obj]); 
    	}else{
    		return response()
				->json(['status' => '401',
						'message' => 'credenciales no validas']); 
    	}
    }

    public function login_v2(Request $request){
        $user = User::where('email', $request->email)
               ->first();
        if($user != null && Hash::check($request->password, $user->password)){
            $user_obj = User::find($user->id);
            if($user_obj->role == 1){
                $doctor_info =  $user_obj->doctor;
            }
            if($user_obj->role == 3){
                $patient_info =  $user_obj->patient;
            }

            $token = bcrypt(date("ymdHis").$user_obj->email);
            $Token = New Token;
            $Token->token = $token;
            $Token->user_id = $user->id;
            $Token->save();

            return response()
                ->json(['status' => '200',
                        'message' => 'Ok',
                        'token' => $token,
                        'user'=>$user_obj]); 
        }else{
            return response()
                ->json(['status' => '401',
                        'message' => 'credenciales no validas']); 
        }
    }

    public function recover(Request $request){
    	$user = User::where('email', $request->email)
               ->first();
    	if($user != null ){
    		$user = User::find($user->id);   
    		$user->password =  bcrypt($request->password);
    		$user->save();
    		return response()
				->json(['status' => '200',
						'message' => 'Ok']);
    	}else{
    		return response()
				->json(['status' => '406',
						'message' => 'No existe un usuario registrado para ese correo']);
    	}	
    }

}
