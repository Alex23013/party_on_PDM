<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Tcall;
use App\Patient;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth:: user()->validated){
            if( Auth::user()->role == 2) {
                $all_tcalls = Tcall::all();
                $tcalls=[];
                foreach ($all_tcalls as $tc) {
                    if($tc->patient_id != null){
                        $patient = Patient::find($tc->patient_id);
                        $tcalls[]=array(
                        "id"=>    $tc->id,
                        "name" => $patient->user->name,
                        "patient_cell" => $tc->patient_cell,
                        "message"=>$tc->message,
                        "type"=>$tc->type,
                        "created_at"=>$tc->created_at,
                        "status"=>$tc->status,
                        );   
                    }else{
                        $tcalls[]=array(
                        "id"=>    $tc->id,
                        "name" =>"",                            
                        "patient_cell" => $tc->patient_cell,
                        "message"=>$tc->message,
                        "type"=>$tc->type,
                        "created_at"=>$tc->created_at,
                        "status"=>$tc->status,
                        );   
                    }
                }
                return view('main')->with(compact('tcalls'));    
            }else{
                if(Auth::user()->role == 3){
                    $message = NULL;
                    return view('patients_options.patients_main')->with(compact('message'));
                }else{

                    return view('main');        
                }                
            }
            
        }else{
            return redirect('/logout');
        }
            
    }
}
