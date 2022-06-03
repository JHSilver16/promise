<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;
use App\category;
use App\supplier;
use App\inventory;
use App\inventory_operation;
use App\unit;
use App\employee;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\purchase_request;
use App\pr_line;
use App\abstract_rfq;
use App\rfq;
use App\abstracts;
use App\purchase_order;
use App\acceptance;
use App\rfq_line;
use App\master_account;
use App\po_line;
use App\ris;
use App\ris_line;
use App\obligation;
use \NumberFormatter;
use Auth;
use App\inventory_mov;
use App\ppe;

class ReportController extends Controller
{
    public function itemlist(){
    	$items = new item();
        $employees = employee::all();
    	return view('reports.itemlist')->with('items', $items->itemlist())->with('employees',$employees);

    }

    public function reportview(){
        $masters = master_account::all(); 
        $employees = employee::orderBy('first_name')->get();
        $ppes = ppe::all();
        return view('reports.reports')->with('masters', $masters)->with('employees',$employees)->with('ppes',$ppes);
    }

    public function barcodelist(){
    	$items = new item();
    	return view('reports.barcodelist')->with('items', $items->barcodelist());

    }

    public function pr($id){
    		$prs = purchase_request::join('employees', 'purchase_requests.requested_by', '=', 'employees.id')->join('employees as b', 'purchase_requests.certified_by', '=', 'b.id')->select('employees.first_name', 'employees.last_name','employees.middle_name','b.first_name as certfname', 'b.last_name as certlname','b.middle_name as certmname' ,'purchase_requests.*', 'employees.position', 'employees.division')->where('purchase_requests.id', $id)->first();
            $chief = employee::where('division', $prs->division)->where('designation', 'DC')->first();
            // $app = employee::join('users', 'employee_id', '=', 'employees.id')->where('usertype_id', 5)->select('employees.first_name', 'employees.last_name', 'employees.position')->first();
            $rd = employee::where('posabv', 'RD')->first();
    		$prlines = new pr_line();
    		$prlines = $prlines->prlines($id);
            //return $chief;
    		return view('reports.prprint')->with('prs', $prs)->with('prlines', $prlines)->with('app', $rd)->with('chief', $chief);
    }

    public function rfq($id){
         $rfqs = rfq::join('purchase_requests', 'pr_id', '=', 'purchase_requests.id')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->select('rfqs.*', 'purchase_requests.purpose', 'suppliers.name as supplier', 'suppliers.address', 'suppliers.tin', 'purchase_requests.ref_no as prno')->where('rfqs.id', $id)->first();

         $rfqslines = rfq_line::join('pr_lines', 'prline_id', '=', 'pr_lines.id')->join('items', 'pr_lines.item_id', '=', 'items.id')->where('rfq_lines.rfq_id', $id)->select('items.name','items.id as stockno', 'pr_lines.unit_cost', 'pr_lines.total_cost', 'pr_lines.qty', 'rfq_lines.*')->get();
         //return $rfqslines;
         $bac =  $employee = employee::join('users', 'employee_id', '=', 'employees.id')->where('usertype_id', 1)->first();

         return view('reports.rfqprint')->with('rfqs', $rfqs)->with('rfqlines', $rfqslines)->with('bac', $bac);
    }

    public function abstracts($id){
        $abstracts = new rfq();
        DB::statement(DB::raw('set @rownum=0'));
        $abs = abstract_rfq::where('abstract_id', $id)->pluck('rfq_id');
        $absref = abstract_rfq::join('rfqs', 'rfq_id', '=', 'rfqs.id')->where('abstract_id', $id)->pluck('ref_no');
        $prs = abstracts::join('purchase_requests', 'abstracts.pr_no', '=', 'purchase_requests.ref_no')->select('abstracts.*', 'purchase_requests.date as prdate', 'purchase_requests.total_amount', 'purchase_requests.purpose')->where('abstracts.id', $id)->first();

        $rfqslines = rfq_line::join('pr_lines', 'prline_id', '=', 'pr_lines.id')->join('rfqs', 'rfq_lines.rfq_id', '=', 'rfqs.id')->join('items', 'pr_lines.item_id', '=', 'items.id')->whereIn('rfq_lines.rfq_id', $abs)->select('items.name','items.id as stockno', 'pr_lines.id as prlid', 'pr_lines.unit_cost', 'pr_lines.total_cost', 'pr_lines.qty', 'rfq_lines.*', 'rfqs.supplier_id', DB::raw('@rownum  := @rownum  + 1 AS rownum'))->orderBy('supplier_id')->get();
         $rfq = rfq::join('abstract_rfqs', 'rfq_id', '=', 'rfqs.id')->whereIn('rfqs.id', $abs)->select('abstract_rfqs.*')->orderBy('supplier_id')->get();
          
        $rd =  employee::where('posabv', 'RD')->first();
        $vchair =employee::join('users', 'employee_id', '=', 'employees.id')->where('usertype_id', '10')->first();
        $buyer =employee::join('users', 'employee_id', '=', 'employees.id')->where('usertype_id', '5')->first();
        $awards = [];
        foreach ($abstracts->getpolines($id, $abs)[0] as $key) {
            $awards[$key['supplier_id']][] = $key['rownum'];
        }
        //return $rfq;
        
        //return $rfqslines;
        //return $abstracts->getpolines($id, $abs)[1];
        return view('reports.abstractprint')->with('abstracts', $abstracts->getpolines($id, $abs))->with('prs', $prs)->with('rfqslines', $rfqslines)->with('abs', $abs)->with('vchair', $vchair)->with('absref', $absref)->with('buyer', $buyer)->with('awards', $awards)->with('rd', $rd);
    }

    public function po($id){
    	
    	
         //$in_words;
         //$poss = purchase_order::where('id', '>', '10')->get();
         //foreach($poss as $p){
         //	$sum = po_line::where('po_id', $p->id)->sum('total_cost');
    	  //	$fmt = new NumberFormatter('en_US', NumberFormatter::SPELLOUT);
         //	$in_words = $fmt->format($sum);
         	
         //	$por = purchase_order::where('id', $p->id)->first();
	//	 $por->amount = $sum;
		// $por->amount_words = $in_words.' pesos only';
		// $por->save();
         
         //}
         
         
        $po = new purchase_order();
        $pos = purchase_order::join('purchase_requests', 'pr_no', '=', 'purchase_requests.ref_no')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->join('procmodes', 'procmode', '=', 'procmodes.id')->select('purchase_orders.*', 'suppliers.address','suppliers.tin', 'purchase_requests.purpose', 'purchase_requests.ref_no as prno','suppliers.name', 'procmodes.name as procmode')->where('purchase_orders.id', $id)->first();
        $obligation = obligation::where('doc_id', $id)->join('employees as a', 'certified_funds', '=', 'a.id')->join('employees as b', 'requested_by', '=', 'b.id')->where('doc_type', "PO")->select('obligations.*', 'a.first_name', 'a.last_name', 'a.middle_name', 'a.position', DB::raw('CONCAT(b.first_name," ",SUBSTRING(b.middle_name, 1,1),". ",b.last_name) AS reqfullname'), 'b.position as reqpos')->first();
         $sao = employee::where('posabv', 'SUAO')->first();
         
         
         //return $pos;
         $entity = $pos->master_id != null ? master_account::where('id', $pos->master_id)->first(): '';
         //return count(array($obligation));
        //return json_encode(!empty(array($obligation)));
        $poline = $po->getpolines($id);
        
        if($pos->name == 'DBM' || $pos->name == 'Department of Budget and Management'){
            return view('reports.dbmpo')->with('pos', $pos)->with('poline', $poline)->with('obligation', $obligation);
        }
        else{
            return view('reports.poprint')->with('pos', $pos)->with('poline', $poline)->with('obligation', $obligation)
            ->with('sao', $sao)->with('entity', $entity);
        }
        
    }

    public function ors($id){
         $obligation = obligation::where('doc_id', $id)->join('employees as a', 'certified_funds', '=', 'a.id')->join('employees as b', 'requested_by', '=', 'b.id')->where('doc_type', "PO")->select('obligations.*', 'a.first_name', 'a.last_name', 'a.middle_name', 'a.position', DB::raw('CONCAT(b.first_name," ",SUBSTRING(b.middle_name, 1,1),". ",b.last_name) AS reqfullname'), 'b.position as reqpos')->first();
          $pos = purchase_order::join('purchase_requests', 'pr_no', '=', 'purchase_requests.ref_no')->join('master_accounts', 'master_id', '=', 'master_accounts.id')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->join('procmodes', 'procmode', '=', 'procmodes.id')->join('employees', 'certified_funds', '=', 'employees.id')->select('purchase_orders.*', 'employees.first_name', 'employees.last_name', 'suppliers.name','suppliers.address','suppliers.tin', 'purchase_requests.purpose', 'purchase_requests.ref_no as prno', 'procmodes.name as procmode', 'master_accounts.full_name as master')->where('purchase_orders.id', $id)->first();
          $sao = employee::where('posabv', 'SUAO')->first();
          $cao = employee::where('division', 'FAD')->where('designation', 'DC')->first();
          //return $pos->master_id;
          $entity = master_account::where('id', $pos->master_id)->first();
         return view('reports.orsprint')->with('ob', $obligation)->with('pos', $pos)
         ->with('sao', $sao)->with('cao', $cao)->with('entity', $entity);
    }

    public function iar($id){
        $iar = acceptance::join('purchase_orders', 'po_id', '=', 'purchase_orders.id')->join('purchase_requests', 'pr_no', '=', 'purchase_requests.ref_no')->join('suppliers', 'purchase_orders.supplier_id', '=', 'suppliers.id')->where('purchase_orders.id', $id)->join('employees as a', 'inspected_by', '=', 'a.id')->join('employees as b', 'received_by', '=', 'b.id')->select('acceptances.*', DB::raw('CONCAT(a.first_name," ",SUBSTRING(a.middle_name, 1, 1),". ", a.last_name) AS infull_name'), DB::raw('CONCAT(b.first_name," ",SUBSTRING(b.middle_name, 1, 1),". ", b.last_name) AS rcfull_name'), 'purchase_orders.ref_no as pono','purchase_orders.id as po_id' ,'purchase_orders.date as podate', 'suppliers.name','suppliers.address','suppliers.tin', 'purchase_requests.purpose', 'purchase_orders.amount')->first();
        //return $iar;
        $po = new purchase_order();
        $poline = $po->getpolines($iar->po_id);

        return view('reports.iarprint')->with('iar', $iar)->with('poline', $poline);
    }

    public function ris($id){
        $ris = ris::join('employees as c', 'requested_by', '=', 'c.id')->leftjoin('employees as a', 'issued_by', '=', 'a.id')->leftjoin('employees as d', 'approved_by', '=', 'd.id')->leftjoin('employees as b', 'received_by', '=', 'b.id')->where('ris.id', $id)->select('ris.*', DB::raw('CONCAT(a.first_name," ",SUBSTRING(a.middle_name, 1,1),". ",a.last_name) AS infull_name'), DB::raw('CONCAT(b.first_name," ",SUBSTRING(b.middle_name, 1,1),". ",b.last_name) AS rcfull_name'), DB::raw('CONCAT(c.first_name," ",SUBSTRING(c.middle_name, 1,1),". ",c.last_name) AS rqfullname'), DB::raw('CONCAT(d.first_name," ",SUBSTRING(d.middle_name, 1,1),". ", d.last_name) AS apfullname'), 'a.posabv as inpos', 'b.posabv as rcpos', 'c.posabv as rqpos', 'd.posabv as appos', 'ris.date_requested', 'ris.date_issued', 'ris.date_approved', 'ris.date_received')->first();
        //return $ris;
        $ris_line = new ris();
        $ris_line = $ris_line->getrislines($ris['id']);

        return view('reports.risprint')->with('ris', $ris)->with('ris_line', $ris_line);
    }

    public function stockcard($id){
        $item = inventory::join('items', 'item_id', '=', 'items.id')->where('inventories.id', $id)->select('items.name', 'items.description', 'inventories.*')->first();
       
        $inventory = new inventory();
        $inv = $inventory->getinventory($id);
        $array = [];
        //return($inv);
        foreach ($inv as $in) {

            

            if($in->operation == 'OUT'){
                $line = ris::where('id', $in->ris_id)->first();
                //return $in;
                $ref = $line->ref_no;

                 $poline = ris_line::join('items', 'ris_lines.item_id', '=', 'items.id')->where('ris_id', $line->id)->where('item_id', $item->item_id)->select('items.name', 'ris_lines.*', 'items.id as stock')->first();
                 //return $poline;
                 $array[] = array(
                'refno' => $ref,
                'date'=> $line->date,
                'rcqty' => $in->operation == "IN" ? $poline ->qty : ' ',
                'rcuc' => $in->operation == "IN" ? $poline->unit_cost : ' ',
                'rctc' => $in->operation == "IN" ? $poline->total_cost : ' ',
                'isqty' => $in->operation == "OUT" ? $poline->issued_qty : ' ',
                'isoff' => $in->reason,
                'isuc' => $in->operation == "OUT" ? $in->unit_cost : ' ',
                'istc' => $in->operation == "OUT" ? $in->total_cost : ' ',
                'balqty' => $in->balance,
                'baluc' => $in->unit_cost,
                'baltc' => $in->balance * $in->unit_cost,
                );
            }
            else{
                $line = acceptance::where('ref_no', $in->iac_id)->first();
                
                $poline = po_line::join('pr_lines', 'po_lines.prline_id', '=', 'pr_lines.id')->join('items', 'pr_lines.item_id', '=', 'items.id')->where('po_lines.po_id', $line->po_id)->where('item_id', $item->item_id)->select('items.name', 'po_lines.*', 'items.id as no')->first();
                
                //return $line;
                
                $ref = $line->ref_no;

                $array[] = array(
                'refno' => $ref,
                'date'=> $line->date,
                'rcqty' => $in->operation == "IN" ? $poline->qty : ' ',
                'rcuc' => $in->operation == "IN" ? $poline->unit_cost : ' ',
                'rctc' => $in->operation == "IN" ? $poline->total_cost : ' ',
                'isqty' => $in->operation == "OUT" ? $poline->issued_qty : ' ',
                'isoff' => $in->operation == "OUT" ? $in->reason : '',
                'isuc' => $in->operation == "OUT" ? $poline->unit_cost : ' ',
                'istc' => $in->operation == "OUT" ? $poline->total_cost : ' ',
                'balqty' => $in->balance,
                'baluc' => $in->unit_cost,
                'baltc' => $in->balance * $in->unit_cost,
            );
            }

            
        }
        //return $array;
        return view('reports.stockcard')->with('item', $item)->with('inventory', $array);
    }

    public function issuedreport(Request $data){
        //return $data->all();
        $date = explode(" - ", $data['daterange']);
        $master = master_account::find($data['entity']);
        $entity = $data['entity'];
        if($data['rdio'] == 3){
            $master = employee::find($data['entity']);
            $entity = master_account::where('name', $master->division)->pluck('id');
        }
	//return $data->all();
        $dater = $data['daterange']; 
        $item = inventory::join('items', 'item_id', '=', 'items.id')->where('master_id', $entity)->select('items.name', 'items.description', 'inventories.*')->get();
        $array = [];
        //return $item;
        foreach ($item as $in) {
             $poline = ris_line::join('items', 'ris_lines.item_id', '=', 'items.id')->join('ris', 'ris_id', '=', 'ris.id')->whereBetween('ris.date', [Carbon::parse($date[0])->toDateString(),Carbon::parse($date[1])->toDateString()])->where('item_id', $in->item_id)->select('items.name', 'ris_lines.*', 'items.id as stock', 'ris.ref_no', 'items.id as item_id', 'ris.requested_by')->get();
             //return $in->item_id;
            if($data['rdio'] == 3){
               
                 $poline = ris_line::join('items', 'ris_lines.item_id', '=', 'items.id')->join('ris', 'ris_id', '=', 'ris.id')->where('item_id', $in->item_id)->where('ris.requested_by', $data['entity'])->where('status', 'ISSUED')->select('items.name', 'ris_lines.*', 'items.id as stock', 'ris.ref_no', 'items.id as item_id', 'ris.requested_by')->get();
            }
            //return $poline;
             foreach ($poline as $p) {

                $inp = inventory_operation::join('inventories', 'inventory_id', '=', 'inventories.id')->leftjoin('ris', 'ris_id', '=', 'ris.id')->where('ris_id', $p->ris_id)->where('item_id', $p->item_id)->select('inventory_operations.*', 'ris.ref_no as risno')->first();
		 //var_dump($in->item_id);
                 if(!empty($inp)){
                 
                 $array[] = array(
                    'refno' => $p->ref_no,
                    'stock' => $p->stock,
                    'date'=> $p->date,
                    'item'=> $p->name,
                    'unit'=> $p->unit,
                    'isqty' =>  $p->issued_qty,
                    'isuc' =>  $inp->unit_cost,
                    'istc' =>  $inp->total_cost,
                	);
                }
             }
        }

        

        
        
       // return $array;
        //return($inv);
        

        return view('reports.issuedreport')->with('inventory', $array)->with('master', $master)->with('date', $dater);
    }
    
    public function inventory(Request $data){
        // $inventory = inventory::all();
        //foreach($inventory as $inv){
         //   $invs = new inventory_mov();
         //   $invs->inventory_id = $inv->id;
         //   $invs->quantity = $inv->qty_instock;
          //  $invs->unit = $inv->unit;
          //  $invs->unit_cost = $inv->unit_cost;
         //   $invs->amount = $inv->total_cost;
         //   $invs->asof = Carbon::now()->toDateString();
          //  $invs->save();
       // }
        $ao = employee::join('users', 'employee_id', '=', 'employees.id')->where('usertype_id', '5')->first();
        $cao = employee::where('division', 'FAD')->where('designation', 'DC')->first();
        
        $entity = master_account::where('id', $data['entity'])->first();
        $inventory = inventory::join('items', 'item_id', '=', 'items.id')->where('qty_instock', '>', '0')->where('master_id', $data['entity'])->select('items.name', 'items.description', 'inventories.*')->get();
        //return $inventory;
        $array = [];
        
        foreach($inventory as $inv){
            $invs = inventory_mov::where('inventory_id', $inv->id)->where('asof', '>=', Carbon::parse($data['date'])->toDateString())->first();
            $line = ris::where('id', $inv->ris_id)->first();
		if(!empty($invs)){
		
			$array[] = array(
		            'risno' => empty($line) ? '' : $line->ref_no, 
		            'stock' => $inv->item_id,
		            'item'=> $inv->name,
		            'unit'=> $inv->unit,
		            'qty' =>  $invs->quantity,
		            'unit' =>  $invs->unit,
		            'unit_cost' =>  $invs->unit_cost,
		            'amount' =>  $invs->amount,
		        );
		  }
            
        }

        return view('reports.inventory')->with('info', array($data['date'], $entity))->with('array', $array)->with('ao', $ao)->with('cao', $cao);

    }

 public function pmr(Request $data){
        $date = explode(" - ", $data['daterange']);
        $entity = master_account::where('id', $data['entity'])->first();
        $pos = purchase_request::join('purchase_orders', 'pr_no', '=', 'purchase_requests.ref_no')
            ->join('acceptances', 'purchase_orders.id', '=', 'po_id')
            ->join('obligations', 'purchase_orders.id', '=', 'doc_id')
            ->join('procmodes', 'procmode', '=', 'procmodes.id')->join('employees', 'purchase_requests.requested_by', '=', 'employees.id')
            ->whereBetween('purchase_orders.date', [Carbon::parse($date[0])->toDateString(),Carbon::parse($date[1])->toDateString()])
            ->where('entity', $entity['name'])->select('purchase_orders.*', 'purchase_requests.status','purchase_requests.purpose', 'obligations.*', 'acceptances.date as acdate', 'procmodes.name as proc', 'employees.division')->get();
            
        return view('reports.pmr')->with('pmr', $pos);

    }

    public function acclist(Request $data){
        //return $data->all();
        $date = explode(" - ", $data['daterange']);
        $acc = purchase_order::join('acceptances', 'po_id', '=', 'purchase_orders.id')->join('purchase_requests', 'pr_no', '=', 'purchase_requests.ref_no')->join('procmodes', 'procmode', '=', 'procmodes.id')->leftjoin('employees as a', 'inspected_by', '=', 'a.id')->leftjoin('employees as c', 'requested_by', '=', 'c.id')->leftjoin('employees as b', 'received_by', '=', 'b.id')->whereBetween('purchase_orders.date', [Carbon::parse($date[0])->toDateString(),Carbon::parse($date[1])->toDateString()])->where('master_id', $data['entity'])->select('purchase_orders.*', 'procmodes.name as procmode', 'acceptances.ref_no as accref', 'acceptances.invoice_no', 'acceptances.date_inspected', DB::raw('CONCAT(a.first_name," ",SUBSTRING(a.middle_name, 1,1),". ",a.last_name) AS infull_name'), DB::raw('CONCAT(b.first_name," ",SUBSTRING(b.middle_name, 1,1),". ",b.last_name) AS rcfull_name'), DB::raw('CONCAT(c.first_name," ",SUBSTRING(c.middle_name, 1,1),". ",c.last_name) AS rqfullname'), 'acceptances.date_received', 'purchase_requests.purpose')->get();
        return view('reports.acceptancelist')->with('acc', $acc)->with('type', $data['type']);

    }
    
    public function formlist(Request $data){
        //return $data->all();
        $date = explode(" - ", $data['daterange']);
        if($data['typeform'] == 'prs'){
            $prs = purchase_request::join('employees', 'purchase_requests.requested_by', '=', 'employees.id')->select('employees.first_name', 'employees.last_name', 'purchase_requests.*')->whereBetween('date', [Carbon::parse($date[0])->toDateString(),Carbon::parse($date[1])->toDateString()])->orderBy('id', 'DESC')->get();
            
             $array = [];
            foreach ($prs as $key) {
                $qty = pr_line::where('pr_id', $key->id)->count('id');
                $rfqs = rfq::where('pr_id', $key->id)->get(); 
                $array[] = array(
                    'no' => $key->ref_no,
                    'id' => $key->id,
                    'employee' => $key->first_name.' '.$key->last_name,
                    'entity' => $key->entity,
                    'items' => $qty,
                    'purpose' => $key->purpose,
                    'total_amount' => $key->total_amount,
                    'date' => $key->date,
                    'ppmp' => $key->within_ppmp,
                    'status' => $key->status,
                    'rfqs' => count($rfqs)
                );
            
            }
            //return $array;
            return view('reports.prlist')->with('prs', $array)->with('type', $data['type']);
        }
        else if($data['typeform'] == 'abs'){

            $prs = abstracts::join('purchase_requests', 'abstracts.pr_no', '=', 'purchase_requests.ref_no')->select('abstracts.*', 'purchase_requests.date as prdate', 'purchase_requests.total_amount', 'purchase_requests.purpose', 'purchase_requests.status')->whereBetween('date', [Carbon::parse($date[0])->toDateString(),Carbon::parse($date[1])->toDateString()])->get();
            //return $prs;
            $array = [];
            foreach ($prs as $key) {
                $rfqs = abstract_rfq::where('abstract_id', $key->id)->join('rfqs', 'rfq_id', '=', 'rfqs.id')->pluck('rfqs.ref_no');
                $rfqsum = abstract_rfq::where('abstract_id', $key->id)->join('rfqs', 'rfq_id', '=', 'rfqs.id')->sum('rfqs.awarded_amount');
                $suppliers = abstract_rfq::where('abstract_id', $key->id)->join('rfqs', 'rfq_id', '=', 'rfqs.id')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->distinct('supplier_id')->pluck('suppliers.name');
                $array[] = array(
                    'no' => $key->ref_no,
                    'id' => $key->id,
                    'suppliers' => implode (',', $suppliers->toArray()),
                    'rfqs' => implode (',',$rfqs->toArray()),
                    'pramount' => $key->total_amount,
                    'purpose'=> $key->purpose,
                    'prno' => $key->pr_no,
                    'date' => $key->date,
                    'prdate' => $key->prdate,
                    'status' => $key->status,
                    'cvamount' => $rfqsum,
                    'rfqscount' => count($rfqs) 
                );
            
            }
            //return $array;
            return view('reports.abslist')->with('prs', $array)->with('type', $data['type']);
        }
        else if($data['typeform'] == 'pos'){
            
            $pos = purchase_order::join('purchase_requests', 'pr_no', '=', 'purchase_requests.ref_no')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->join('employees', 'certified_funds', '=', 'employees.id')->leftjoin('master_accounts', 'master_id', '=', 'master_accounts.id')->select('purchase_orders.*', 'employees.first_name', 'employees.last_name', 'suppliers.name', 'purchase_requests.purpose', 'master_accounts.name as acc','purchase_requests.ref_no as prno')->whereBetween('purchase_orders.date', [Carbon::parse($date[0])->toDateString(),Carbon::parse($date[1])->toDateString()])->get();

             $array = [];
            foreach ($pos as $key) {
                $qty = po_line::where('po_id', $key->id)->count('id');
                $iar = acceptance::where('po_id', $key->id)->join('employees as a', 'inspected_by', '=', 'a.id')->join('employees as b', 'received_by', '=', 'b.id')->select('acceptances.*', DB::raw('CONCAT(a.last_name, ", ", a.first_name) AS infull_name'), DB::raw('CONCAT(b.last_name, ", ", b.first_name) AS rcfull_name'))->first();
                $array[] = array(
                    'no' => $key->ref_no,
                    'id' => $key->id,
                    'prno' => $key->prno,
                    'employee' => $key->first_name.' '.$key->last_name,
                    'supplier' => $key->name,
                    'supplier_id' => $key->supplier_id,
                    'procmode' =>$key->procmode,
                    'master' => $key->master_id,
                    'acc' => $key->acc,
                    'items' => $qty,
                    'purpose' => $key->purpose,
                    'total_amount' => $key->amount,
                    'date' => $key->date,
                    'status' => $key->status,
                    'iarno' => !empty($iar) ? $iar->ref_no : '',
                    'iardate' => !empty($iar) ? $iar->date : '',
                    'inemployee' => !empty($iar) ? $iar->infull_name : '',
                    'rcemployee' => !empty($iar) ? $iar->rcfull_name : '',
                    'rcdate' => !empty($iar) ? $iar->date_received : '',
                    'indate' => !empty($iar) ? $iar->date_inspected : '',
                );
            
            }
            return view('reports.poslist')->with('pos', $array)->with('type', $data['type']);
        }

        else if($data['typeform'] == 'rfqs'){
             $rfqs = rfq::join('purchase_requests', 'pr_id', '=', 'purchase_requests.id')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->select('rfqs.*', 'purchase_requests.purpose', 'suppliers.name as supplier', 'suppliers.address', 'suppliers.tin', 'purchase_requests.ref_no as prno', 'purchase_requests.id as prid')->whereBetween('rfqs.date', [Carbon::parse($date[0])->toDateString(),Carbon::parse($date[1])->toDateString()])->get();

             $array2 = [];
            foreach ($rfqs as $key) {
                $abstracts = abstract_rfq::where('rfq_id', $key->id)->join('abstracts', 'abstract_id', '=', 'abstracts.id')->pluck('abstracts.ref_no');
                $qty = rfq_line::where('rfq_id', $key->id)->count('id');
                $array2[] = array(
                    'no' => $key->ref_no,
                    'prno' => $key->prno,
                    'prid' => $key->prid,
                    'id' => $key->id,
                    'entity' => $key->entity,
                    'abstracts' => empty($abstracts) ? '' : $abstracts,
                    'items' => $qty,
                    'purpose' => $key->purpose,
                    'total_amount' => $key->total_amount,
                    'canvass_amount' => $key->canvass_amount,
                    'supplier' => $key->supplier,
                    'date' => $key->date,
                    'status' => $key->status,
                );

            }
            return view('reports.rfqlist')->with('rfqs', $array2)->with('type', $data['type']);
        }
        
    }

}
