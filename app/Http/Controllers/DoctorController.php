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
                    ->where('doctors.specialty_id',"=",1)
                    ->get();
        return view('doctors.doctors_schedule_index')->with(compact('users'));
    }
    public function index_r(){
        $users = DB::table('users')
                    ->join('doctors','users.id','=','doctors.user_id')
                    ->where('doctors.specialty_id',"=",2)
                    ->get();
        return view('doctors.doctors_schedule_index')->with(compact('users'));
    }

    //schedules_detail
    public function detail($id){
        $doctor = Doctor::find($id);
        $doctor_user = $doctor->user;
        $doctor_name = $doctor_user->name." ".$doctor_user->last_name;
        $schedule = Schedule::find($doctor->schedule_id);
        $schedules = json_decode($schedule->schedule);
        return view('doctors.doctors_schedule_detail')->with(compact('schedules','doctor_name','doctor'));
    }

    //param:
    // $id : doctor_id
    public function assign($id){
        $doctor = Doctor::find($id);        
        $doctor_user = $doctor ->user;
        $doctor_name = $doctor_user->name." ".$doctor_user->last_name;
        $doctor_schedule = [];
                $days=["lunes","martes","miercoles","jueves","viernes","sabado","domingo"];
                for ($i=0; $i < 7; $i++) { 
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
        $doctor_user = $doctor ->user;
        $doctor_name = $doctor_user->name." ".$doctor_user->last_name;   
        $schedule = Schedule::find($doctor->schedule_id);
        $content_schedule = json_decode($schedule->schedule);
        return view('doctors.doctors_schedule_edit')->with(compact('content_schedule','doctor_name','doctor'));
    }

    public function store_update(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        $doctor->all_day = $request->all_day;
        $old_schedule = Schedule::find( $doctor->schedule_id );
        $old_schedule->active=0;
        $old_schedule->save();

        $schedule = New Schedule;
        $schedule->doctor_id = $doctor->id;
        $days=["lunes","martes","miercoles","jueves","viernes","sabado","domingo"];
        $doctor_schedule = [];
        for ($i=0; $i < 7; $i++) { 
            if($request->days && in_array($days[$i], $request->days)){
                if($request->starts[$i]!= ''){
                    $d_start = $request->starts[$i];
                }else{
                    $d_start = $request->real_starts[$i];
                }
                if($request->ends[$i]!= ''){
                    $d_end = $request->ends[$i];
                }else{
                    $d_end = $request->real_ends[$i];
                }
                $doctor_schedule[] = [
                    'day'=> $days[$i],
                    'schedule_start'=>$d_start,
                    'schedule_end'=>$d_end,
                ];              
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
