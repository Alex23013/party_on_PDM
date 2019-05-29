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

class AppointmentController extends Controller
{
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
        $u_doctors = Doctor::all();
        $u_patients = Patient::all();
        foreach ($u_patients as $patient) {
            $patients[] =array(
                        "name" => $patient->user->name,
                        "id" => $patient->user->id,
                    ); 
        }
        foreach ($u_doctors as $doctor) {
            //if($doctor->specialty_id = $specialty->id){
                $doctors[] =array(
                        "name" => $doctor->user->name,
                        "id" => $doctor->user->id,
                        "specialty"=>$doctor->specialty_id,
                    );     
          //  }
        }
        $one = NULL;
        return view('appointments.new_appointment')->with(compact('patients', 'doctors','specialties','one'));  
    }

    public function store_real_time(Request $request){
        dd($request->all());
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

    public function store(Request $request){
        if($request->choseSpecialty){
            
            $rules = [
            'specialty_id' => 'required',
            ];
            $messages = [
            'specialty_id.required' => 'Es necesario seleccionar una "especialidad"  para registrar una cita médica'
            ];

            $this->validate($request, $rules, $messages);
            
            $specialty = Specialty::find($request->specialty_id);
            $specialties = Specialty::all();
            $one = 1;
            $u_doctors = Doctor::all();
            $u_patients = Patient::all();
            foreach ($u_patients as $patient) {
                $patients[] =array(
                            "name" => $patient->user->name,
                            "id" => $patient->user->id,
                        ); 
            }
            foreach ($u_doctors as $doctor) {
                if($doctor->specialty_id = $specialty->id){
                    $doctors[] =array(
                            "name" => $doctor->user->name,
                            "id" => $doctor->user->id,
                        );     
                }
            }
            return view('appointments.new_appointment')->with(compact('patients', 'doctors','specialty' ,'specialties','one'));
        }else{ //store an appointment

            $rules1 = [
                'patient_user_id' => 'required',
                'doctor_user_id' => 'required',
                'motive' => 'required',
                'address' => 'required',
                'date' => 'required',
                'time' => 'required',
                ];
            $messages1 = [
                    'patient_user_id.required' => 'Es necesario ingresar un paciente para registrar una cita médica',
                    'doctor_user_id.required' => 'Es necesario ingresar un doctor para registrar una cita médica',
                    'motive.required' => 'Es necesario ingresar la descripcion del problema del paciente para registrar una cita médica',
                    'address.required' => 'Es necesario ingresar una dirección para registrar una cita médica',
                    'date.required' => 'Es necesario ingresar una fecha para registrar una cita médica',
                    'time.required' => 'Es necesario ingresar una hora para registrar una cita médica',
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
        return view('attentions.attention_edit')->with(compact('s_attention','attention','specialty','user_doctor'));
    }

    public function store_update(Request $request){
        dd($request->all());
    }
}
