<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Attention;
use App\User;
use App\Patient;
use App\Doctor;
use App\Appointment;
use App\Specialty;
use App\Schedule;
use App\History;
use App\Recipe;
use App\Medicine;
use App\Espschedule;

class AppointmentController extends Controller
{
    
    public function ajax_get_doctors(){
        $u_doctors = Doctor::all();
        $doctors=[];
        foreach ($u_doctors as $doctor) {
            if($doctor->specialty_id == $_POST['valor1']){
                $schedule= Schedule::find($doctor->schedule_id);
                 if($schedule){
                    $schedule_info = $schedule->schedule;

                 }else{
                    $schedule_info = "[{\"day\":\"lunes\",\"schedule_start\":\"\",\"schedule_end\":\"\"},{\"day\":\"martes\",\"schedule_start\":\"\",\"schedule_end\":\"\"},{\"day\":\"miercoles\",\"schedule_start\":\"\",\"schedule_end\":\"\"},{\"day\":\"jueves\",\"schedule_start\":\"\",\"schedule_end\":\"\"},{\"day\":\"viernes\",\"schedule_start\":\"\",\"schedule_end\":\"\"},{\"day\":\"sabado\",\"schedule_start\":\"\",\"schedule_end\":\"\"},{\"day\":\"domingo\",\"schedule_start\":\"\",\"schedule_end\":\"\"}]";
                 }

                $doctors[] =array(
                        "name" => $doctor->user->dni." - ".$doctor->user->name." ".$doctor->user->last_name,
                        "id" => $doctor->user->id,
                        "specialty"=>$doctor->specialty_id,
                        "schedule"=>$schedule_info,
                        "latitude"=>$doctor->doctor_latitude,
                        "longitude"=>$doctor->doctor_longitude,
                    );     
            }
        }
        return $doctors;
    }
    
    public function day_to_number($input_date){
       $timestamp = strtotime($input_date);
       $requested_day = date('D', $timestamp);
       $dayToNumber=[
        "Mon"=>0,   "Tue"=>1,   "Wed"=>2,   "Thu"=>3,
        "Fri"=>4,   "Sat"=>5,   "Sun"=>6,
        ]; 
        return $dayToNumber[$requested_day];
    }

    public function validate_medico_general($user_id,$input_date){
        $user = User::find($user_id);
        $doctor = $user->doctor;
        $schedule = json_decode(Schedule::find($doctor->schedule_id)->schedule);
        $valid_days=[]; //where monday = 0
        foreach ($schedule as $key => $value) {
            if($value->schedule_start!=""){
                $valid_days[]=$key;
            }
        }
        if(in_array($this->day_to_number($input_date), $valid_days)){
            return 1;
        }else{
            return 0;
        }
    }

    public function validate_especialista($user_id,$input_date){
        //dd($input_date);
        $doctor_id = User::find($user_id)->doctor->id;
        $schedules = Espschedule::where('doctor_id',$doctor_id)->get(); 
        //$dates=[];
        foreach ($schedules as $key => $value) {
            //dd($value->date,$input_date);
            if ( $value->date == $input_date){
               // $dates[]=$value->date;
                return 1;
            }
        }
        return 0;
    }

    public function ajax_validate_date(){
        $then = $_POST['input_date'];
        $now = time();        
        $thenTimestamp = strtotime($then);
        $difference_seconds = $thenTimestamp-$now ;
        //return $difference_seconds ;
        if($difference_seconds+86400<0){
            return "No se puede reservar una cita en el pasado";
        }else{
            if($_POST['input_esp_id'] == 1){
                if($this->validate_medico_general($_POST['input_user_id'],$then)){
                    return 1;
                }else{
                    $user = User::find($_POST['input_user_id']);
                    $doctor_name = $user->name." ".$user->last_name;
                    $response =$doctor_name." no atiende ese día";
                    return $response;
                }
            }else{
                $input_date = explode(' ', $then);
                if($this->validate_especialista($_POST['input_user_id'],$input_date[0])){
                    return 1;
                }else{
                    $user = User::find($_POST['input_user_id']);
                    $doctor_name = $user->name." ".$user->last_name;
                    $response =$doctor_name." no atiende ese día";
                    return $response;
                }
            }
            return 1; // fecha valida
        }
    }

    public function val_time_general($user_id,$input_date,$input_time){
        $user = User::find($user_id);
        $doctor = $user->doctor;
        $doctor_name = $user->name." ".$user->last_name;
        $day = $this->day_to_number($input_date);
        $schedule = json_decode(Schedule::find($doctor->schedule_id)->schedule);
        $start = $schedule[$day]->schedule_start;
        $end =  $schedule[$day]->schedule_end;   
        $startTimestamp = strtotime($start);
        $endTimestamp = strtotime($end);
        $nowTimestamp = strtotime($input_time);
        $possible_end = $nowTimestamp+3600;
        if($nowTimestamp > $startTimestamp && $nowTimestamp < $endTimestamp){
            dd( 1);
        }else{
            $response =$doctor_name." no atiende en ese horario";
            dd($response);
        }
    }

   //Consulta de prueba: 
   //http://localhost:8000/val_t_especialista/2019-07-18/10:55:00/7
    public function val_time_especialidad($input_date, $input_time, $user_id){
        $user = User::find($user_id);
        $doctor = $user->doctor;
        $schedule = Espschedule::where('doctor_id',$doctor->id)->where('date',$input_date)->first();

        $start = $schedule->start_time;
        $end =  $schedule->end_time;
        $startTimestamp = strtotime($start);
        $endTimestamp = strtotime($end);
        $nowTimestamp = strtotime($input_time);
        if($nowTimestamp >= $startTimestamp && $nowTimestamp <= $endTimestamp){
            //chequear que no hay citas reservadas en ese horario
            $reserved_app = Appointment::where('doctor_id',$doctor->id)->where('status',1)->get();
            //dd($reserved_app);
            foreach ($reserved_app as $app) {
                $date_parts = explode(" ", $app->date_time);
                $start_app = strtotime($date_parts[1]);
                $end_app = strtotime($date_parts[1])+3600; // 1 hour in seconds
                //echo("S: ".$start_app);
                //echo(" E: ".$end_app);
                $possible_end = $nowTimestamp+3600;
                if($date_parts[0]== $input_date){
                    //echo("LA fecha");
                    //echo("hora: ".$nowTimestamp);
                    if(($nowTimestamp>=$start_app &&$nowTimestamp<=$end_app)|| ($possible_end>=$start_app &&$possible_end<=$end_app)){
                        $response ="El especialista tiene una cita confirmada en ese horario";
                        return $response;
                    }
                }
            }
            return 1;
        }else{
            $response ="El especialista no atiende en ese horario";
            return $response;
        }
    }
    
    public function ajax_validate_time(){
        $user = User::find($_POST['input_user_id']);
        $doctor_name = $user->name." ".$user->last_name;
        $doctor = $user->doctor;

        if($_POST['input_esp_id'] < 3){
            $day = $this->day_to_number($_POST['input_date']);
            $schedule = json_decode(Schedule::find($doctor->schedule_id)->schedule);
            $start = $schedule[$day]->schedule_start;
            $end =  $schedule[$day]->schedule_end; 
            $startTimestamp = strtotime($start);
            $endTimestamp = strtotime($end);
            $nowTimestamp = strtotime($_POST['input_time']);
            $possible_end = $nowTimestamp+3600;
            if($nowTimestamp >= $startTimestamp && $nowTimestamp <= $endTimestamp){
                //chequear que no hay citas reservadas en ese horario
                $reserved_app = Appointment::where('doctor_id',$doctor->id)->where('status',1)->get();
                //dd($reserved_app);
                foreach ($reserved_app as $app) {
                    $date_parts = explode(" ", $app->date_time);
                    //dd($date_parts);
                    $start_app = strtotime($date_parts[1]);
                    $end_app = strtotime($date_parts[1])+3600; // 1 hour in seconds
                    $possible_end = $nowTimestamp+3600;
                    if($date_parts[0]== $_POST['input_date']){                        
                        if(($nowTimestamp>=$start_app &&$nowTimestamp<=$end_app)|| ($possible_end>=$start_app &&$possible_end<=$end_app)){
                                $response ="El especialista tiene una cita confirmada en ese horario";                            
                            return $response;
                        }
                    }
                }
                return 1;
            }else{
                $response =$doctor_name." no atiende en ese horario";
                return $response;
            }
        }else{
            //comprobar si esta en el horario del especialista
            $schedule = Espschedule::where('doctor_id',$doctor->id)->where('date',$_POST['input_date'])->first();
            $start = $schedule->start_time;
            $end =  $schedule->end_time;
            $startTimestamp = strtotime($start);
            $endTimestamp = strtotime($end);
            $nowTimestamp = strtotime($_POST['input_time']);
            if($nowTimestamp >= $startTimestamp && $nowTimestamp <= $endTimestamp){
                //chequear que no hay citas reservadas en ese horario
                $reserved_app = Appointment::where('doctor_id',$doctor->id)->where('status',1)->get();
                //dd($reserved_app);
                foreach ($reserved_app as $app) {
                    $date_parts = explode(" ", $app->date_time);
                    //dd($date_parts);
                    $start_app = strtotime($date_parts[1]);
                    $end_app = strtotime($date_parts[1])+3600; // 1 hour in seconds
                    $possible_end = $nowTimestamp+3600;
                    if($date_parts[0]== $_POST['input_date']){                        
                        if(($nowTimestamp>=$start_app &&$nowTimestamp<=$end_app)|| ($possible_end>=$start_app &&$possible_end<=$end_app)){
                                $response ="El especialista tiene una cita confirmada en ese horario";                            
                            return $response;
                        }
                    }
                }
                return 1;
            }else{
                $response =$doctor_name." no atiende en ese horario";
                return $response;
            }
        }   
    }

    public function index(){	 
    	$attentions = Attention::where('type', 1)->get();
        $info = [];        
        $array=array(0=>"En espera",1=>"Confirmada",2=>"Atendida",3=>"Cancelada" );

        foreach ($attentions as $att ) {
            $app = Appointment::where('attention_id',$att->id)->first();
            $info[] = [
                'id'=>$att->id,
                'attention_code'=>$att->attention_code,
                'patient'=>$att->patient->user->name." ".$att->patient->user->last_name,
                'patient_dni'=>$att->patient->user->dni,
                'status'=>$array[$app->status],
                'app_id'=>$app->id,
                ];
        }
    	$new = NULL;   
        return view('appointments.appointment_index')->with(compact('info','new'));
    }

    public function detail($id){
    	$attention = Attention::find($id);
    	$s_attention = $attention->appointment;
        $specialty = $s_attention->specialty;
        $user_doctor =$s_attention->doctor->user;
    	$user_patient = $attention->patient->user;
        $medicines = [];
        if($s_attention->status == 2){
            $history = History::where('attention_id', $id)->first();
            if($history){
                $has_history = 1;
            }else{
                $has_history = 0;
            }
            $app=Appointment::where('attention_id', $id)->first();
            $recipe = Recipe::where('appointment_id', $app->id)->first();
            if($recipe){
                $has_recipe = 1; 
                $recipe_medicines = json_decode($recipe->medicines);
                foreach ( $recipe_medicines  as $key => $value) {
                    $medicine = Medicine::find($value->id);
                    $medicines[]=[
                        "name"=>$medicine->name,
                        "quantity"=>$value->quantity,
                        ];
                }
            }else{
                $has_recipe = 0; 
            }    
        }else{
            $has_history = 0;
            $has_recipe = 0; 
        }
        
        return view('attentions.attention_detail')->with(compact('s_attention','attention','user_patient','specialty','user_doctor','history','recipe','medicines','has_history','has_recipe'));
    }
    public function add(){
        $specialties = Specialty::all();
        $u_patients = Patient::all();

        foreach ($u_patients as $patient) {
            $patient_option = $patient->user->dni." - ".$patient->user->name." ".$patient->user->last_name;
            $patients[] =array( 
                        "name" => $patient_option,
                        "id" => $patient->user->id,
                    ); 
        }
        return view('appointments.new_appointment')->with(compact('patients', 'specialties'));  
    }

    public function store_real_time(Request $request){
        $rules1 = [
            'patient_user_id' => 'required',
            'doctor_user_id' => 'required',
            'motive' => 'required',
            'address' => 'required',
            'date' => 'required',
            'time' => 'required',
            'specialty_id' => 'required',
            ];
        $messages1 = [
                'patient_user_id.required' => 'Es necesario ingresar un paciente para registrar una cita médica',
                'doctor_user_id.required' => 'Es necesario ingresar un doctor para registrar una cita médica',
                'motive.required' => 'Es necesario ingresar la descripcion del problema del paciente para registrar una cita médica',
                'address.required' => 'Es necesario ingresar una dirección para registrar una cita médica',
                'date.required' => 'Es necesario ingresar una fecha para registrar una cita médica',
                'time.required' => 'Es necesario ingresar una hora para registrar una cita médica',
                'specialty_id.required' => 'Es necesario seleccionar una "especialidad"  para registrar una cita médica'
            ];  
        $this->validate($request, $rules1, $messages1);
       
        $attention = new Attention;
        $patient = User::find($request->patient_user_id)->patient;
        $attention->patient_id = $patient->id;
        $attention->motive = $request->motive;
        $attention->attention_code = "AT-".date("ymd");
        $attention->address = $request->address;
        $attention->reference = $request->reference;
        $attention->att_latitude = $request->att_latitude;
        $attention->att_longitude = $request->att_longitude;
        $attention->type = 1;
        $attention->save();
        $attention->attention_code = $attention->attention_code.$attention->id;
        $attention->save();
        $appointment = New Appointment;
        $appointment->attention_id = $attention->id;
        $appointment->specialty_id = $request->specialty_id;
        $doctor = User::find($request->doctor_user_id)->doctor;
        $appointment->doctor_id = $doctor->id;
        $appointment->date_time = $request->date." ".$request->time;
        $appointment->save(); 

        $appointments = Attention::where('type', 1)->get();
        $info = [];        
        foreach ($appointments as $app ) {
            $info[] = [
                        'id'=>$app->id,
                        'attention_code'=>$app->attention_code,
                        'patient'=>$app->patient->user->name." ".$app->patient->user->last_name,
                        'patient_dni'=>$app->patient->user->dni,
                        'status'=>$app->status,
                        'app_id'=>$app->id,
                        ];
        }
        $new = $appointment;   
        return view('appointments.appointment_index')->with(compact('info','new'));
    }

    public function delete($id){
    	$attention = Attention::find($id);
    	$appointment = $attention->appointment;
    	$appointment->delete();
    	Attention::destroy($id);
        return redirect('/appointments');
    }

    public function update($id){
        $attention = Attention::find($id);
        $s_attention = $attention->appointment;
        $user_doctor =$s_attention->doctor->user;
        $intervals = explode(' ',$s_attention->date_time);
        $u_doctors = Doctor::all();
        foreach ($u_doctors as $doctor) {
                if($doctor->specialty_id = $s_attention->specialty_id){
                    $doctors[] =array(
                            "name" => $doctor->user->name,
                            "id" => $doctor->user->id,
                        );     
                }
            }
        return view('attentions.attention_edit')->with(compact('s_attention','attention','specialty','user_doctor', 'doctors','intervals'));
    }

    public function store_update(Request $request){
        $data = $request->all();
        $attention = Attention::find($request->attention_id);
        unset($data['attention_id']);
        $s_attention = Appointment::find($request->app_id);
        $intervals = explode(' ',$s_attention->date_time);   
        unset($data['app_id']);
        if($request->date == ""){
            $date_time=$intervals[0];
        }else{
            $date_time=$request->date;    
        }
        if($request->time == ""){
            $date_time=$date_time." ".$intervals[1];
        }else{
            $date_time=$date_time." ".$request->time.":00";    
        }
        
        unset($data['date']);
        unset($data['time']);
        if($s_attention->date_time != $date_time){
            $s_attention->date_time = $date_time;
        }
        $i = 0;
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
            if($i< 3){
                if($attention->$key != $data[$key] ){
                    $attention->$key=$data[$key];    
                }
            }else{
                if($s_attention ->$key != $data[$key] ){
                    $s_attention ->$key=$data[$key];    
                }
            }
           }
           $i = $i +1 ;
        }
        $s_attention->save();
        $attention->save();
        return redirect('/appointments/detail/'.$attention->id);
    }

    public function update_status($id,$new_status){
        $att = Attention::find($id);
        $app = $att->appointment;
        $app->status = $new_status;
        $app->save();
         return redirect('/appointments/');
    }
}
