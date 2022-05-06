<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class abstract_rfq extends Model
{
 
 	public function getlines(){
 		
 	}

 	 public function deletelines($id){
    	$prlines = abstract_rfq::where('abstract_id', $id)->delete();
    }   
}
