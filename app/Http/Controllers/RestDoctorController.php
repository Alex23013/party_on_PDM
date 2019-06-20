<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Appointment;
use App\Doctor;
use App\Patient;
use App\User;
use App\Schedule;
use App\Specialty;

class RestDoctorController extends Controller
{
	public function get_data($user_id){
    $user = User::find($user_id);
    if($user->role != 1){
      return response()
        ->json(['status' => '404', 
            'message' => 'El usuario solicitado no es un usuario con rol de doctor']); 
    }else{
      $doctor = $user->doctor;
      $user_doctor = $doctor->user;
      $specialtyName = Specialty::find($doctor->specialty_id);
      if(!$doctor){
          return response()
          ->json(['status' => '404', 
              'message' => 'No se encontro el doctor solicitado']); 
        }
        return response()
          ->json(['status' => '200', 
              'message' => 'Ok',
              'specialtyName'=> $specialtyName->name,
              'content' => $doctor,]);
      }
	}

  public function get_schedule(Request $request){
    $user = User::find($request->user_id);
    if($user->role != 1){
      return response()
        ->json(['status' => '404', 
            'message' => 'El usuario solicitado no es un usuario con rol de doctor']); 
    }else{
      $doctor = $user->doctor;  
      $user_doctor = $doctor->user;
      if(!$doctor){
          return response()
          ->json(['status' => '404', 
              'message' => 'No se encontro el doctor solicitado']); 
        }
      $schedule = Schedule::find($doctor->schedule_id);
      if($schedule){
        $scheduleContent = json_decode($schedule->schedule);
        return response()
          ->json(['status' => '200', 
              'message' => 'Ok',
              'content' => $scheduleContent]);
      }else{
        return response()
          ->json(['status' => '402', 
              'message' => 'El doctor no tiene un horario asignado aun']);
      } 
    }
  }

  public function specialties(){
    $db_specialties = Specialty::all();
    
    return response()
        ->json(['status' => '200', 
            'message' => 'Ok',
            'content' => $db_specialties]);
  }

	public function update_data(Request $request){
    $user = User::find($request->user_id);
    if($user->role != 1){
      return response()
        ->json(['status' => '404', 
            'message' => 'El usuario solicitado no es un usuario con rol de doctor']); 
    }else{
      $doctor = $user->doctor;//Doctor::find($doctor_id);
      $user_doctor = $doctor->user;
		if(!$doctor){
    		return response()
				->json(['status' => '404', 
						'message' => 'No se encontro el doctor solicitado']);	
    	}
        $data = $request->all();
		unset($data['user_id']);
    unset($data['token']);
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
  }
  public function appointments(Request $request){
    $user = User::find($request->user_id);
    if($user->role != 1){
      return response()
        ->json(['status' => '404', 
            'message' => 'El usuario solicitado no es un usuario con rol de doctor']); 
    }else{
      $doctor = $user->doctor;
      $user_doctor = $doctor->user;
    	if(!$doctor){
    		return response()
				->json(['status' => '404', 
						'message' => 'No se encontro el doctor solicitado']);	
    	}
    	$appointments = $doctor->appointment;
    	$matched_appointments=[];
    	foreach ($appointments as $app) {
        if($app->status == $request->app_status){
        	$patient = Patient::find($app->attention->patient_id);
          if($request->app_status == 1){
            $then = $app->date_time;
            $now = time();        
            $thenTimestamp = strtotime($then);
            $difference_seconds = $thenTimestamp-$now ;
            if($difference_seconds>0){
              $matched_appointments[]= ['id' => $app->attention->id, 
              "motive" => $app->attention->motive,
              "name_patient" =>$patient->user->name,
              "last_name_patient" =>$patient->user->last_name,
              "date_time" => $app->date_time,
              ]; 
            }
          }else{
             $matched_appointments[]= ['id' => $app->attention->id, 
              "motive" => $app->attention->motive,
              "name_patient" =>$patient->user->name,
              "last_name_patient" =>$patient->user->last_name,
              "date_time" => $app->date_time,
              ]; 
          }
          
        }
      }
      if($matched_appointments==[]){
          return response()
            ->json(['status' => '402', 
                'message' => 'no-results']);
        }else{
          return response()
            ->json(['status' => '200', 
                'message' => 'Ok',
                'content' => $matched_appointments]);
        };
    }
  }

 public function update_available(Request $request){   
    $user = User::find($request->user_id);
    $doctor = $user->doctor;
    if(!$doctor){
      return response()
      ->json(['status' => '404', 
          'message' => 'El usuario solicitado no es un usuario con rol de doctor']); 
    }
    $doctor->available = $request->new_available;
    $doctor->save();
    return response()
      ->json(['status' => '200', 
          'message' => 'Ok']);
  }

}
