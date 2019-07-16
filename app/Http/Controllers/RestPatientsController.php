<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\Http\Requests;
use App\Appointment;
use App\Tcall;
use App\Attention;
use App\Doctor;
use App\Specialty;
use App\Service;
use App\Partner_service;
use App\Partner;
use App\Dservice;


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

    public function get_data($user_id){
    	$user = User::find($user_id);
	    if($user->role != 3){
	        return response()
	          ->json(['status' => '404', 
	              'message' => 'El usuario solicitado no es un usuario con rol de paciente']); 
	    }else{
	        $patient = $user->patient;
			if(!$patient){
	    		return response()
					->json(['status' => '404', 
							'message' => 'No se encontro el paciente solicitado']);	
	    	}
	    	$user_patient = $patient->user;
	    	return response()
					->json(['status' => '200', 
							'message' => 'Ok',
							'content' => $patient]);
    	}
    }

    public function profile(Request $request){
    	$user = User::find($request->user_id);
    	if($user->role != 3){
	        return response()
	          ->json(['status' => '404', 
	              'message' => 'El usuario solicitado no es un usuario con rol de paciente']); 
	    }else{
	    	$patient = $user->patient;
	    	if($user != null ){   
	    		$data = $request->all();
		        unset($data['user_id']);
		        unset($data['token']);
		        $i = 0;
		        foreach ($data as $key => $value) {
		           if( $value == '' || $value == ' ' ){
		           }else{
		           	if($i< 5){
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
		           		if($user->$key != $data[$key] ){
		           			if($key == "password"){
		           				$user->$key=bcrypt($data[$key]);    
		           			}else{
		           				$user->$key=$data[$key];    
		           			}
		            	}
		           	}else{
		           		if($patient->$key != $data[$key] ){
		                	$patient->$key=$data[$key];    
		            	}
		           	}
		           }
		           $i = $i +1 ;
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

    public function update_status_appointment(Request $request){
    	
    	$app = Appointment::find($request->app_id);
    	if(!$app){
    		return response()
				->json(['status' => '404', 
						'message' => 'No se encontro la cita solicitada']);	
    	}
    	$app->status = $request->new_status;
    	$app->save();
    	return response()
				->json(['status' => '200', 
						'message' => 'Ok']);
    }

	public function inbox(Request $request){
		$inbox = New Tcall;
		$data = $request->all();
		unset($data['token']);
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
           		if($key == "user_id"){
           			$user = User::find($data['user_id']);
           			if($user->role != 3){
				        return response()
				          ->json(['status' => '404', 
				              'message' => 'El usuario solicitado no es un usuario con rol de paciente']); 
				    }else{
				    	$patient = $user->patient;
	           			if(!$patient){
				    		return response()
								->json(['status' => '404', 
										'message' => 'No se encontro la data del paciente solicitado']);	
				    	}else{
				    		$inbox->patient_id = $patient->id;
				    	}	
				    }
           		}else{
           			$inbox->$key=$data[$key];   	
           		}
                
           	}
           }
        $inbox->save();
        return response()
				->json(['status' => '200', 
						'message' => 'Ok',
						'inbox' =>$inbox]);
	}

	public function unregisted_inbox(Request $request){
		$inbox = New Tcall;
		$data = $request->all();
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
    			$inbox->$key=$data[$key];   	
       		}     
       	}           
        $inbox->save();
        return response()
				->json(['status' => '200', 
						'message' => 'Ok',
						'inbox' =>$inbox]);
	}

	public function appointments(Request $request){
		$user = User::find($request->user_id);
	    if($user->role != 3){
	        return response()
	          ->json(['status' => '404', 
	              'message' => 'El usuario solicitado no es un usuario con rol de paciente']); 
	    }else{
	    	if($request->app_status>3){
	    		return response()
	          ->json(['status' => '404', 
	              'message' => 'No existe ese estado para una cita medica']); 
	    	}else{
	    		$patient = $user->patient;
				$atts = Attention::where('patient_id', $patient->id)->
				where('type', 1)->get();
				$matched_apps=[];
				foreach ($atts as $att) {
					$app = Appointment::where('attention_id',$att->id)->first();
					if($app){
						if($app->status == $request->app_status){
							$specialty = Specialty::find($app->specialty_id);
							$specialty_name =$specialty->name; 
							$doctor = doctor::find($app->doctor_id);
							$attention= $app->attention;
							if($request->app_status == 0){ //citas por confirmar solo las del futuro
								$then = $app->date_time;
					            $now = time();        
					            $thenTimestamp = strtotime($then);
					            $difference_seconds = $thenTimestamp-$now ;
					            if($difference_seconds>0){
					            	$matched_apps[]=[
					            	'app_id'=>$app->id,
									'specialty' => $specialty_name, 
									'doctor_name' =>$doctor->user->name,
									'date_time' =>$app->date_time,
									'latitude'=>$attention->att_latitude,
									'longitude'=>$attention->att_longitude,
									];
					            }
							}else{
								$matched_apps[]=[
								'app_id'=>$app->id,
								'specialty' => $specialty_name, 
								'doctor_name' =>$doctor->user->name,
								'date_time' =>$app->date_time,
								'latitude'=>$attention->att_latitude,
								'longitude'=>$attention->att_longitude,
								];
							}		
						}
					}
				}
				if($matched_apps==[]){
					return response()
						->json(['status' => '402', 
								'message' => 'no-results']);
				}else{
					return response()
						->json(['status' => '200', 
								'message' => 'Ok',
								'content' => $matched_apps]);
				}
	    	}
		}
	}

	public function services(){
        $services = Service::all();
        return response()
				->json(['status' => '200', 
						'message' => 'Ok',
						'content'=>$services]);
    }

    public function partners_by_service(Request $request){
        $service = Service::find($request->service_id);
        $partner_services = Partner_service::where('service_id', $request->service_id)->get();
        $matched_ps=[];
        foreach ($partner_services as $ps) {
            $partner = Partner::find($ps->partner_id);
            if($ps->active){
                $matched_ps[]=[
                'id'=>$ps->id,
                'partner_id'=>$ps->partner_id,
                'partner_name' =>$partner->partner_name,
                'service_cost'=>$ps->service_cost,
                'docdoor_cost'=>$ps->docdoor_cost,
                ];
            } 
        }
        return response()
				->json(['status' => '200', 
						'message' => 'Ok',
						'content'=>$matched_ps]);
    }


    public function store_dservices(Request $request){
        $data = $request->all();
        unset($data['token']);
        $d_service = New Dservice;
        $partner = Partner::find($data['partner_id']);
        $d_service->address_from= $partner->address;
        foreach ($data as $key => $value) {
            $d_service->$key = $data[$key] ;
        }
        $d_service->save();
        return response()
				->json(['status' => '200', 
						'message' => 'Ok',
						'content' =>$d_service]);
    }
}
