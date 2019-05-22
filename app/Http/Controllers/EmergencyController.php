<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Attention;
use App\Emergency;

class EmergencyController extends Controller
{
    public function index(){	
    	$emergencies = DB::table('attentions')
                    ->join('emergencies','attentions.id','=','emergencies.attention_id')
                    ->join('patients','attentions.patient_id','=','patients.id')
                    ->get();
    	$new = NULL;   
        return view('emergencies.emergency_index')->with(compact('emergencies','new'));
    }

    public function detail($id){
    	$attention = Attention::find($id);
    	$emergency = $attention->emergency;
    	//dd($emergency);
    }
    public function add(){}

    public function store(Request $request){}

    public function delete($id){
    	$attention = Attention::find($id);
    	$emergency = $attention->emergency;
    	$emergency->delete();
    	Attention::destroy($id);
        return redirect('/emergency');
    }

    public function update($id){}
    
    public function store_update(Request $request){}
}
