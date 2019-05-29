<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Appointment;
use App\Doctor;
use App\Patient;
use App\User;

class RestDoctorController extends Controller
{
	public function get_data($doctor_id){
		$doctor = Doctor::find($doctor_id);
		if(!$doctor){
    		return response()
				->json(['status' => '404', 
						'message' => 'No se encontro el doctor solicitado']);	
    	}
    	return response()
				->json(['status' => '200', 
						'message' => 'Ok',
						'content' => $doctor]);
	}

	public function update_data(Request $request){
		$doctor = Doctor::find($request->doctor_id);
		if(!$doctor){
    		return response()
				->json(['status' => '404', 
						'message' => 'No se encontro el doctor solicitado']);	
    	}
        $user = User::find($doctor->user_id);
        $data = $request->all();
		unset($data['doctor_id']);
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
           	$pos_coincidence = strpos($key, 'octor_');
           	if($pos_coincidence == 0){
           		if($user->$key != $data[$key] ){
                	$user->$key=$data[$key];    
            	}
           	}else{
           		dd($key);
           		//quitar el 'doctor_'
           		if($doctor->$key != $data[$key] ){
                	$doctor->$key=$data[$key];    
            	}
           	}
           }
        }
        $user->save();
        return response()
				->json(['status' => '201', 
						'message' => 'Ok']);
	}
    public function appointments_confirmed($doctor_id){
    	$doctor = Doctor::find($doctor_id);
    	if(!$doctor){
    		return response()
				->json(['status' => '404', 
						'message' => 'No se encontro el doctor solicitado']);	
    	}
    	$appointments = $doctor->appointment;
    	$appointments_confirmed=[];
    	foreach ($appointments as $app) {
            if($app->status == 1){
            	$patient = Patient::find($app->attention->patient_id);
					$appointments_confirmed[]= ['id' => $app->attention->id, 
						"motive" => $app->attention->motive,
						"name_patient" =>$patient->user->name,
						"last_name_patient" =>$patient->user->last_name,]; 
            }
        }
        return response()
				->json(['status' => '200', 
						'message' => 'Ok',
						'content' => $appointments_confirmed]);
    }
}
