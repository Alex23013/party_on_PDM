<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RestUserController extends Controller
{
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
						'message' => 'No existe un usuario registrado para ese correo']);
    	}	
    }
}
