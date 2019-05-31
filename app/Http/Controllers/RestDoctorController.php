<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Appointment;
use App\Doctor;
use App\Patient;
use App\User;
use App\Schedule;

class RestDoctorController extends Controller
{
	public function get_data($doctor_id){
		$doctor = Doctor::find($doctor_id);
    $user_doctor = $doctor->user;
		if(!$doctor){
    		return response()
				->json(['status' => '404', 
						'message' => 'No se encontro el doctor solicitado']);	
    	}
    	return response()
				->json(['status' => '200', 
						'message' => 'Ok',
						'content-doctor' => $doctor]);
	}

  public function get_schedule($doctor_id){
    $doctor = Doctor::find($doctor_id);
    if(!$doctor){
        return response()
        ->json(['status' => '404', 
            'message' => 'No se encontro el doctor solicitado']); 
      }
    $schedule = Schedule::find($doctor->schedule_id);
      return response()
        ->json(['status' => '200', 
            'message' => 'Ok',
            'content' => $schedule]);
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
        $i = 0;
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
           	if($i< 5){
           		if($user->$key != $data[$key] ){
                	$user->$key=$data[$key];    
            	}
           	}else{
           		if($doctor->$key != $data[$key] ){
                	$doctor->$key=$data[$key];    
            	}
           	}
           }
           $i = $i +1 ;
        }
        $user->save();
        $doctor->save();
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
