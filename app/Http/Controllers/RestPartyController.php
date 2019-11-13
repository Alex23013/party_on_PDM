<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Party;

class RestPartyController extends Controller
{
    public function createParty(Request $request){
        $party = new Party;
        $party->name = $request->name;
        $party->host_user_id = $request->host_user_id;
        $party->latitude = $request->latitude;
        $party->longitude = $request->longitude;
        if($party->save())
        {
            $stat='200';
        }else{
            $stat='401';
        }
        return response()
            ->json(['code' => $party->id,
                    'status' => $stat,
                    'name' => $party->name,
                    'latitude' => $party->latitude,
                    'longitude' => $party->longitude]);
    }

    public function joinParty(Request $request){
        $party = Party::find($request->code);
        if($party != null)
        {
            $stat = '200';
        }
        else
        {
            $stat = '404';
        }
        return response()
            ->json(['status' => $stat,
                    'name' => $party->name,
                    'latitude' => $party->latitude,
                    'longitude' => $party->longitude]);
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2, $unit) {
	  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
	    return 0;
	  }
	  else {
	    $theta = $lon1 - $lon2;
	    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	    $dist = acos($dist);
	    $dist = rad2deg($dist);
	    $miles = $dist * 60 * 1.1515;
	    $unit = strtoupper($unit);

	    if ($unit == "K") {
	      return ($miles * 1.609344);
	    }else if ($unit == "I") {
	      return ($miles * 1609.34);;
	    } 
	    else {
	      return $miles;
	    }
	  }
	}

	public function evaluateNearParties(Request $request){
		$parties = Party::where('latitude', '<>', null)->where('longitude', '<>', null)->get();
		$near_parties = [];
		$lat = $request->latitude;
		$lon = $request->longitude;
		foreach ($parties as $key => $value) {
			$d = $this->calculateDistance($lat, $lon, $value->latitude, $value->longitude,"I");
			if( $d <=  $request->radio ){
				$near_parties[]=$value;
			}			
		}
		if(count($near_parties) > 0)
        {
            $stat = '200';
        }
        else
        {
            $stat = '404';
        }
		return response()
            ->json(['status' => $stat,
                    'content'=> $near_parties]);
	}
}
