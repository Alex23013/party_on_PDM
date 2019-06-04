<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tcall;

class TCallController extends Controller
{
    public function complete($id){
    	$tcall= Tcall::find($id);
    	$tcall->status = 1;
    	$tcall->save();
    	return redirect('/');
    }

    public function delete($id){
    	Tcall::destroy($id);
        return redirect('/');
    }
}
