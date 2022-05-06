<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\rfq;
use App\rfq_line;
use App\abstract_rfq;
use Carbon\Carbon;

class rfq extends Model
{
    public function getcontrol(){
    	$control = DB::table('rfqs')->orderBy('ref_no', 'desc')->first();
    	$ref = '';

    	if($control == null){
            $ref =  'RFQ-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
        	
             $ref = 'RFQ-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($control->ref_no, -3)+1);
        }

        return $ref;
    }

    public function getrfqlines($id){
        $rfqslines = rfq_line::join('pr_lines', 'prline_id', '=', 'pr_lines.id')->join('items', 'pr_lines.item_id', '=', 'items.id')->where('rfq_id', $id)->select('items.name','items.id as stockno', 'pr_lines.unit_cost', 'pr_lines.total_cost', 'pr_lines.qty', 'rfq_lines.*')->get();
        return $rfqslines;
    }

    public function getrfq($prid){
        $rfq = rfq::join('purchase_requests', 'pr_id', '=', 'purchase_requests.id')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->where('pr_id', $prid)->select('rfqs.*', 'purchase_requests.purpose', 'suppliers.name', 'suppliers.address', 'suppliers.tin')->get();

        $abstracts = abstract_rfq::join('abstracts', 'abstract_id', '=', 'abstracts.id')->select('abstract_rfqs.rfq_id', 'abstracts.ref_no')->get();

        $rfqslines = rfq_line::join('pr_lines', 'prline_id', '=', 'pr_lines.id')->join('items', 'pr_lines.item_id', '=', 'items.id')->where('pr_lines.pr_id', $prid)->select('items.name','items.id as stockno', 'pr_lines.unit_cost', 'pr_lines.total_cost', 'pr_lines.qty', 'rfq_lines.*')->get();
        return array($rfq, $rfqslines, $abstracts);
    }

    public function getsuppliers($rfqs){

        $rfq = rfq::join('purchase_requests', 'pr_id', '=', 'purchase_requests.id')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->whereIn('rfqs.id', $rfqs)->select('rfqs.*', 'purchase_requests.purpose', 'suppliers.name', 'suppliers.address', 'suppliers.tin')->get();

        $array = [];
        $items = [];

        foreach ($rfq as $key) {
              $rfqslines = rfq_line::join('pr_lines', 'prline_id', '=', 'pr_lines.id')->join('items', 'pr_lines.item_id', '=', 'items.id')->where('rfq_lines.rfq_id', $key->id)->select('items.name','items.id as stockno',  'rfq_lines.*', 'pr_lines.id as prlid')->get();
              
              $array[] = array(
                'no' => $key->ref_no,
                'id' => $key->id,
                'supplier' => $key->name,
                'items' => $rfqslines,
                'purpose' => $key->purpose,
            ); 
        }

        return $array;

    }

    public function getpolines($id, $rfqs){
        DB::statement(DB::raw('set @rownum=0'));
         $abs = abstract_rfq::where('abstract_id', $id)->where('abstract_rfqs.status', 'awarded')->pluck('rfq_id');
         $rfqslines = rfq_line::join('pr_lines', 'prline_id', '=', 'pr_lines.id')->join('rfqs', 'rfq_lines.rfq_id', '=', 'rfqs.id')->join('items', 'pr_lines.item_id', '=', 'items.id')->whereIn('rfq_id', $abs)->where('rfq_lines.status', 'awarded')->select('items.name','pr_lines.id as prlid', 'items.id as stockno', 'pr_lines.unit_cost', 'pr_lines.total_cost', 'pr_lines.qty', 'rfq_lines.*', 'supplier_id', DB::raw('@rownum  := @rownum  + 1 AS rownum'))->orderBy('rownum')->get();
         
        
          $rfq = rfq::join('abstract_rfqs', 'rfq_id', '=', 'rfqs.id')->join('purchase_requests', 'pr_id', '=', 'purchase_requests.id')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->whereIn('rfqs.id', $rfqs)->select('abstract_rfqs.*', 'rfqs.ref_no', 'suppliers.name', 'suppliers.address', 'suppliers.tin', 'suppliers.id as supplier_id', 'rfqs.canvass_amount', 'rfqs.awarded_amount','purchase_requests.ref_no as prno')->orderBy('supplier_id')->get();
          
         return array($rfqslines, $rfq);
    }
}
