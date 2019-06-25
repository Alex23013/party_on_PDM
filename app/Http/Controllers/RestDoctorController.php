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
use App\History;
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
      if(!$doctor){
          return response()
          ->json(['status' => '404', 
              'message' => 'No se encontro el doctor solicitado']); 
        }
      $schedule = Schedule::find($doctor->schedule_id);
      if($schedule){
        $scheduleContent = json_decode($schedule->schedule);
        $validDays = [];
        foreach ($scheduleContent as $day) {
          if($day->schedule_start != ""){
            $validDays[]= $day;
          }
        }
        if($validDays == []){
          return response()
          ->json(['status' => '402', 
              'message' => 'El doctor no tiene un horario']);
        }else{
          return response()
          ->json(['status' => '200', 
              'message' => 'Ok',
              'content' => $validDays]);
        }
        
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
              $matched_appointments[]= [
              'app_id' => $app->attention->id, 
              "motive" => $app->attention->motive,
              "patient_id"=>$patient->id,
              "name_patient" =>$patient->user->name,
              "last_name_patient" =>$patient->user->last_name,
              "date_time" => $app->date_time,
              ]; 
            }
          }else{
             $matched_appointments[]= [
              'app_id' => $app->attention->id, 
              "motive" => $app->attention->motive,
              "patient_id"=>$patient->id,
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

  public function attend_appointment(Request $request){
    $app = Appointment::find($request->app_id);
    $app->status = 2; // marcar cita como atendida
    $app->save();

    $patient = Patient::find($request->patient_id);
    $patient_name = $patient->user->name." ".$patient->user->last_name;

    $histories = History::all();
    $matched_histories = [];
    foreach ($histories as $hist) {
        if($hist->attention->patient->id == $request->patient_id){
            $matched_histories[]=$hist;
        }
    }
    if($matched_histories){
      $matched_histories = array_reverse($matched_histories);
      $last_personal_antecedent = $matched_histories[0]->personal_antecedents;
      $last_family_antecedent = $matched_histories[0]->family_antecedents;
      return response()
        ->json(['status' => '200', 
            'message' => 'Ok',
            'patient_name'=>$patient_name,
            'last_personal_antecedent'=>$last_personal_antecedent,
            'last_family_antecedent'=>$last_family_antecedent,
            'content'=>$matched_histories]);  
    }else{
      return response()
        ->json(['status' => '200', 
            'message' => 'Ok',
            'patient_name'=>$patient_name,
            'last_personal_antecedent'=>"",
            'last_family_antecedent'=>"",
            'content'=>"aun no hay historial de este paciente"]); 
    }
    
  }

  public function create_history (Request $request){
    $data = $request->all();
    unset($data['token']);
    $personal = $data['personal_antecedents'];
    unset($data['personal_antecedents']);
    $family = $data['family_antecedents'];
    unset($data['family_antecedents']);
    $history = New History;
    foreach ($data as $key => $value) {
      if($key == 'last_personal_antecedents'){
        if($personal == ""){
          $history->personal_antecedents=$data[$key];
        }else{
          $history->personal_antecedents=$data[$key]."-".$personal;
        }        
      }else if($key == 'last_family_antecedents'){
        if($family == ""){
          $history->family_antecedents=$data[$key];
        }else{
          $history->family_antecedents=$data[$key]."-".$family;
        }        
      }else if($key == "app_id"){
        $app  = Appointment::find($data[$key]);
        $history->attention_id = $app->attention->id;
      }
      else{
        $history->$key=$data[$key];     
      }      
    }
    $history->save();
    return response()
      ->json(['status' => '201', 
          'message' => 'Ok',
          'content' => $history]);
  }

}
