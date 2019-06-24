<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Espschedule;
use App\Specialty;
use App\User;

class EdoctorController extends Controller
{
    public function index(){
    	$schedules = Espschedule::all();
    	$jsonevents = [];
    	//dd($schedules);
	    foreach ($schedules as $key => $value) {
	    	$doctor_name = $value->doctor->user->name;
	        $jsonevents[$key] = [
	            'title'=> "horario de ".$doctor_name,
	            'start'=>$value->date.' '.$value->start_time,
	            'end'=>$value->date.' '.$value->end_time	,
	            'backgroundColor'=>$value->color,
	            'borderColor'=>$value->color,
	        ];

	    }
	    $specialties = Specialty::all();
    	return view('espschedule.all_calendar')->with(compact('jsonevents','specialties'));
    }

    public function add(){
    	$specialties = Specialty::all();
    	return view('espschedule.new_schedule')->with(compact('specialties'));
    }

    public function store(Request $request){
    	$rules1 = [
            'user_id' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'specialty_id' => 'required',
            ];
        $messages1 = [
                'user_id.required' => 'Es necesario seleccionar un doctor para registrar un horario de atención',
                'date.required' => 'Es necesario escoger una fecha para registrar un horario de atención',
                'end_time.required' => 'Es necesario escoger una hora para registrar un horario de atención',
                'start_time.required' => 'Es necesario escoger una hora para registrar un horario de atención',
                'specialty_id.required' => 'Es necesario seleccionar una "especialidad"  para registrar un horario de atención'
            ];  
        $this->validate($request, $rules1, $messages1);
    	$new_schedule =  New Espschedule;
    	$data = $request->all();
        unset($data['_token']);
        unset($data['guardar']);
        unset($data['specialty_id']);
        unset($data['user_id']);
        $new_schedule->doctor_id = User::find($request->user_id)->doctor->id;
        foreach ($data as $key => $value) {
        	$new_schedule->$key = $data[$key];
        }
        $new_schedule->save();
        if($request->guardar){
        	$specialties = Specialty::all();
        	return view('espschedule.new_schedule')->with(compact('specialties'));
        }else{
        	return redirect('/edoctors/schedule');	
        }        
    }

    public function search(Request $request){
    	$jsonevents = [];
    	if($request->buscarPorEspecialidad){
    		$all_schedules = Espschedule::all();
    		if($request->specialty_id == ""){
    			$schedules=$all_schedules;
    		}else{
    			$schedules=[];
    			foreach ($all_schedules as $sche) {
    				if($sche->doctor->specialty_id == $request->specialty_id){
    					$schedules[]=$sche;	
    				}
    			}
    		}
    		foreach ($schedules as $key => $value) {
		    	$doctor_name = $value->doctor->user->name;
		        $jsonevents[$key] = [
		            'title'=> "horario de ".$doctor_name,
		            'start'=>$value->date.' '.$value->start_time,
		            'end'=>$value->date.' '.$value->end_time	,
		            'backgroundColor'=>$value->color,
		            'borderColor'=>$value->color,
		        ];
	    	}
    	}
    	if($request->buscarPorDoctor){
    		if($request->doctor_id == ""){
    			$schedules = Espschedule::all();
    		}else{
    			$doctor_id = User::find($request->doctor_id)->doctor->id;
    			$schedules = Espschedule::where('doctor_id',$doctor_id)->get();	
    		} 	
    		foreach ($schedules as $key => $value) {
		    	$doctor_name = $value->doctor->user->name;
		        $jsonevents[$key] = [
		            'title'=> "horario de ".$doctor_name,
		            'start'=>$value->date.' '.$value->start_time,
		            'end'=>$value->date.' '.$value->end_time	,
		            'backgroundColor'=>$value->color,
		            'borderColor'=>$value->color,
		        ];
	    	}
    	}
    	$specialties = Specialty::all();
    	return view('espschedule.all_calendar')->with(compact('jsonevents','specialties'));
    }

    public function ajax_get_doctors(){
        $u_doctors = Doctor::all();
        $doctors=[];
        foreach ($u_doctors as $doctor) {
            if($doctor->specialty_id == $_POST['valor1']){

                $doctors[] =array(
                        "name" => $doctor->user->name." ".$doctor->user->last_name,
                        "id" => $doctor->id,
                    );     
            }
        }
        return $doctors;
    }
    public function ajax_get_events(){
        $jsonevents = [];
        $doctor_id = User::find( $_POST['val1'])->doctor->id;
        $schedules = Espschedule::where('doctor_id',$doctor_id)->get();
        foreach ($schedules as $key => $value) {
                $doctor_name = $value->doctor->user->name;
                $jsonevents[$key] = [
                    'title'=> "horario de ".$doctor_name,
                    'start'=>$value->date.' '.$value->start_time,
                    'end'=>$value->date.' '.$value->end_time    ,
                    'backgroundColor'=>$value->color,
                    'borderColor'=>$value->color,
                ];
            }
        return  $jsonevents;
    }
}
