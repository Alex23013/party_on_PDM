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
        $one = NULL;
        return view('appointments.new_appointment')->with(compact('specialties','one'));   
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
            
            $specialties = Specialty::find($request->specialty_id);
            $one = 1;
            $users = User::all();
            $doctors =[];
            $patients =  [];
            foreach ($users as $user ) {
                if($user->role == 1 ){
                    if($user->doctor->specialty == $specialties->name){
                        $doctors[]=array(
                        "name" => $user->name,
                        "id" => $user->id,
                    );    
                    }
                }
                if($user->role == 3){
                    $patients[]=array(
                        "dni" => $user->dni,
                        "name" => $user->name,
                        "id" => $user->id,
                    );
                }
            }

            return view('appointments.new_appointment')->with(compact('patients', 'doctors', 'specialties','one'));
        }else{ //store an appointment
            $attention = new Attention;
            $patient = User::find($request->patient_user_id)->patient;
            $attention->patient_id = $patient->id;
            $attention->motive = $request->motive;
            $attention->attention_code = "AT-".str_random(3);
            //cambiar al tamaño a 9? eso hay que preguntar
            $attention->address = $request->address;
            $attention->reference = $request->reference;
            $attention->type = 1;
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
