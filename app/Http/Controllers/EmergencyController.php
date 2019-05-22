<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Attention;
use App\Emergency;
use App\Appointment;

class EmergencyController extends Controller
{
    public function index(){
    	$all = Attention::all();
    	$all1 = Emergency::all();
    	$all2 = Appointment::all();
    	
    	dd($all);
    }
}
