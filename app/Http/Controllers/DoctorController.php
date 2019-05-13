<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

class DoctorController extends Controller
{
    public function index(){
    	$users = DB::table('doctors')
                    ->join('users','doctors.user_id','=','users.id')
                    ->get();
        return view('doctors.doctors_schedule_index')->with(compact('users'));
    }

    //registro de horario
    //https://stackoverflow.com/questions/46364906/laravel-5-4-save-json-to-database
    /*
    $teamMembers = [];
	$teamMembers['1'] = 7;
	$teamMembers['2'] = 14;
	$salesTeam->team_members = $teamMembers;
	$salesTeam->save();
    */
}
