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
use App\Doctorkit;
use App\Recipe;
use App\Medicine;
use App\Espschedule;
use App\Entrykit;
use App\Gmedicine;

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
      if($doctor->specialty_id == 1){
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
      }else{//medico especialista
        $schedules = Espschedule::where('doctor_id',$doctor->id)->get();
        $validDays = [];
        if(count($schedules)>0){
          foreach ($schedules as $key => $value) {
            $validDays[]=[
              "day"=> $value->date,
            "schedule_start"=> $value->start_time,
            "schedule_end"=> $value->end_time,
            ];
          }
          return response()
            ->json(['status' => '200', 
                'message' => 'Ok',
                'content' => $validDays]);

        }else{
          return response()
            ->json(['status' => '402', 
                'message' => 'El doctor no tiene horarios de atención asignados']);
        }
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
              'app_id' => $app->id, 
              "motive" => $app->attention->motive,
              "patient_id"=>$patient->id,
              "name_patient" =>$patient->user->name,
              "last_name_patient" =>$patient->user->last_name,
              "date_time" => $app->date_time,
              "address"=>$app->attention->address,
              "latitude"=>$app->attention->att_latitude,
              "longitude"=>$app->attention->att_longitude,
              ]; 
            }
          }else{
             $matched_appointments[]= [
              'app_id' => $app->id, 
              "motive" => $app->attention->motive,
              "patient_id"=>$patient->id,
              "name_patient" =>$patient->user->name,
              "last_name_patient" =>$patient->user->last_name,
              "date_time" => $app->date_time,
              "address"=>$app->attention->address,
              "latitude"=>$app->attention->att_latitude,
              "longitude"=>$app->attention->att_longitude,
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

 public function active(Request $request){   
    $user = User::find($request->user_id);
    $doctor = $user->doctor;
    if(!$doctor){
      return response()
      ->json(['status' => '404', 
          'message' => 'El usuario solicitado no es un usuario con rol de doctor']); 
    }
    $doctor->available = 1;
    $doctor->doctor_longitude = $request->longitude;
    $doctor->doctor_latitude = $request->latitude;
    $doctor->save();
    return response()
      ->json(['status' => '200', 
          'message' => 'Ok']); 
  }

  public function deactive(Request $request){   
    $user = User::find($request->user_id);
    $doctor = $user->doctor;
    if(!$doctor){
      return response()
      ->json(['status' => '404', 
          'message' => 'El usuario solicitado no es un usuario con rol de doctor']); 
    }
    $doctor->available = 0;
    $doctor->save();
    return response()
      ->json(['status' => '200', 
          'message' => 'Ok']);
  }

  public function attend_appointment(Request $request){
    $app = Appointment::find($request->app_id);
    if($app){
      $patient = Patient::find($request->patient_id);
      if(!$patient){
        return response()
        ->json(['status' => '404', 
            'message' => 'no se encontro la información del historial, verifique el id del paciente']);
      }
      if($patient->id != $app->attention->patient_id){
        return response()
        ->json(['status' => '404', 
            'message' => 'El id del paciente no coiincide con la cita medica']);
      }
      $app->status = 2; // marcar cita como atendida
      $app->save();

      
      $patient_name = $patient->user->name." ".$patient->user->last_name;

      $appointments_completed = Appointment::where('status',2)->get(); 
      $matched_histories = []; 
      foreach ($appointments_completed as $app_com) {
        if($app_com->attention->patient_id == $request->patient_id ){
          $month = date("m",strtotime($app_com->date_time));
          $year = date("y",strtotime($app_com->date_time));
          if( $month ==date('m') &&  $year == date('y')){
            if($app_com->attention->history != null){
              $matched_histories[]=$app_com->attention->history;  
            }
          }
        }
      }
      //dd($matched_histories);
      if(count($matched_histories)< 1){
        return response()
        ->json(['status' => '200', 
              'message' => 'Ok',
              'patient_name'=>$patient_name,
              'last_personal_antecedent'=>"",
              'last_family_antecedent'=>"",
              'content'=>"El paciente no tiene historias clinicas en el ultimo mes"]);

      }else{
        $matched_histories = array_reverse($matched_histories);
        $last_personal_antecedent = $matched_histories[0]->personal_antecedents;
        $last_family_antecedent = $matched_histories[0]->family_antecedents;
        return response()
          ->json(['status' => '200', 
              'message' => 'Ok',
              'patient_name'=>$patient_name,
              'last_personal_antecedent'=>json_decode($last_personal_antecedent),
              'last_family_antecedent'=>json_decode($last_family_antecedent),
              'content'=>$matched_histories]);  
      }
    }else{
      return response()
        ->json(['status' => '404', 
            'message' => 'no se encontro la información de esa cita, verifique el id de la cita']);
    } 
  }

  public function create_history (Request $request){
    $data = $request->all();
    unset($data['token']);
    
    $history = New History;
    foreach ($data as $key => $value) {
      if($key == 'last_family_antecedents'){
        $history->family_antecedents=json_encode($data[$key]);
      } else if($key == 'personal_antecedents'){
        $history->personal_antecedents=json_encode($data[$key]);
      }else if($key == "app_id"){
        $app  = Appointment::find($data[$key]);
        $history->attention_id = $app->attention->id;
      } else{
        $history->$key=$data[$key];     
      }      
    }
    $history->save();
    $history->personal_antecedents = json_decode($history->personal_antecedents);
    $history->family_antecedents = json_decode($history->family_antecedents);
    return response()
      ->json(['status' => '201', 
          'message' => 'Ok',
          'content' => $history]);
  }

  public function get_medicines_groups(Request $request){
    $user = User::find($request->user_id);
    if($user->role != 1){
      return response()
        ->json(['status' => '404', 
            'message' => 'El usuario solicitado no es un usuario con rol de doctor']); 
    }else{
      $groups_data = Gmedicine::all();
      $groups =[];
      foreach ($groups_data as $value) {
        $groups[]=[
        'id'=> $value->id,
        'medicine_group'=>$value->group_name,
        ];
      }
      return response()
      ->json(['status' => '200', 
          'message' => 'Ok',
          'content' => $groups]);
    }
  }

  public function get_bag(Request $request){
    $user = User::find($request->user_id);
    if($user->role != 1){
      return response()
        ->json(['status' => '404', 
            'message' => 'El usuario solicitado no es un usuario con rol de doctor']); 
    }else{
      $doctor = $user->doctor;
      $doctor_kit = Doctorkit::where ('doctor_id', $doctor->id)->where('active',true)->first();
      if($doctor_kit){
        $dbag = json_decode($doctor_kit->bag);
        $select_group =[];
        foreach ($dbag as $key => $value) {
          $medicine = Medicine::find($value->id);
          //if($medicine->medicine_group == $request->medicine_group){
            $select_group[]=[
            'id'=>$value->id,
            'name'=>$medicine->name,
            'brand'=>$medicine->brand,
            'dosis'=>$medicine->dosis,
            'quantity'=>$value->quantity,
            ];
          //}
        }
        return response()
                ->json(['status' => '200', 
                  'message' => 'Ok',
                  'kit_id' => $doctor_kit->kit_id,
                  'bag' => $select_group]);
      }else{
        return response()
                ->json(['status' => '403', 
                  'message' => "El doctor no tiene un kit de doctor asignado"]);   
      }
      
    }
  }

  //utils-function
  public function objArraySearch($array, $index, $value)
    {
        foreach($array as $arrayInf) {
            if($arrayInf->{$index} == $value) {
                return $arrayInf;
            }
        }
        return null;
    }
 
  public function new_bag($kit_id){
    $entries = Entrykit::where('kit_id',$kit_id)->get();
    $bag=[];
    foreach ($entries as $key => $value) {
      $medicine = Medicine::find($value->medicine_id);
      $medicine_name = $medicine->name.":".$medicine->brand."-".$medicine->dosis;
      $bag[$key]=(object)[
      "id"=>$value->id,
      "quantity"=>$value->quantity,
      ];
    }
    return json_encode($bag);
  }
  //utils-function
  public function unique_multidimensional_array($array, $key) {
      $temp_array = array();
      $i = 0;
      $key_array = array();

      foreach($array as $val) {
          if (!in_array($val[$key], $key_array)) {
              $key_array[$i] = $val[$key];
              $temp_array[$i] = $val;
          }
          $i++;
      }
      return $temp_array;
  }

  public function create_recipe(Request $request){
    $user = User::find($request->user_id);
    if($user->role != 1){
      return response()
        ->json(['status' => '404', 
            'message' => 'Solo usuarios con rol doctor pueden registrar una receta médica']); 
    }else{
      $data = $request->all();
      unset($data['token']);
      unset($data['user_id']);
      unset($data['kit_id']);

      $user = User::find($request->user_id); 
      $doctor_id = $user->doctor->id;
      $last_kit = Doctorkit::where('doctor_id', $doctor_id)->where('active',true)->first();
      
      if($last_kit){
        $last_bag_obj =json_decode($last_kit->bag);
        $last_bag_arr =json_decode($last_kit->bag,TRUE);  
      }else{
        return response()
              ->json(['status' => '400', 
                  'message' => 'el doctor no tiene un Doctorkit asignado']);
      }
      
         
      $medicine_list = $request->medicines; 
      if(count($medicine_list)>0){
        $last_kit->active = 0;
        $last_kit->save();
        $medicine_list_actualized=[];
        //dd($medicine_list);
        foreach ($medicine_list as $key => $value) {
          //dd($value);
          //$medicine = Medicine::find($value['id']);
          //$medicine_name = $medicine->name.":".$medicine->brand."-".$medicine->dosis;
          $neededObject = $this->objArraySearch($last_bag_obj, "id", $value['id']);
          $medicine_list_actualized[]=[
            "id"=>$value['id'],
            //"name"=>$medicine_name,
            "quantity"=>($neededObject->quantity)-($value['quantity']),
          ];
        }
        //dd("actualizado",$medicine_list_actualized);
        //dd("last_bag", $last_bag_arr);
        $result = array_merge( $medicine_list_actualized,$last_bag_arr );
        $result1= $this->unique_multidimensional_array($result, "id");
        $result2 = array();
        foreach ($result1 as $to_obj)
        {
          $result2[] = (object)$to_obj;
        }
        //dd($result2);
        //dd("dd", $doctor_kit->bag);
        $doctor_kit = New Doctorkit;
        $doctor_kit->kit_id = $request->kit_id;
        $doctor_kit->doctor_id = $doctor_id;
        $doctor_kit->bag = json_encode($result2);
        $doctor_kit->save();
      }
      
      $recipe = New Recipe;
      foreach ($data as $key => $value) {
        if($key == 'medicines'){
          $recipe->$key = json_encode($data[$key]);
        }elseif ($key == 'instructions') {
          $recipe->$key = json_encode($data[$key]);

        }else{
          $recipe->$key=$data[$key];  
        }        
      }
      $recipe->save();
      $info[]=[
          "recipe_id"=>$recipe->id,
          "appointment_id"=>$recipe->appointment_id,
          "medicines"=>json_decode($recipe->medicines),
          "instructions"=>json_decode($recipe->instructions),
          "prox_attentions"=>$recipe->prox_attention,
        ];
      return response()
              ->json(['status' => '201', 
                  'message' => 'Ok',
                  'bag' => $info]);
    }
  }

  public function get_recipe(Request $request){
    $app = Appointment::find($request->appointment_id);
    if($app){
      $recipe = $app->recipe;
      if($recipe){
        $info[]=[
        "recipe_id"=>$recipe->id,
          "appointment_id"=>$recipe->appointment_id,
          "medicines"=>json_decode($recipe->medicines),
          "instructions"=>json_decode($recipe->instructions),
          "prox_attentions"=>$recipe->prox_attention,
        ];
        return response()
                ->json(['status' => '200', 
                    'message' => 'Ok',
                    'recipe' => $info]);
      }else{
        return response()
                ->json(['status' => '402', 
                    'message' => 'Esta cita no tiene una receta asignada']);
      }      
    }else{
      return response()
                ->json(['status' => '404', 
                    'message' => 'No se encontró la cita solicitada']);
    }
  }

  public function cancel_appointment(Request $request){
    $user = User::find($request->user_id);
    if($user->role != 1){
      return response()
        ->json(['status' => '404', 
            'message' => 'Solo usuarios con rol de doctor pueden cancelar citas']); 
    }else{
      $doctor = $user->doctor;
      $app = Appointment::find($request->appointment_id);
      if($app->doctor_id !=  $doctor->id){
        return response()
        ->json(['status' => '404', 
            'message' => 'El usuario solicitado no es doctor de la cita médica']); 
      }else{
        $app->status = 3;
        $app->save();
        return response()
        ->json(['status' => '200', 
            'message' => 'Ok']); 
      }
    }
  }

}
