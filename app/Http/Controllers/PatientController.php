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
use App\History;
use App\Recipe;
use App\Medicine;
use App\Gmedicine;
use Auth;
use PDF;
use Culqi;

class PatientController extends Controller
{

    public function __construct() { $this->middleware('auth',['except' => ['payment_app','post_payment_app']]); }

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
                'genre'  => 'required',
            ];
            $messages1 = [
                'birth_at.required' => 'Es necesario ingresar una fecha de nacimiento para registrar a un paciente',
                'genre.required' => 'Es necesario seleccionar un genero para registrar a un paciente'
            ];
            if($request->role == 1){ //new_patient
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
        $patient->genre = $request->genre;
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
            $patient_option = $patient->user->dni." - ".$patient->user->name." ".$patient->user->last_name;
            $patients[] =array( 
                        "name" => $patient_option,
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
 
    public function update_location_appointment(Request $request){
      $attention = Attention::find($_POST['attention_id']);
      $app = $attention->appointment;
      $then = $app->date_time;
      $now = time();        
      $thenTimestamp = strtotime($then);
      $difference_seconds = $thenTimestamp-$now ;
      $gap_permited_in_seconds=86400; // 24hours in seconds
      if($difference_seconds>$gap_permited_in_seconds){
            $attention ->att_latitude = $_POST['att_latitude'];
            $attention ->att_longitude = $_POST['att_longitude'];
            $attention ->save();           
        return 1;          
      }else{
        return "No se puede editar la ubicacion de una cita con menos de 24 horas de anticipación a la hora de la cita";
        }
    }

    public function update_location_d_service(Request $request){
      $dservice = Dservice::find($_POST['ds_id']);
      $then = $dservice->created_at;
      $now = time();        
      $thenTimestamp = strtotime($then);
      $difference_seconds = $now-$thenTimestamp;
      $gap_permited_in_seconds=86400; // 24hours in seconds
      if($difference_seconds>$gap_permited_in_seconds){
            $dservice ->att_latitude = $_POST['att_latitude'];
            $dservice ->att_longitude = $_POST['att_longitude'];
            $dservice ->save();           
        return 1;          
      }else{
        return "No se puede editar la ubicacion de un servicio doc_door despues de 24 horas de la solicitud del servicio";
        }
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
        if($data['type'] == 1){
            $tipo = "cita médica";
        }else{
            $tipo = "emergencia";
        }
        $message = [
                    "title"=>"Nuevo Inbox de ".$tipo." enviado",
                    "content"=>"con el mensaje: ".$data['message'],
                    "type"=> $data['type']
                ];
        return view('patients_options.patients_main')->with(compact('message'));
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
                'att_id'=>$att->id,
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
              $recipe = Recipe::where('appointment_id',$app->id)->first();
              if($app->status == 2 || $app->status == 3){
                $specialty = Specialty::find($app->specialty_id);
                $specialty_name =$specialty->name; 
                $doctor = Doctor::find($app->doctor_id);
                $intervals = explode(' ',$app->date_time);
                $matched_apps[]=[
                'id'=>$app->id,
                'att_id'=>$app->attention->id,
                'specialty' => $specialty_name, 
                'doctor_name' =>$doctor->user->name,
                'date' =>$intervals[0],
                'time'=>$intervals[1],
                'status'=> $app->status,
                'recipe'=> $recipe,
                ]; 
                }  
            }
        }
        $app_status =2;
        return view('patients_options.appointments')->with(compact('matched_apps','app_status'));
    }

    
    public function attention_report($att_id){
        
        $attention = Attention::find($att_id);
        $attention_code = trim($attention->attention_code);
        $url_pdf = "images/exports/reporte_de_atencion_".Auth::user()->patient->user->dni."-".$attention_code.".pdf";

        $hoy = getdate();
        $app = $attention->appointment;
        $patient = Patient::find($attention->patient_id);
        $user = $patient->user;
        $date=[];
        $doctor_name = "";
        $instructions = "";
        $medicines = [];
        if($app){
            $date = explode(' ', $app->date_time);
            $header_type = 1;
            if($app->specialty_id > 2){
                $type = "especialidad";    
            }else{
                $type = "atención común"; 
            }
           $doctor = Doctor::find($app->doctor_id)->user;
           $doctor_name = "Dr. ".$doctor->name." ".$doctor->last_name;
           $recipe = Recipe::where('appointment_id',$app->id)->first();
           if($recipe){
               $instructions = $recipe->instructions;
               $all_medicines = json_decode($recipe->medicines);
               foreach ($all_medicines as $key => $value) {
                   $med = Medicine::find($value->id);
                   $group = Gmedicine::find($med->medicine_group);
                   $medicines[]=$group->group_name." - ".$med->name;
               } 
           }else{
                $instructions = "No hubo receta médica";
           }
           
        }else{
            $header_type = 0;
            $emer = $attention->emergency;
            if($emer){
                $type = "urgencia";
            }else{
                $type = "emergencia";
            }
        } 
        $anam = History::where('attention_id',$attention->id)->first();
        $anam = $anam->anamnesis;
        $all_instructions = json_decode($recipe->instructions);
        $instructions = [];
        foreach ($all_instructions as $key => $value) {
            if($value->id == 0){
                $name = " - ";
            }else{
                $name = Medicine::find($value->id)->name." : "; 
            }
            $instructions[]=$name.$value->instructions;
        }
        $info =[
            'date'=> $date[0],
            'id'=>$attention->id,
            'vigencia' => $hoy['month']." ".$hoy['year'],
            'type' => $type,
            'header_type'=> $header_type,
            'pat_name'=>$user->name." ".$user->last_name,
            'pat_age'=> 20,
            'pat_dni'=>$user->dni,
            'doctor'=>$doctor_name,
            'instructions'=>$instructions,
            'medicines'=>$medicines,
            'anamnesis'=>$anam,
        ];
        
        return view('patients_options.attention_report')->with(compact('attention','url_pdf','info'));
    }


    public function aaaa($id){
        $attention = Attention::find($id);
        $hoy = getdate();
        $app = $attention->appointment;
        $patient = Patient::find($attention->patient_id);
        $user = $patient->user;
        $date=[];
        $doctor_name = "";
        $instructions = "";
        $medicines = [];
        if($app){
            $date = explode(' ', $app->date_time);
            $header_type = 1;
            if($app->specialty_id > 2){
                $type = "especialidad";    
            }else{
                $type = "atención común"; 
            }
           $doctor = Doctor::find($app->doctor_id)->user;
           $doctor_name = "Dr. ".$doctor->name." ".$doctor->last_name;
           $recipe = Recipe::where('appointment_id',$app->id)->first();
           if($recipe){
               $instructions = $recipe->instructions;
               $all_medicines = json_decode($recipe->medicines);
               foreach ($all_medicines as $key => $value) {
                   $med = Medicine::find($value->id);
                   $group = Gmedicine::find($med->medicine_group);
                   $medicines[]=$group->group_name." - ".$med->name;
               } 
           }else{
                $instructions = "No hubo receta médica";
           }
           
        }else{
            $header_type = 0;
            $emer = $attention->emergency;
            if($emer){
                $type = "urgencia";
            }else{
                $type = "emergencia";
            }
        } 
        $anam = History::where('attention_id',$attention->id)->first();
        $anam = $anam->anamnesis;
        $all_instructions = json_decode($recipe->instructions);
        $instructions = [];
        foreach ($all_instructions as $key => $value) {
            if($value->id == 0){
                $name = " - ";
            }else{
                $name = Medicine::find($value->id)->name." : "; 
            }
            $instructions[]=$name.$value->instructions;
        }
        $info =[
            'date'=> $date[0],
            'id'=>$attention->id,
            'vigencia' => $hoy['month']." ".$hoy['year'],
            'type' => $type,
            'header_type'=> $header_type,
            'pat_name'=>$user->name." ".$user->last_name,
            'pat_age'=> 20,
            'pat_dni'=>$user->dni,
            'doctor'=>$doctor_name,
            'instructions'=>$instructions,
            'medicines'=>$medicines,
            'anamnesis'=>$anam,
        ];

        $html = view('patients_options.pdf_attention_report',compact('attention','url_pdf','info'))->renderSections()['content'];
        PDF::SetTitle('Reporte de atencion');
        PDF::SetFont('helvetica', '', 11);
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, 'C');

        PDF::Output('reporte_de_atencion_'.rtrim($attention->attention_code).'.pdf','D'); // I
    }

    public function recipe_report($app_id){
        $recipe = Recipe::where('appointment_id', $app_id)->first();
        $app = Appointment::find($app_id);
        $attention = $app->attention;
        if($recipe){
            $prox_attention = $recipe->prox_attention;
            $all_medicines = json_decode($recipe->medicines);
            $medicines =[];
            foreach ($all_medicines as $key => $value) {
                $med = Medicine::find($value->id);
                $medicines[] = $med->name." (".$med->brand.") ".$med->dosis." ".
                $med->presentation." ".$med->quantity;
            }
            
            $all_instructions = json_decode($recipe->instructions);
            $instructions = [];
            foreach ($all_instructions as $key => $value) {
                if($value->id == 0){
                    $name = " ";
                }else{
                    $name = Medicine::find($value->id)->name." : "; 
                }
                $instructions[]=$name.$value->instructions;
            }

        }
        $hoy = getdate();
        $date = explode(' ', $app->date_time);

        $info=[
            'att_id'=>$app->id,
            'id'=>$recipe->id,
            'attention_code' => $attention->attention_code,
            'doctor-name' => $app->doctor->user->name." ".$app->doctor->user->last_name,            
            'patient-name'=>$attention->patient->user->name." ".$attention->patient->user->last_name,
            'dni'=>$attention->patient->user->dni,
            'instructions'=>$instructions,
            'medicines'=>$medicines,
            'prox_attention'=>$prox_attention,
            'vigencia' => $hoy['month']." ".$hoy['year'],
            'date'=>$date[0],
        ];
        return view('patients_options.recipe_report')->with(compact('info','url_pdf'));
    }

    public function pdf_recipe($app_id){
        $recipe = Recipe::where('appointment_id', $app_id)->first();
        $app = Appointment::find($app_id);
        $attention = $app->attention;
        if($recipe){
            $prox_attention = $recipe->prox_attention;
            $all_medicines = json_decode($recipe->medicines);
            $medicines =[];
            foreach ($all_medicines as $key => $value) {
                $med = Medicine::find($value->id);
                $medicines[] = $med->name." (".$med->brand.") ".$med->dosis." ".
                $med->presentation." ".$med->quantity;
            }
            
            $all_instructions = json_decode($recipe->instructions);
            $instructions = [];
            foreach ($all_instructions as $key => $value) {
                if($value->id == 0){
                    $name = " ";
                }else{
                    $name = Medicine::find($value->id)->name." : "; 
                }
                $instructions[]=$name.$value->instructions;
            }

        }
        $hoy = getdate();
        $date = explode(' ', $app->date_time);

        $info=[
            'att_id'=>$app->id,
            'id'=>$recipe->id,
            'attention_code' => $attention->attention_code,
            'doctor-name' => $app->doctor->user->name." ".$app->doctor->user->last_name,            
            'patient-name'=>$attention->patient->user->name." ".$attention->patient->user->last_name,
            'dni'=>$attention->patient->user->dni,
            'instructions'=>$instructions,
            'medicines'=>$medicines,
            'prox_attention'=>$prox_attention,
            'vigencia' => $hoy['month']." ".$hoy['year'],
            'date'=>$date[0],
        ];
        $html = view('patients_options.recipe_report')->with(compact('info','url_pdf'))->renderSections()['content'];
        PDF::SetTitle('Reporte de Receta Medica');
        PDF::SetFont('helvetica', '', 11);
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, 'L');

        PDF::Output('reporte_de_Receta_Medica_'.rtrim($attention->attention_code).'.pdf','D'); // I
    }


    public function services(){
        $all_services = Service::all();
        $services =[];
        foreach ($all_services as $key => $value) {
            $num_partners = count(Partner_service::where('service_id',$value->id)->get());
            if($num_partners>0){
                $services[]=$value;
            }
        }
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
        $message = null;
        return view('patients_options.partners_by_service')->with(compact('matched_ps','service','message'));
    }

    public function add_dservices($service_id, $partner_id, $cost){
        $partner = Partner::find($partner_id);
        $service = Service::find($service_id);
        return view('patients_options.add_dservices')->with(compact('service','partner','cost')); 
    }


    public function store_dservices(Request $request){
        $data = $request->all();
        //dd($data);
        unset($data['_token']);
        $d_service = New Dservice;
        $d_service->user_id = Auth::user()->id;
        $partner = Partner::find($data['partner_id']);
        $d_service->address_from= $partner->address;
        $d_service->cost =(float)$request->cost;
        foreach ($data as $key => $value) {
            $d_service->$key = $data[$key] ;
        }

        $d_service->save();
        $d_service->token_pay = str_replace("/","-",bcrypt(date("ymdHis").$d_service->id));
        
        $d_service->save();
        $service = Service::find($data['service_id']);
        $message = [
                    "title"=>"Solicitud de servicio DocDoor creada",
                    "content"=>"para el servicio:  \"".$service->service_name. "\" al asociado: \"". $partner->partner_name."\"",
                    "type"=>""
                ];
        $all_dservices = Dservice::all();
        $dservices = [];
        foreach ($all_dservices as $key => $value) {
            $patient_user = User::find($value->user_id);
            if($patient_user->id == Auth::user()->id){
                $service = Service::find($value->service_id);
                $partner = Partner::find($value->partner_id);

                $dservices[] = [
                    'id'=>$value->id,
                    'service_name'=>$service->service_name,
                    'partner_name'=>$partner->partner_name,
                    'address_from'=>$value->address_from,
                    'address_to'=>$value->address_to,
                    'payment_status'=>$value->payment_status,
                    'complete'=>$value->complete,
                    'token_pay'=>$value->token_pay,
                    'cost'=> $value->cost,
                    'created_at'=>$value->created_at
                ];
            }
        }
        return view('patients_options.my_d_services')->with(compact('message','dservices'));
    }
    public function patient_histories()
    {
        $histories = History::all();
        $matched_histories = [];
        foreach ($histories as $hist) {
            if($hist->attention->patient->user->id == Auth::user()->id){
                
                $date_parts =explode(' ', $hist->attention->appointment->date_time); 
                $matched_histories[]=[
                    'id' => $hist->id,
                    'attention_code' => $hist->attention->attention_code,
                    'doctor_name' => $hist->attention->appointment->doctor->user->name,
                    'date'=> $date_parts[0],
                    'time'=> $date_parts[1],
                    'pdf_status'=>$hist->pdf_status,
                ];
            }
        }  
        return view('patients_options.histories_by_patient')->with(compact('matched_histories'));
    }    

    public function app_detail($id){
        $attention = Attention::find($id);
        $s_attention = $attention->appointment;
        //dd($s_attention);
        $specialty = $s_attention->specialty;
        //dd($specialty);
        $user_doctor =$s_attention->doctor->user;
        $user_patient = $attention->patient->user;
        return view('patients_options.app_detail')->with(compact('s_attention','attention','user_patient','specialty','user_doctor'));
    }
    function calculaedad($fechanacimiento){
      list($ano,$mes,$dia) = explode("-",$fechanacimiento);
      $ano_diferencia  = date("Y") - $ano;
      $mes_diferencia = date("m") - $mes;
      $dia_diferencia   = date("d") - $dia;
      if ($dia_diferencia < 0 || $mes_diferencia < 0)
        $ano_diferencia--;
      return $ano_diferencia;
    }

    public function history_info($id){
        $history = History::find($id);
        $date_parts =explode(' ', $history->attention->appointment->date_time);
        if($history->attention->patient->user->genre == 0){
            $genre = "F";
        }else{
            $genre = "M";
        }
        $age = $this->calculaedad($history->attention->patient->birth_at);
        $recipe = Recipe::where('appointment_id',$history->attention->appointment->id)->first();
        
        if($recipe){
            $prox_attention = $recipe->prox_attention;
            $all_medicines = json_decode($recipe->medicines);
            $medicines =[];
            foreach ($all_medicines as $key => $value) {
                $medicines[] = $value->quantity." : ".Medicine::find($value->id)->name;
            }
            $all_instructions = json_decode($recipe->instructions);
            $instructions = [];
            foreach ($all_instructions as $key => $value) {
                if($value->id == 0){
                    $name = " - ";
                }else{
                    $name = Medicine::find($value->id)->name." : "; 
                }
                $instructions[]=$name.$value->instructions;
            }
        }
        $personal=[];
        $all_personal = json_decode($history->personal_antecedents);
        foreach ($all_personal as $key => $value) {
            foreach ($value as $key1 => $value1) {
                $subtitle = $key1." : ";
                $enf = "";
                if($key1 == "Vacunas"){
                    $enf = $enf." - ".$value1;
                }else{
                    for ($i=0; $i < count($value1) ; $i++) { 
                    $enf = $enf." - ".$value1[$i];
                    }    
                }                
                $personal[] = $subtitle.$enf;
            }
            
        }
        $family = [];
        $all_family = json_decode($history->family_antecedents);
        foreach ($all_family as $key => $value) {
             foreach ($value as $key1 => $value1) {
                $subtitle = $key1." : ";
                $enf = "";
                if($key1 == "Padre" || $key1 == "Madre" ){
                    for ($i=0; $i < count($value1) ; $i++) { 
                    $enf = $enf." - ".$value1[$i];
                    }
                }else{
                    $enf = $enf." - ".$value1[0];
                    if($value1[1] != 0){
                        foreach ( $value1[2] as $key2 => $value2) {
                            $enf = $enf." ** ";
                            foreach ($value2 as $key3 => $value3) {
                                $enf = $enf."  ".$value3;       
                            }
                        }
                    }
                }
                $family[] = $subtitle.$enf;
             }
        }
        $info=[
            'id'=>$history->id,
            'attention_code' => $history->attention->attention_code,
            'doctor_name' => $history->attention->appointment->doctor->user->name,
            'date'=> $date_parts[0],
            'time'=> $date_parts[1],
            'motive'=>$history->attention->motive,
            'anamnesis'=>$history->anamnesis,
            'patient-name'=>$history->attention->patient->user->name." ".$history->attention->patient->user->last_name,
            'patient-age'=>$age,
            'patient-genre'=>$genre,

            'weight'=>$history->weight,
            'height'=>$history->height,
            'cardiac_frequency'=>$history->cardiac_frequency,
            'breathing_frequency'=>$history->breathing_frequency,
            'temperature'=>$history->temperature,
            'arterial_pressure'=>$history->arterial_pressure,
            'sato'=>$history->sato,

            'personal_antecedents'=>$personal,
            'family_antecedents'=>$family,

            'sub_0'=>$history->sub_0,
            'sub_1'=>$history->sub_1,
            'sub_2'=>$history->sub_2,
            'sub_3'=>$history->sub_3,
            'sub_4'=>$history->sub_4,
            'sub_5'=>$history->sub_5,
            'sub_6'=>$history->sub_6,
            'sub_7'=>$history->sub_7,
            'sub_8'=>$history->sub_8,
            'sub_9'=>$history->sub_9,

            'aux_exams'=>$history->aux_exams,
            'diagnosis_impresion'=>$history->diagnosis_impresion,

            'instructions'=>$instructions,
            'medicines'=>$medicines,
            'prox_attention'=>$prox_attention,

            'pdf_status'=>$history->pdf_status,
        ];
        return $info;
    }
    public function patient_histories_detail($id)
    {
        $history = History::find($id);
        $info = $this->history_info($id);
        $att_code = rtrim($history->attention->attention_code);
        
        return view('patients_options.history_detail')->with(compact('info'));
    }

    public function pdf_history($id){
        $history = History::find($id);
        $info = $this->history_info($id);
        $att_code = rtrim($history->attention->attention_code);

        $html = view('patients_options.history_report')->with(compact('info'))->renderSections()['content'];

        PDF::SetTitle('Reporte de Historia Clinica');
        PDF::SetFont('helvetica', '', 11);
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        PDF::AddPage();
        PDF::writeHTML($html, true, false, true, false, 'C');

        PDF::Output('reporte_de_Historia_Clinica_'.rtrim($att_code).'.pdf','D'); // I
    }

    public function request_pdf($id){
        $history = History::find($id);
        $history->pdf_status = 1;
        $history->save();
        $message = [
                    "title"=>"Solicitud de permiso enviado",
                    "content"=>"para la historia clínica con código de atención: \"". $history->attention->attention_code."\"",
                    "type"=>0,
                ];
        return view('patients_options.patients_main')->with(compact('message'));
    }

    public function redirect(){
        return redirect('/clinic_histories');
    }

    public function payment(Request $request){ 
      if($request->tokenPay == "used"){
        return "El token de pago ya ha sido usado.";
      } else{
        $SECRET_KEY = "sk_test_ctxwx9WnIVnhIR26";
      
          $culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));
          $charge = $culqi->Charges->create(
          array(
             "amount" => $request->cost,
             "capture" => true,
             "currency_code" => "PEN",
             "description" => $request->descp,
             "email" => $request->email,
             "installments"=>0,
             "source_id" => $request->token_pay,
           )
          );
          $dservice = Dservice::where('token_pay',$request->tokenPay)->first();
          $dservice->payment_status = true;
          $dservice->token_pay = "used";
          $dservice->save();

          $message = "De la compra de: ".$request->descp." por: s/. ".($request->cost/100). " nuevos soles. ";
          return $message;
      } 
      
    }

    public function payment_app($token){
        $dservice = Dservice::where('token_pay',$token)->first();
        if($dservice){
          if($dservice->payment_status == true){
            return "Esta solicitud ya ha sido pagada";
          }else{
        $service = Service::find($dservice->service_id);
        $partner = Partner::find($dservice->partner_id);
        
        $description = "\"".$service->service_name." con el Proveedor ".$partner->partner_name."\"";
        $cost = ($dservice->cost)*100; 
        $tokenPay = "\"".$token."\"";
        return view('patients_options.payment_form')->with(compact('description','cost','tokenPay'));}
        }else{
            return "Token invalido: no se encontró la solicitud";
        }
    }

    public function post_payment_app(Request $request){ 
    $dservice = Dservice::where('token_pay',$request->tokenPay)->first();
    if($dservice){
      if($dservice->payment_status == true){
        return "Esta solicitud ya ha sido pagada";
      }else{
        $SECRET_KEY = "sk_test_ctxwx9WnIVnhIR26";
      
      $culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));
      $charge = $culqi->Charges->create(
      array(
         "amount" => $request->cost,
         "capture" => true,
         "currency_code" => "PEN",
         "description" => $request->descp,
         "email" => $request->email,
         "installments"=>0,
         "source_id" => $request->token_pay,
       )
      ); 
      
      $dservice->payment_status = true;
      $dservice->token_pay = "used";
      $dservice->save();

      $message = "De la compra de: ".$request->descp." por: s/. ".($request->cost/100). " nuevos soles. ";
      return $message;
      }      
    }else{
        return "Token invalido: no se encontró la solicitud";
    }
      
    }

    public function my_d_services(){
        $new = null;
        $all_dservices = Dservice::all();
        $dservices = [];
        foreach ($all_dservices as $key => $value) {
            $patient_user = User::find($value->user_id);
            if($patient_user->id == Auth::user()->id){
                $service = Service::find($value->service_id);
                $partner = Partner::find($value->partner_id);

                $dservices[] = [
                    'id'=>$value->id,
                    'service_name'=>$service->service_name,
                    'partner_name'=>$partner->partner_name,
                    'address_from'=>$value->address_from,
                    'address_to'=>$value->address_to,
                    'payment_status'=>$value->payment_status,
                    'complete'=>$value->complete,
                    'token_pay'=>$value->token_pay,
                    'cost'=> $value->cost,
                    'created_at'=>$value->created_at
                ];
            }
        }
        $message = NULL;
        return view('patients_options.my_d_services')->with(compact('new','dservices','message'));
    }
}
