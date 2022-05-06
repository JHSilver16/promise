<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ris_line;
use App\employee;
use App\item;
use App\unit;
use App\master_account;
use Carbon\Carbon;
use Auth;

class ris_line extends Model
{
    public function updaterline($data, $master, $emp){
    	
    	$division = employee::where('id', $emp)->first();
    	
    	foreach ($data['items'] as $key => $arr) {
    		$rline = ris_line::find($arr['id']);
	    	$rline->issued_qty = $arr['qtyiss'];
	        $rline->balance = $rline['available'] -  $arr['qtyiss'];
	        $rline->remarks = $arr['remarks'];
	        $rline->save();

	        $in = inventory::where('item_id', $arr['stockno'])->where('master_id', $master)->first();
	        $in->qty_instock = $in->qty_instock - $arr['qtyiss'];
	        $in->save();
	        //$inv-> 
	        $inop = new inventory_operation();
	        $inop->inventory_id = $in->id;
	        $inop->operation = 'OUT';
	        $inop->reason = 'REQUESTED BY '.$data['emp'];
	        $inop->qty =$arr['qtyiss'];
	        $inop->unit_cost = $in->unit_cost;
	        $inop->date = Carbon::now();
	        $inop->ris_id = $rline->ris_id;
	        $inop->balance = $rline['available'] -  $arr['qtyiss'];
	        $inop->total_cost = $arr['qtyiss'] * $in->unit_cost;
	        $inop->save();
	        
	        $masters = master_account::where('name', $division->division)->first();
	        \Log::info($master);
	        $div = inventory::where('item_id', $arr['stockno'])->where('id', $masters->id)->first();
	        $item = item::join('units', 'purchase_unit', '=', 'units.id')->where('items.id', $arr['stockno'])->select('items.*', 'units.abv as unit')->first();
	        $stock = inventory::where('item_id', $arr['stockno'])->where('id', $masters->id)->orderBy('date', 'desc')->pluck('qty_instock');
	        //return $stock;
	        if($div == null){
	        	$invs = new inventory();
                $invs->item_id = $arr['stockno'];
                $invs->master_id = $masters['id'];
                $invs->date = Carbon::now();
                $invs->qty_instock =  $arr['qtyiss'];
                $invs->unit_cost =  $item['unit_price'];
                $invs->total_cost =  $item['unit_price'] * $arr['qtyiss'];
                $invs->unit =  $item['unit'];
                $invs->danger_lvl =   $item['qtyiss'] * 0.10;
                $invs->save();

                $inop = new inventory_operation();
                $inop->inventory_id = $invs->id;
                $inop->operation = 'IN';
                $inop->reason = 'STOCK IN';
                $inop->qty =$arr['qtyiss'];
                $inop->unit_cost =$item['unit_cost'];
                $inop->date = Carbon::now();
                $inop->ris_id = $rline->ris_id;
                $inop->total_cost =  $item['unit_price'] * $arr['qtyiss'];
                
                $inop->balance = $arr['qtyiss'];
                $inop->save();
	        }
	        else{
	        	$in = inventory::find($div['id']);
                $in->qty_instock = $stock[0] + $item['qty'];
                $in->danger_lvl =$in->qty_instock * 0.10;
                $in->date = Carbon::now();
                $in->save();
                
                $inop = new inventory_operation();
                $inop->inventory_id = $in->id;
                $inop->operation = 'IN';
                $inop->reason = 'STOCK IN';
                $inop->qty =$arr['qtyiss'];
                $inop->unit_cost =$item['unit_cost'];
                $inop->date = Carbon::now();
                $inop->ris_id = $rline->ris_id;
                $inop->total_cost =  $item['unit_price'] * $arr['qtyiss'];
                
                $inop->balance = $arr['qtyiss'];
                $inop->save();
	        }
	    }
    }
}
