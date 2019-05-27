<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Attention;
use App\Emergency;
use App\Patient;
use App\User;

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

    public function add_unregisted_emergency(){
        return view('emergencies.new_unregisted_emergency');   
    }

    public function add(){
        $patients = Patient::all();
        foreach ($patients as $patient) {
            $users[] =array(
                        "name" => $patient->user->name,
                        "id" => $patient->user->id,
                    ); 
        }
        return view('emergencies.new_emergency')->with(compact('users'));   
    }

    public function store(Request $request){
        //dd($request->all());
        $rules = [
                'patient_id' => 'required',
                'motive' => 'required',
                'address' => 'required'
            ];
        $messages = [
                'patient_id.required' => 'Es necesario ingresar un id de paciente para registrar una emergencia',
                'motive.required' => 'Es necesario ingresar la descripcion del problema del paciente para registrar una emergencia',
                'address.required' => 'Es necesario ingresar una dirección para registrar una emergencia'
            ];  
        $this->validate($request, $rules, $messages);  
        
        $attention= New Attention;
        $patient = User::find($request->patient_id)->patient;
        $attention->patient_id = $patient->id;
        $attention->motive = $request->motive;
        $attention->attention_code = "AT-".str_random(3);
        //cambiar al tamaño a 9? eso hay que preguntar
        $attention->address = $request->address;
        $attention->reference = $request->reference;
        $attention->type = 2;
        $attention->save();

        $emergency = New Emergency;
        $emergency->attention_id =$attention->id;

        $data = $request->all();
        unset($data['_token']);
        unset($data['patient_id']);
        unset($data['motive']);
        unset($data['address']);
        unset($data['reference']);
        foreach ($data as $key => $value) {
            $emergency->$key = $data[$key] ;
        }  
        $emergency->save();

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

    /*public function update($id){
        $attention = Attention::find($id);
        $s_attention = $attention->emergency;
        $user_patient = $attention->patient->user;
        return view('attentions.attention_edit')->with(compact('s_attention','attention','user_patient'));
    }

    public function store_update(Request $request){}*/
}
