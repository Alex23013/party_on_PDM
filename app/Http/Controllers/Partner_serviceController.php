<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Partner;
use App\Partner_service;
use App\Http\Requests;

class Partner_serviceController extends Controller
{
    public function index($idPartner)
 	{
 		$services = DB::table('partner_services')
                    ->where('partner_id',$idPartner)
                    ->get();
        $new = NULL;   
        $id_P = $idPartner;
        return view('partner_services.p_services')->with(compact('services','new','id_P'));
   	}

   	public function active($id_P,$id)
    {
        $user = Partner_service::find($id);
        $user->active = 1;
        $user->save();
        return redirect('/p_services/'.$id_P);
    }

    public function deactive($id_P,$id)
    {
        $user = Partner_service::find($id);
        $user->active = 0;
        $user->save();
        return redirect('/p_services/'.$id_P); 
    }
    
    public function delete($id_P,$id)
    {
        Partner_service::destroy($id);
        return redirect('/p_services/'.$id_P); 
    }

}
