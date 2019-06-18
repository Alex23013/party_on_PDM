<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\History;

class HistoryController extends Controller
{
    public function update_pdf_status_appointment($h_id, $new_status){
    	$history = History::find($h_id);
		$history->pdf_status = $new_status;
		$history->save();
		return "estado de historia actualizada"	
    }

    public function delete($id){
    	History::destroy($id);
        return "historia clinica borrada";
    }
}
