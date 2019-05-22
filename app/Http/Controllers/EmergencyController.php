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
                    ->join('users','attentions.user_id','=','users.id')
                    ->get();
    	$new = NULL;   
        return view('emergencies.emergency_index')->with(compact('emergencies','new'));
    }

    public function detail($id){
    	$attention = Attention::find($id);
    	$emergency = $attention->emergency;
        $user = $attention->user;
    	return view('emergencies.attention_detail')->with(compact('emergency','attention','user'));
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
