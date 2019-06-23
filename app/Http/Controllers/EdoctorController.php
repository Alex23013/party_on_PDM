<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EdoctorController extends Controller
{
    public function index(){
    	return view('edoctors.all_calendar');
    }

    public function add(){
    	return view('edoctors.new_schedule');
    }

    public function store(){
    	return "asi era ma fail";
    }
}
