<?php

namespace App;
use App\item;
use App\purchase_order;
use App\po_line;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class purchase_order extends Model
{
    public function getcontrol($num){
        $array = [];
        for ($i=1; $i <=$num ; $i++) { 
            $control = DB::table('purchase_orders')->orderBy('id', 'desc')->first();
        $ref = '';

        if($control == null){
            $ref =  'PO-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', $i);
        }
        else{
            
             $ref = 'PO-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($control->ref_no, -3)+$i);
        }

        array_push($array, $ref);

        }
    	
        return $array;
    }

    public function getpolines($id){
        $polines = po_line::join('pr_lines', 'po_lines.prline_id', '=', 'pr_lines.id')->join('items', 'pr_lines.item_id', '=', 'items.id')->where('po_id', $id)->select('items.name', 'po_lines.*', 'items.id as no')->get();
        return $polines;
    }

    
}
