<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Dservice;
use App\Http\Requests;

use App\User;
use App\Service;
use App\Partner;

class DocDoor_serviceController extends Controller
{
    public function index()
 	{
        $services =  DB::table('dservices')
                    ->join('services','dservices.service_id','=','services.id')
                    ->join('users','dservices.user_id','=','users.id')
                    ->join('partners','dservices.partner_id','=','partners.id')
                    ->get();
        $new = NULL;   
        return view('docdoor_services.d_services')->with(compact('services','new'));
    }

    public function complete($id)
    {
        $d_service = Dservice::find($id);
        $d_service->execution = date('Y-m-d H:i:s');
        $d_service->save();
        return redirect('/d_services');
    }
    
    public function detail($id){
        $data = Dservice::find($id);
        $user = User::find($data->user_id);
        $service = Service::find($data->service_id);
        $partner = Partner::find($data->partner_id);
        return view('docdoor_services.d_services_detail')  ->with(compact('data','user','service','partner')); 
    }

    public function delete($id){
    	Dservice::destroy($id);
       	return redirect('/d_services');	
    }

}
