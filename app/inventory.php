<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\inventory_operation;

class inventory extends Model
{
    public function getinventory($id){
    	$inp = inventory_operation::join('inventories', 'inventory_id', '=', 'inventories.id')->leftjoin('ris', 'ris_id', '=', 'ris.id')->where('inventory_id', $id)->select('inventory_operations.*', 'ris.ref_no as risno')->get();

    	
    	return $inp;
    }
}
