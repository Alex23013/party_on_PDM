<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Requests;

class TechController extends Controller
{
 public function index(){
   		$users = DB::table('techs')->get();
        $new_tech = NULL;   
        return view('techs.tech_index')->with(compact('users','new_tech'));
    }
}
