<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Espschedule;

class EdoctorController extends Controller
{
    public function index(){
    	$schedules = Espschedule::all();
    	$jsonevents = [];
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
    	return view('espschedule.all_calendar')->with(compact('jsonevents'));
    }

    public function add(){
    	return view('espschedule.new_schedule');
    }

    public function store(){
    	return "asi era ma fail";
    }
}
