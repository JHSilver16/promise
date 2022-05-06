<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rfq_line extends Model
{
    public function deletelines($id){
    	$prlines = rfq_line::where('rfq_id', $id)->delete();
    }
}
