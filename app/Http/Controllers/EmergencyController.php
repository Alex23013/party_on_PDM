<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Attention;
use App\Emergency;
use App\Patient;
use App\User;
use App\Uemergency;

class EmergencyController extends Controller
{
    public function index(){	
        $all_emergencies = Emergency::all();
        $all_uemergencies = Uemergency::all();
        $emergencies=[];
        foreach ($all_emergencies as $em ) {
            $attention = $em->attention;
            $patient = Patient::find($attention->patient_id);
            $emergencies[]=array(
                        "attention_id"=>$attention->id,
                        "attention_code"=> $attention->attention_code,
                        "emergency_type"=>$em->emergency_type,
                        "name" => $patient->user->name." ".$patient->user->last_name,
                        "is_attention"=>1,
                        );
        }
        foreach ($all_uemergencies as $u_em ) {
            $emergencies[]=array(
                        "attention_id"=>$u_em->id,
                        "attention_code"=> "UEM-".$u_em->id,
                        "emergency_type"=>$u_em->emergency_type,
                        "name" => $u_em->p_name." ".$patient->user->last_name,
                        "is_attention"=>0,
                        );
        }
    	$new = NULL;   
        return view('emergencies.emergency_index')->with(compact('emergencies','new'));
    }

    public function detail($id,$is_attention){
        if($is_attention){
            $attention = Attention::find($id);
            $s_attention = $attention->emergency;
            $user_patient = $attention->patient->user;
            return view('attentions.attention_detail')->with(compact('s_attention','attention','user_patient'));
        }else{
            $u_emergency = Uemergency::find($id);
            return view('attentions.uemergency_detail')->with(compact('u_emergency'));
        }
    	
    }

    public function add_unregisted_emergency(){
        return view('emergencies.new_unregisted_emergency');   
    }
    public function store_unregisted_emergency(Request $request){
        $rules = [
            'p_name' => 'required|min:2|max:255',
            'p_last_name' => 'required|min:2|max:255',
            'p_dni' => 'required|size:8',
            'p_cell' => 'required',
            'motive' => 'required',
            'address' => 'required',
            'response_type'=> 'required',
            'emergency_type'=> 'required',
        ];
        $messages = [
            'p_name.required' => 'Es necesario ingresar un nombre para registrar una emergencia',
            'p_name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Nombre".',
            'p_name.max' => 'Campo "Nombre" es demasiado extenso.',

            'p_last_name.required' => 'Es necesario ingresar un apellido para registrar una emergencia',
            'p_last_name.min' => 'Ingrese como mínimo 2 caracteres en el campo "Apellido".',
            'p_last_name.max' => 'Campo "Apellido" es demasiado extenso.',
            
            'p_dni.required' => 'Es necesario ingresar un DNI para registrar una emergencia',
            'p_dni.size' => 'El DNI debe tener 8 digitos',

            'p_cell.required' => 'Es necesario ingresar un número de celular para registrar una emergencia',
            'motive.required' => 'Es necesario ingresar la descripcion del problema del paciente para registrar una emergencia',
            'address.required' => 'Es necesario ingresar una dirección para registrar una emergencia',
            'response_type.required' => 'Es necesario ingresar un tipo de servicio de respuesta para registrar una emergencia',
                'emergency_type.required' => 'Es necesario ingresar algún tipo de emergencia para registrar una emergencia',
            ];  
        $this->validate($request, $rules, $messages);
        $uemergency= New Uemergency;
        $data = $request->all();
        unset($data['_token']);
        foreach ($data as $key => $value) {
           if( $value == '' || $value == ' ' ){
           }else{
                if($uemergency->$key != $data[$key] ){
                    $uemergency->$key=$data[$key];    
                }
           }
        }
        $uemergency->save();
        return redirect('/emergency');
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
        $rules = [
            'patient_id' => 'required',
            'motive' => 'required',
            'address' => 'required',
            'response_type'=> 'required',
            'emergency_type'=> 'required'
        ];
        $messages = [
                'patient_id.required' => 'Es necesario ingresar un id de paciente para registrar una emergencia',
                'motive.required' => 'Es necesario ingresar la descripcion del problema del paciente para registrar una emergencia',
                'address.required' => 'Es necesario ingresar una dirección para registrar una emergencia',
                'response_type.required' => 'Es necesario ingresar un tipo de servicio de respuesta para registrar una emergencia',
                'emergency_type.required' => 'Es necesario ingresar algún tipo de emergencia para registrar una emergencia',
            ];  
        $this->validate($request, $rules, $messages);  
        
        $attention= New Attention;
        $patient = User::find($request->patient_id)->patient;
        $attention->patient_id = $patient->id;
        $attention->motive = $request->motive;
        $attention->attention_code = "AT-".date("ymd");
        $attention->address = $request->address;
        $attention->att_latitude = $request->att_latitude;
        $attention->att_longitude = $request->att_longitude;
        $attention->reference = $request->reference;
        $attention->type = 2;
        $attention->save();
        $attention->attention_code = $attention->attention_code.$attention->id;
        $attention->save();

        $emergency = New Emergency;
        $emergency->attention_id =$attention->id;

        $data = $request->all();
        unset($data['_token']);
        unset($data['patient_id']);
        unset($data['motive']);
        unset($data['address']);
        unset($data['reference']);
        unset($data['att_latitude']);
        unset($data['att_longitude']);
        foreach ($data as $key => $value) {
            $emergency->$key = $data[$key] ;
        }  
        $emergency->save();

        $all_emergencies = Emergency::all();
        $all_uemergencies = Uemergency::all();
        foreach ($all_emergencies as $em ) {
            $attention = $em->attention;
            $patient = Patient::find($attention->patient_id);
            $emergencies[]=array(
                        "attention_id"=>$attention->id,
                        "attention_code"=> $attention->attention_code,
                        "name" => $patient->user->name,
                        "emergency_type"=>$em->emergency_type,
                        "is_attention"=>1,
                        );
        }
        foreach ($all_uemergencies as $u_em ) {
            $emergencies[]=array(
                        "attention_id"=>$u_em->id,
                        "attention_code"=> "UEM-".$u_em->id,
                        "name" => $u_em->p_name,
                        "emergency_type"=>$u_em->emergency_type,
                        "is_attention"=>2,
                        );
        }
        $new = $emergency;   
        return view('emergencies.emergency_index')->with(compact('emergencies','new'));
    }

    public function delete($id,$is_attention){
        if($is_attention){
            $attention = Attention::find($id);
            $emergency = $attention->emergency;
            $emergency->delete();
            Attention::destroy($id);
        }else{
            Uemergency::destroy($id);    
        }
    	
        return redirect('/emergency');
    }
}
