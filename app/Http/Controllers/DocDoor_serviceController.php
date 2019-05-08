<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Dservice;
use App\Http\Requests;

class DocDoor_serviceController extends Controller
{
    public function index()
 	{
   		$services = Dservice::all();
        $new = NULL;   
        return view('docdoor_services.d_services')->with(compact('services','new'));
    }
}
