<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Pool;
use App\Party;
use App\Song;
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

    public function getTop(){
        $pool = DB::table('pools')
                ->orderBy('frequency', 'desc')
                ->take(1)
                ->get();
        return response()
                ->json(['status' => '200',
                        'message' => 'Ok',
                        'party_id'=> $pool[0]->party_id,
                        'song_id'=> $pool[0]->song_id,
                        'frequency'=> $pool[0]->frequency,
                        ]);
    }

    public function getTopTen($party_id){
    	$pools = DB::table('pools')
                ->orderBy('frequency', 'desc')
                ->take(10)
                ->get();
        return response()
                ->json(['status' => '200',
                        'message' => 'Ok',
                        'content'=> $pools]);
    }

    public function addPool(Request $request){
    	$party = Party::find($request->party_id);

    	if($party == null){
    		return response()
                ->json(['status' => '400',
                        'message' => 'party not found']);	
    	}
    	$song = Song::find($request->song_id);
    	if($song == null){
    		return response()
                ->json(['status' => '400',
                        'message' => 'song not found']);	
    	}
    	$pool = Pool::where('song_id',$song->id)->first();
    	if($pool){
    		return response()
                ->json(['status' => '404',
                        'message' => 'pool already created']);
    	}else{
    		$new = New Pool;
	    	$new->party_id = $party->id;
	    	$new->song_id = $song->id;
	    	$new->frequency = 0;
	    	$new->save();
	    	return response()
	                ->json(['status' => '201',
	                        'message' => 'Pool added',
	                        'content'=> $new]);	
    	}
    	
    }

    public function vote(Request $request){
    	$song = Song::find($request->song_id);
    	if($song == null){
    		return response()
                ->json(['status' => '400',
                        'message' => 'song not found']);	
    	}
    	$pool = Pool::where('song_id',$song->id)->first();
    	$pool->frequency = $pool->frequency+1;
    	$pool->save();
    	return response()
                ->json(['status' => '200',
                        'message' => 'Ok',
                    	'pool_affected'=> $pool]);
    }
}
