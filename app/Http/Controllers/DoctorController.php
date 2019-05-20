<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;

use App\Doctor;
use App\Schedule;

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
        $doctor_user = Doctor::find(1)->user;
        $doctor_name = $doctor_user->name;
        $schedule = Schedule::find($doctor->schedule_id);
        $schedules = json_decode($schedule->schedule);
        return view('doctors.doctors_schedule_detail')->with(compact('schedules','doctor_name','doctor'));
    }

    public function assign($id){
        $doctor = Doctor::find($id);        
        $doctor_user = Doctor::find(1)->user;
        $doctor_name = $doctor_user->name;
        $doctor_schedule = [];
                $days=["lunes","martes","miercoles","jueves","viernes","sabado"];
                for ($i=0; $i < 6; $i++) { 
                    $doctor_schedule[] = [
                    'day'=> $days[$i],
                    'schedule_start'=>'',
                    'schedule_end'=>'',
                    ];
                }
        $schedule = New Schedule;
        $schedule->doctor_id = $doctor->id;
        $schedule->schedule = json_encode($doctor_schedule);
        $schedule->save();

        $doctor->schedule_id = $schedule->id;
        $doctor->save();

        $content_schedule = json_decode($schedule->schedule);
        return view('doctors.doctors_schedule_edit')->with(compact('content_schedule','doctor_name','doctor'));
    }

    public function update($id){
        $doctor = Doctor::find($id);        
        $doctor_user = Doctor::find(1)->user;
        $doctor_name = $doctor_user->name;          
        $schedule = Schedule::find($doctor->schedule_id);
        $content_schedule = json_decode($schedule->schedule);
        return view('doctors.doctors_schedule_edit')->with(compact('content_schedule','doctor_name','doctor'));
    }

    public function store_update(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        //dd($request->all());
        $doctor->all_day = $request->all_day;

        $schedule = New Schedule;
        $schedule->doctor_id = $doctor->id;
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
        $schedule->schedule = json_encode($doctor_schedule);
        $schedule->save();

        $doctor->schedule_id = $schedule->id;
        $doctor->save();
        return redirect('/doctors/schedule/detail/'.$request->doctor_id);
    }
}
