<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Patient;
use App\User;
use App\Doctor;
use App\Specialty;
use App\Http\Requests;
use App\Attention;
use App\Appointment;
use App\Tcall;
use App\Service;
use App\Partner_service;
use App\Partner;
use App\Dservice;
use Auth;

class PatientController extends Controller
{
    public function index()
 	{
   		$users = DB::table('patients')
                    ->join('users','patients.user_id','=','users.id')
                    ->get();
        $new = NULL;   
        return view('patients.patient_index')->with(compact('users','new'));
    }
    
    public function detail ($id){
    	$user = User::find($id);
        if($user->avatar == "default.png"){
            $url_image = "/images/".Auth:: user()->avatar;
        }else{
            $url_image = "/images/uploads/".Auth:: user()->avatar;
        }
        $s_user = $user->patient;         
        return view('users.user_profile')  ->with(compact('user','url_image','s_user'));
    }

    public function add($type){
        return view('patients.new_patient')->with(compact('type'));
    }

    public function store(Request $request){
    	$rules = [
                'name' => 'required|min:2|max:255',
                'last_name' => 'required|min:2|max:255',
                'dni' => 'required|size:8|unique:users',
                'cellphone' => 'required',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6'
            ];
            $messages = [
                'name.required' => 'Es necesario ingresar un nombre para registrar a un usuario',
                'name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
                'name.max' => 'Campo "Nombre" es demasiado extenso.',

                'last_name.required' => 'Es necesario ingresar un apellido para registrar a un usuario',
                'last_name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Apellido".',
                'last_name.max' => 'Campo "Apellido" es demasiado extenso.',
                
                'dni.required' => 'Es necesario ingresar un DNI para registrar a un usuario',
                'dni.size' => 'El DNI debe tener 8 digitos',
                'dni.unique' => 'Ya existe un usuario registrado con este DNI',

                'cellphone.required' => 'Es necesario ingresar un número de celular para registrar a un usuario',

                'role.required' => 'Es necesario ingresar un rol para registrar a un usuario',
                
                'email.required' => 'Es necesario ingresar un email para registrar a un usuario.',
                'email.email' => 'Ingrese un email válido.',
                'email.max' => 'Campo "E-mail" es demasiado extenso.',
                'email.unique' => 'Este email ya está en uso',
                
                'password.required' => 'Es necesario ingresar una contraseña para registrar a un usuario.',
                'password.min' => 'Ingrese como mínimo 6 caracteres en el campo "Contraseña".'
            ];

            $this->validate($request, $rules, $messages);      
            $rules1 = [
                'birth_at' => 'required',
            ];
            $messages1 = [
                'birth_at.required' => 'Es necesario ingresar una fecha de nacimiento para registrar a un doctor',
            ];
            if($request->role == 1){ //new_doctor
                $this->validate($request, $rules1, $messages1);       
            }
    	$user = New User;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->dni =  $request->dni;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->cellphone = $request->cellphone;
        $user->role =  3;
        $user->name_role = "paciente";
        $user->validated = 1;
        $user->save();

        $patient = New Patient;
        $patient->user_id = $user->id;
        $patient->patient_code = "P-".$user->id."-".str_random(4);
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
        $users = DB::table('patients')
                    ->join('users','patients.user_id','=','users.id')
                    ->get();
        $new = $user; 
        if($request->Registrar){
            $specialties = Specialty::all();
            $u_doctors = Doctor::all();
            foreach ($u_doctors as $doctor) {
                $doctors[] =array(
                        "name" => $doctor->user->name,
                        "id" => $doctor->user->id,
                    );     
            }
            $patients[] = array(
                        "name" => $patient->user->name,
                        "id" => $patient->user->id,
                    ); 
            $one=1;
            return view('appointments.new_appointment')->with(compact('patients', 'doctors','specialties','one'));
        }  else{
            return view('patients.patient_index')->with(compact('users','new'));    
        }
    }

    public function update($id){
    	$user = User::find($id);
    	$patient = $user->patient;  
    	return view('patients.patient_edit')->with(compact('user','patient'));
    }

    public function store_update(Request $request){
    	$user = User::find($request->id);
        $data = $request->all();
        $error = NULL;
        unset($data['_token']);
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
					        	$error = "el email ya esta en uso";
					        }
	           			}
                		$user->$key=$data[$key];
                	}
	           	}else{
	           		$patient = $user->patient;  
	           		if($patient->$key != $data[$key] ){
                	$patient->$key=$data[$key];}
                	$patient->save();
	           	}	           	
           }
        }
    	$user->save();
    	return redirect('/patients');
    }

    public function delete($id)
    {
    	$user = User::find($id);
        $patient = $user->patient;  
     	Patient::destroy($patient->id);
        User::destroy($id);
        return redirect('/patients');
    }

    public function update_status_appointment($app_id,$new_status){  
        $app = Appointment::find($app_id);
        if($app){
            if($new_status == 3){
                $then = $app->date_time;
                $now = time();        
                $thenTimestamp = strtotime($then);
                $difference_seconds = $thenTimestamp-$now ;
                $gap_permited_in_seconds=86400; // 24hours in seconds
                if($difference_seconds>$gap_permited_in_seconds){
                    $app->status = $new_status;
                    $app->save();
                    return redirect('/patients/history_appointments');
                }else{
                    return redirect('/patients/appointments/0');
                }   
            }
            else{
                $app->status = $new_status;
                $app->save();
                return redirect('/patients/appointments/'.$new_status);
            }
        }
    } 

    public function inbox_emergency(){
        return view('patients_options.new_inbox_emergency');     
    }

    public function inbox_appointment(){
        return view('patients_options.new_inbox_appointment');     
    }

    public function inbox(Request $request){
        $inbox = New Tcall;
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
                $inbox->$key=$data[$key]; 
            }
        }
        $user = User::find(Auth::user()->id);
        $inbox->patient_cell = $user->cellphone;
        $inbox->patient_id = $user->patient->id;
        $inbox->save();
        return redirect('/');
    }  

    public function appointments($app_status){
        $user = User::find(Auth::user()->id);
        $patient = $user->patient;
        $atts = Attention::where('patient_id', $patient->id)->
        where('type', 1)->get();
        $matched_apps=[];
        foreach ($atts as $att) {
            $app = Appointment::where('attention_id',$att->id)->first();
            if($app){
              if($app->status == $app_status){
                $specialty = Specialty::find($app->specialty_id);
                $specialty_name =$specialty->name; 
                $doctor = Doctor::find($app->doctor_id);
                $intervals = explode(' ',$app->date_time);
                $matched_apps[]=[
                'id'=>$app->id,
                'specialty' => $specialty_name, 
                'doctor_name' =>$doctor->user->name,
                'date' =>$intervals[0],
                'time'=>$intervals[1],
                ]; 
                }  
            }
        }
        return view('patients_options.appointments')->with(compact('matched_apps','app_status'));
    }

    public function history_appointments(){
        $user = User::find(Auth::user()->id);
        $patient = $user->patient;
        $atts = Attention::where('patient_id', $patient->id)->
        where('type', 1)->get();
        $matched_apps=[];
        foreach ($atts as $att) {
            $app = Appointment::where('attention_id',$att->id)->first();
            if($app){
              if($app->status == 2 || $app->status == 3){
                $specialty = Specialty::find($app->specialty_id);
                $specialty_name =$specialty->name; 
                $doctor = Doctor::find($app->doctor_id);
                $intervals = explode(' ',$app->date_time);
                $matched_apps[]=[
                'id'=>$app->id,
                'specialty' => $specialty_name, 
                'doctor_name' =>$doctor->user->name,
                'date' =>$intervals[0],
                'time'=>$intervals[1],
                'status'=> $app->status,
                ]; 
                }  
            }
        }
        $app_status =2;
        return view('patients_options.appointments')->with(compact('matched_apps','app_status'));
    }

    public function services(){
        $services = Service::all();
     return view('patients_options.services_index')->with(compact('services'));   
    }

    public function partners_by_service($service_id){
        $service = Service::find($service_id);
        $partner_services = Partner_service::where('service_id', $service_id)->get();
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
        return view('patients_options.partners_by_service')->with(compact('matched_ps','service'));
    }

    public function add_dservices($service_id, $partner_id){
        $partner = Partner::find($partner_id);
        $service = Service::find($service_id);
        return view('patients_options.add_dservices')->with(compact('service','partner')); 
    }


    public function store_dservices(Request $request){
        $data = $request->all();
        unset($data['_token']);
        $d_service = New Dservice;
        $d_service->user_id = Auth::user()->id;
        $partner = Partner::find($data['partner_id']);
        $d_service->address_from= $partner->address;
        foreach ($data as $key => $value) {
            $d_service->$key = $data[$key] ;
        }
        $d_service->save();
        return redirect('/');
    }
}
