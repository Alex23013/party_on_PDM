<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pool;
use DB;

class RestPoolController extends Controller
{
    public function getPool(){
        $pools = Pool::all();
        return response()
                ->json(['status' => '200',
                        'message' => 'Ok',
                        'content'=> $pools]);
    }

    public function getTopTen(){
    	$pools = DB::table('pools')
                ->orderBy('frequency', 'desc')
                ->get();
        return response()
                ->json(['status' => '200',
                        'message' => 'Ok',
                        'content'=> $pools]);
    }
}
