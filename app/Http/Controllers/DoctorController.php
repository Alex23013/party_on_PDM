<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Doctor;

class DoctorController extends Controller
{
    public function index(){
        $users = DB::table('users')
                    ->join('doctors','users.id','=','doctors.user_id')
                    ->get();
        return view('doctors.doctors_schedule_index')->with(compact('users'));
    }

    public function detail($id){
        $doctor = Doctor::find($id);
        $doctor_name = DB::table('users')
                    ->where('id',$doctor->user_id)
                    ->first();
        $name = $doctor_name->name;           
        $schedules = json_decode($doctor->schedule);
        return view('doctors.doctors_schedule_detail')->with(compact('schedules','name','doctor'));
    }

    public function update($id){
        $doctor = Doctor::find($id);
        $doctor_name = DB::table('users')
                    ->where('id',$doctor->user_id)
                    ->first();
        $name = $doctor_name->name;           
        $schedules = json_decode($doctor->schedule);
        return view('doctors.doctors_schedule_edit')->with(compact('schedules','name','doctor'));
    }

    public function store_update(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        //dd($request->all());
        $doctor->all_day = $request->all_day;
                
        $days=["lunes","martes","miercoles","jueves","viernes","sabado"];
        $doctor_schedule = [];
        for ($i=0; $i < 6; $i++) { 
            if($request->days && in_array($days[$i], $request->days)){
                if($request->starts[$i]!= '' && $request->ends[$i]!= ''){
                   $doctor_schedule[] = [
                    'day'=> $days[$i],
                    'schedule_start'=>$request->starts[$i],
                    'schedule_end'=>$request->ends[$i],
                ]; 
                }else{
                    $doctor_schedule[] = [
                    'day'=> $days[$i],
                    'schedule_start'=>$request->real_starts[$i],
                    'schedule_end'=>$request->real_ends[$i],
                ]; 
                }                
            }
            else{
               $doctor_schedule[] = [
                'day'=> $days[$i],
                'schedule_start'=>'',
                'schedule_end'=>'',
                ]; 
            }               
        }
        $doctor_schedule =json_encode($doctor_schedule);
        $doctor->schedule =  $doctor_schedule; 
        $doctor->save();
        return redirect('/doctors/schedule/detail/'.$request->doctor_id);
    }
}
