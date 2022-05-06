<?php

namespace App;
use App\item;
use App\ris;
use App\ris_line;
use App\master_account;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ris extends Model
{
 
 	 public function getcontrol(){
    	$control = DB::table('ris')->orderBy('id', 'desc')->first();
    	$ref = '';

    	if($control == null){
            $ref =  'RIS-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
        	
             $ref = 'RIS-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', $control->id+1);
        }

        return $ref;
    }

    public function ris(){
        $ris = ris::join('employees as c', 'requested_by', '=', 'c.id')->leftjoin('employees as a', 'issued_by', '=', 'a.id')->leftjoin('employees as b', 'received_by', '=', 'b.id')->select('ris.*', DB::raw('CONCAT(a.last_name, ", ", a.first_name) AS infull_name'), DB::raw('CONCAT(b.last_name, ", ", b.first_name) AS rcfull_name'), DB::raw('CONCAT(c.last_name, ", ", c.first_name) AS rqfullname'))->get();
        
        $array = [];
        foreach ($ris as $key) {
            $master = master_account::where('id', $key->master_id)->first();
            $qty = ris_line::where('ris_id', $key->id)->count('id');
            $array[] = array(
                'no' => $key->ref_no,
                'id' => $key->id,
                'employee' => $key->rqfullname,
                'entity' => $key->entity,
                'items' => $qty,
                'master' => empty($master) ? '' : $master->name,
                'purpose' => $key->purpose,
                'date' => $key->date,
                'issued_by' => $key->infull_name,
                'received_by' => $key->rcfull_name,
                'status' => $key->status,
            );
        
        }

        return $array;
    } 

    public function getrislines($id){
        $ris = ris_line::join('items', 'ris_lines.item_id', '=', 'items.id')->where('ris_id', $id)->select('items.name', 'ris_lines.*', 'items.id as stock')->get();
        return $ris;
    } 
}
