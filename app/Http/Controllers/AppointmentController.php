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

class AppointmentController extends Controller
{
    public function ajax_get_doctors(){
        $u_doctors = Doctor::all();
        $doctors=[];
        foreach ($u_doctors as $doctor) {
            if($doctor->specialty_id == $_POST['valor1']){
                $schedule = Schedule::find($doctor->schedule_id);

                $doctors[] =array(
                        "name" => $doctor->user->name,
                        "id" => $doctor->user->id,
                        "specialty"=>$doctor->specialty_id,
                        "schedule"=>$schedule->schedule,
                    );     
            }
        }
        return $doctors;
    }

    public function index(){	
    	$appointments = DB::table('attentions')
                    ->join('appointments','attentions.id','=','appointments.attention_id')
                    ->join('patients','attentions.patient_id','=','patients.id')
                    ->join('users','patients.user_id','=','users.id')
                    ->get();
    	$new = NULL;   
        return view('appointments.appointment_index')->with(compact('appointments','new'));
    }

    public function detail($id){
    	$attention = Attention::find($id);
    	$s_attention = $attention->appointment;
        $specialty = $s_attention->specialty;
        $user_doctor =$s_attention->doctor->user;
    	$user_patient = $attention->patient->user;
        return view('attentions.attention_detail')->with(compact('s_attention','attention','user_patient','specialty','user_doctor'));
    }
    public function add(){
        $specialties = Specialty::all();
        $u_patients = Patient::all();
        foreach ($u_patients as $patient) {
            $patients[] =array(
                        "name" => $patient->user->name,
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

        $appointments = DB::table('attentions')
                ->join('appointments','attentions.id','=','appointments.attention_id')
                ->join('patients','attentions.patient_id','=','patients.id')
                ->join('users','patients.user_id','=','users.id')
                ->get();
        $new = $appointment;   
        return view('appointments.appointment_index')->with(compact('appointments','new'));
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
}
