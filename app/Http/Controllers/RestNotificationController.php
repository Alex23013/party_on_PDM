<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Notification;
use App\User;
class RestNotificationController extends Controller
{
    public function register(Request $request){
    	$user = User::where('email',$request->user_email)->first();
    	if($user){
    		$not = New Notification;
	    	$data = $request->all();
	    	unset($data['token']);
    		foreach ($data as $key => $value) {
	    		$not->$key=$data[$key];    
	    	}
	    	$not->save();	
	    	return response()
          	->json(['status' => '201', 
              'message' => 'Ok']);
    	}else{
    		return response()
          	->json(['status' => '400', 
              'message' => 'Usuario no encontrado']);
    	}
    	
    	
    }

    public function delete(Request $request){
    	$not = Notification::where('user_email',$request->user_email)->first();
    	if($not){
    		Notification::destroy($not->id);
    		return response()
          	->json(['status' => '200', 
              'message' => 'Ok']);
    	}else{
    		return response()
          ->json(['status' => '404', 
              'message' => 'No se encontro la notificacion solicitada']);
    	}
    	
    }
}
