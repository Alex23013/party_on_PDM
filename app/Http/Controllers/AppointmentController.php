<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Attention;
use App\Appointment;

class AppointmentController extends Controller
{
    public function index(){	
    	$appointments = DB::table('attentions')
                    ->join('appointments','attentions.id','=','appointments.attention_id')
                    ->join('users','attentions.user_id','=','users.id')
                    ->get();
    	$new = NULL;   
        return view('appointments.appointment_index')->with(compact('appointments','new'));
    }

    public function detail($id){
    	$attention = Attention::find($id);
    	$appointment = $attention->appointment;
    	//dd($emergency);
    }
    public function add(){}

    public function store(Request $request){}

    public function delete($id){
    	$attention = Attention::find($id);
    	$appointment = $attention->appointment;
    	$appointment->delete();
    	Attention::destroy($id);
        return redirect('/appointments');
    }

    public function update($id){}

    public function store_update(Request $request){}
}
