<?php

namespace App;
use App\item;
use App\abstracts;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class abstracts extends Model
{
    public function getcontrol(){
    	$control = DB::table('abstracts')->orderBy('ref_no', 'desc')->first();
    	$ref = '';

    	if($control == null){
            $ref =  'AC-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
        	
             $ref = 'AC-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($control->ref_no, -3)+1);
        }

        return $ref;
    }
}
