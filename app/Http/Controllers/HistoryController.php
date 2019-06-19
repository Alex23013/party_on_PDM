<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\History;

class HistoryController extends Controller
{
    public function clinic_histories(){
        $requested = History::where('pdf_status', 1)->get();
        $histories = [];
        foreach ($requested as $hist) {
            $histories[] = [
                "id"=>$hist->id,
                "attention_code"=> $hist->attention->attention_code,
                "patient_code"=> $hist->attention->patient->patient_code,
                "patient_name"=> $hist->attention->patient->user->name,
                ];
        }

        return view('histories.requested_histories')->with(compact('histories'));
    }

    public function update_pdf_status_appointment($id, $new_status){
    	$history = History::find($id);
		$history->pdf_status = $new_status;
		$history->save();
        return redirect('/clinic_histories');
    } 

    public function delete($id){
    	History::destroy($id);
        return "historia clinica borrada";
    }
}
