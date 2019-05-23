<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Attention;
use App\Emergency;
use App\Patient;

class EmergencyController extends Controller
{
    public function index(){	
    	$emergencies = DB::table('attentions')
                    ->join('emergencies','attentions.id','=','emergencies.attention_id')
                    ->join('patients','attentions.patient_id','=','patients.id')
                    ->join('users','patients.user_id','=','users.id')
                    ->get();
    	$new = NULL;   
        return view('emergencies.emergency_index')->with(compact('emergencies','new'));
    }

    public function detail($id){
    	$attention = Attention::find($id);
    	$s_attention = $attention->emergency;
        $user_patient = $attention->patient->user;
    	return view('attentions.attention_detail')->with(compact('s_attention','attention','user_patient'));
    }
    public function add(){
        $patients = Patient::all();
        return view('emergencies.new_emergency')->with(compact('patients'));   
    }

    public function store(Request $request){
        //dd($request->all());
        $rules = [
                'patient_id' => 'required',
                'motive' => 'required',
                'caller_name'=>'required',
                'caller_dni' => 'required|size:8',
                'caller_cell' => 'required'
            ];
        $messages = [
                'patient_id.required' => 'Es necesario ingresar un id de paciente para registrar una emergencia',
                'motive.required' => 'Es necesario ingresar la descripcion del probelma del paciente para registrar una emergencia',
                'caller_name.required' => 'Es necesario ingresar el nombre de la persona que llama para registrar una emergencia',
                'caller_dni.required' => 'Es necesario ingresar el DNI de la persona que llama para registrar una emergencia',
                'caller_cell.required' => 'Es necesario ingresar el número celular de la persona que llama para registrar una emergencia',
            ];  
        $this->validate($request, $rules, $messages);  
        
        $attention= New Attention;
        $attention->patient_id = $request->patient_id;
        $attention->motive = $request->motive;
        $attention->attention_code = "AT-".str_random(3);
        $attention->address = $request->address;
        $attention->reference = $request->reference;
        $attention->type = 2;
        $attention->save();

        $emergency = New Emergency;
        $emergency->attention_id =$attention->id;
        $emergency->caller_name = $request->caller_name;
        $emergency->caller_dni =  $request->caller_dni;
        $emergency->caller_cell =  $request->caller_cell;
        $emergency->save();

        //falta oc
        $emergencies = DB::table('attentions')
                    ->join('emergencies','attentions.id','=','emergencies.attention_id')
                    ->join('patients','attentions.patient_id','=','patients.id')
                    ->join('users','patients.user_id','=','users.id')
                    ->get();
        $new = NULL;   
        return view('emergencies.emergency_index')->with(compact('emergencies','new'));
    }

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
