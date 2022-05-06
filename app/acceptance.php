<?php

namespace App;
use App\item;
use App\acceptance;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class acceptance extends Model
{
    public function getcontrol(){
    	$control = DB::table('acceptances')->orderBy('id', 'desc')->first();
    	$ref = '';

    	if($control == null){
            $ref =  'IAR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
        	
             $ref = 'IAR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', $control->id+1);
        }

        return $ref;
    }
}
