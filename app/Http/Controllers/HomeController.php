<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Tcall;
use App\Patient;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','player']]);
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
                  "is_registed"=>1,
                  );   
              }else{
                  $tcalls[]=array(
                  "id"=>    $tc->id,
                  "name" => $tc->caller_name,                       
                  "patient_cell" => $tc->patient_cell,
                  "message"=>$tc->message,
                  "type"=>$tc->type,
                  "created_at"=>$tc->created_at,
                  "status"=>$tc->status,
                  "is_registed"=>0,
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

    public function player($id){
      return view('hello',['id'=>$id]);
    }

    public function pdf(){
 
      require("phpToPDF.php"); 
     $new_tech = NULL;
     $users = User::all();

     $html = view('techs.tuser_index',compact('new_tech','users'))->renderSections()['content'];
      phptopdf_html($html,'', 'p31.pdf');
     
     echo ("<a href='p31.pdf'>Download Your PDF</a>");
    }
}
