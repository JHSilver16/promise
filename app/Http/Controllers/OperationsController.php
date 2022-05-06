<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\supplier;
use App\item;
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
use App\classification;
use App\rfq_line;
use App\master_account;
use App\po_line;
use App\ris;
use App\ris_line;
use App\obligation;
use App\User;
use Auth;
use App\inventory_mov;

class OperationsController extends Controller
    {
        public function addpr(){
        	$items = item::join('units', 'purchase_unit', '=', 'units.id')->join('categories', 'category_id', 'categories.id')->join('classifications', 'classification_id', 'classifications.id')->select('units.name as unit', 'items.*', 'classification_id as class')->get();
        	$units = unit::all();
            $classifications = classification::all();
        	$mas = master_account::where('type', 'master')->get();
        	$control = DB::table('purchase_requests')->orderBy('id', 'desc')->first();
        	$ref = '';
        	if($control == null){
                $ref =  'PR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
            }
            else{
            	
                 $ref = 'PR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($control->ref_no, -3)+1);
            }

        	return view('operations.prs.addpr')->with('items', $items)->with('mas', $mas)->with('units', $units)->with('classifications', $classifications)->with('ref', $ref);
        }
        public function submitpr(Request $data){
        	//return $data->all();

           

            $control = DB::table('purchase_requests')->where('ref_no', $data['no'])->orderBy('id','desc')->first();
          
            $ref = $data['no'];
            if($control != null){
                $controls = DB::table('purchase_requests')->orderBy('id','desc')->first();
                $ref =  'PR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($controls->ref_no, -3)+1);
            }
            
            //dreturn $control;
            $employee = employee::join('users', 'employee_id', '=', 'employees.id')->where('users.usertype_id', '11')->first();
            $emp = employee::join('users', 'employee_id', '=', 'employees.id')->where('employee_id', Auth::user()->employee_id)->first();

            $dc = employee::where('division', $emp->division)->where('designation', 'DC')->first();
            //return $emp;

            $pr = new purchase_request();
            if($data['type'] == 'edit'){
                $pr = purchase_request::find($data['id']);
                $ref = $pr['ref_no'];
            }

        	$pr['ref_no'] = $ref;
        	$pr['entity'] = $data['entity'];
        	$pr['fund_cluster'] = $data['fc'];
            $pr['type'] = $data['classification'];
        	$pr['purpose'] = $data['purpose'];
        	$pr['date'] = Carbon::parse($data['date']);
        	$pr['within_ppmp'] = $data['rdio'] == 'true' ? true : false;
        	$pr['requested_by'] = Auth::user()->employee_id;
        	$pr['approved_by'] = $dc->id;
        	$pr['certified_by'] = $employee->employee_id;
            $pr['status'] = $emp->usertype_id == 4 ? "FOR DC's APPROVAL" : 'PENDING';
            $pr['prtype'] = $data['classification'];
        	$pr['total_amount'] = $data['total'];

        	$pr->save();

            if($data['type'] == 'edit'){
                $prl = new pr_line();
                $prl->deletelines($data['id']);
            }
        	foreach ($data['items'] as $array => $arr) {
                        $ol = new pr_line();
                        $ol->pr_id = $pr->id;
                        $ol->item_id = $arr['stock'];   
                        $ol->qty = $arr['qty'];
                        $ol->unit_cost = $arr['cost'];
                        $ol->total_cost = $arr['total'];
                        $ol->unit = $arr['unit'];
                        $ol->save();
                    }
             
            //return Auth::user()->usertype_id; 
             if(Auth::user()->usertype_id == 4 || Auth::user()->usertype_id == 9){
                return redirect(route('prsstaff'))->with('success', 'Purchase No. '.$pr->ref_no.' Updated Successfully');
             } 
             else{
                return redirect(route('prs'))->with('success', 'Purchase No. '.$pr->ref_no.' Updated Successfully');
             }      
            
        }

        public function editpr($id){
            $pr = purchase_request::find($id);
            $prl = new pr_line();
            $units = unit::all();
            $items = item::join('units', 'purchase_unit', '=', 'units.id')->select('units.name as unit', 'items.*')->get();
            $prlines = $prl->prlines($id);

            return view('operations.prs.editpr')->with('prlines', $prlines)->with('pr', $pr)->with('items', $items)->with('units', $units);
        }

        public function prs(){
        	$prs = purchase_request::join('employees', 'purchase_requests.requested_by', '=', 'employees.id')->select('employees.first_name', 'employees.last_name', 'purchase_requests.*')->get();
        	$suppliers = supplier::all();
            $rfq = new rfq();
             $po = new purchase_order();
        	 $array = [];
              $procmodes = DB::table('procmodes')->get();
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
        	return view('operations.prs.prs')->with('prs', $array)->with('suppliers', $suppliers)->with('procmodes', $procmodes)->with('rfqno', $rfq->getcontrol())->with('pono', $po->getcontrol(1)[0]);
        }

        public function updatepr($id, $status, $type){
            //return $id.' '.$status;

            $pr = purchase_request::where('id', $id)->first();
            $pr->status = $type =='charge' ? 'PAID WITH '.strtoupper($status) : $status;
            $pr->save();

            if(Auth::user()->usertype_id == 4 || Auth::user()->usertype_id == 9 || Auth::user()->usertype_id == 1 || Auth::user()->usertype_id == 10 ||Auth::user()->usertype_id == 2){
                return redirect(route('prsstaff'))->with('success', 'Purchase No. '.$pr->ref_no.' Updated Successfully');
             } 
             else{
                return redirect(route('prs'))->with('success', 'Purchase No. '.$pr->ref_no.' Updated Successfully');
             } 

        }

        public function getprlines(Request $data){
        	//return $data->all();

        	$prlines = new pr_line();
        	return $prlines->prlines($data['id']);
        }

        public function submitrfq(Request $data){
            //return $data->all();
            $prs = purchase_request::find($data['prid']);
            $prs->status = 'With RFQ';
            $prs->save();
            $rfq = new rfq();

            if($data['type'] == 'edit'){
                $rfq = rfq::find($data['id']);
            }

            $control = DB::table('rfqs')->where('ref_no', $data['refno'])->first();
            $ref = $data['refno'];
            if($control != null){
                 $controls = DB::table('rfqs')->orderBy('id','desc')->first();
                $ref =  'RFQ-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($controls->ref_no, -3)+1);
            }
            $rfq['ref_no'] = $ref;
            $rfq['pr_id'] = $data['prid'];
            $rfq['philgeps_no'] = $data['phgpsno'];
            $rfq['total_amount'] = $data['gtotal'];
            $rfq['date'] = Carbon::parse($data['date']);
            $rfq['supplier_id'] = $data['supplier'];
            $rfq['user_id'] = Auth::user()->employee_id;
            $rfq['amount_words'] = $data['amountwords'];
            $rfq['canvass_amount'] = 0;
            $rfq['status'] = 'FOR CANVASS';
            $rfq->save();

            if($data['type'] == 'edit'){
                $prl = new rfq_line();
                $prl->deletelines($data['id']);
            }

            foreach ($data['items'] as $pritems => $arr) {
                if(isset($arr['prline_id'])){
                    $rf = new rfq_line();
                    $rf->rfq_id = $rfq->id;
                    $rf->prline_id = $arr['prline_id'];   
                    $rf->qty = $arr['qty'];
                    $rf->unit_cost = $arr['unit_cost'];
                    $rf->total_cost = $arr['total_cost'];
                    $rf->unit_price = 0;
                    $rf->total_price = 0;
                    $rf->unit = $arr['unit'];
                    $rf->status = '0';
                    $rf->save();
                }
                        
            }

             return redirect(route('rfqs'))->with('success', 'RFQ No. '.$rfq->ref_no.' Saved Successfully');
        }

        public function rfqs(){
            $prs = purchase_request::join('employees', 'purchase_requests.requested_by', '=', 'employees.id')->select('employees.first_name', 'employees.last_name', 'purchase_requests.*')->get();
            $suppliers = supplier::all();
             $rfqs = rfq::join('purchase_requests', 'pr_id', '=', 'purchase_requests.id')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->select('rfqs.*', 'purchase_requests.purpose', 'suppliers.name as supplier', 'suppliers.address', 'suppliers.tin', 'purchase_requests.ref_no as prno', 'purchase_requests.id as prid')->get();
             $array = [];
            foreach ($prs as $key) {
                $qty = pr_line::where('pr_id', $key->id)->count('id');
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
                );
            
            }
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
            return view('operations.rfqs.rfqs')->with('prs', $array)->with('rfqs', $array2)->with('suppliers', $suppliers);
        }

        public function editrfq($id){
            $rfq = rfq::find($id);
            $rfqline = new rfq();
            $suppliers = supplier::all();
            $units = unit::all();
            $rfqlines = $rfqline->getrfqlines($id);

            return view('operations.rfqs.editrfq')->with('rfqlines', $rfqlines)->with('rfq', $rfq)->with('units', $units)->with('suppliers', $suppliers);
        }

        public function getrfqs(Request $data){
            $pr = purchase_request::where('ref_no', $data['id'])->first();
            $rfqs = new rfq();
            
            return $rfqs->getrfq($pr['id']);
        }

        public function getrfqlines(Request $data){
            //return $data->all();

            $rfqlines = new rfq();
            return $rfqlines->getrfqlines($data['id']);
        }

        public function getsuppliers(Request $data){
            //$pr = purchase_request::where('ref_no', $data['id'])->first();
            $rfqs = new rfq();
            $abstract = new abstracts();
            
            return array($abstract->getcontrol(), $rfqs->getsuppliers($data['rfqs']));
        }

        public function updaterfqline(Request $data){
            //return $data->all();
            

            $rfq = rfq_line::find($data['id']);
            //return $rfq;
            $rfq->unit_price = $data['unitp'];
            $rfq->total_price = $data['totalp'];
            if($rfq->save()){

                $total =rfq_line::where('rfq_id', $data['rfq'])->sum('total_price');
                $rfqs = rfq::find($data['rfq']);
                $rfqs->status = 'CANVASSED';
                $rfqs->canvass_amount = $total;
                $rfqs->save();
                return 'success';
            }
            else{
                return 'error';
            }
        }

        public function submitabstract(Request $data){
            //return $data->all();
            $rfqs = explode(',', $data['rfqs']);
            //return $rfqs;

            $chair='';
            $members='';
            $employee = employee::join('users', 'employee_id', '=', 'employees.id')->get();
            $vchair =employee::join('users', 'employee_id', '=', 'employees.id')->where('usertype_id', '10')->first();
            $rd = employee::where('posabv', 'RD')->first();
            foreach ($employee as $key) {
                if($key->usertype_id == 1){
                    $chair = $key->first_name.' '.$key->middle_name[0].'. '.$key->last_name;
                }
                else if($key->usertype_id == 2){
                    
                    $members .= $key->first_name.' '.$key->middle_name[0].'. '.$key->last_name.'|';
                }
            }

            $control = DB::table('abstracts')->where('ref_no', $data['absno'])->first();
                $ref = $data['absno'];
                if($control != null){
                     $controls = DB::table('abstracts')->orderBy('id','desc')->first();
                    $ref =  'AC-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($controls->ref_no, -3)+1);
                }

            $abstract = new abstracts();
            if($data['type'] == 'edit'){
                $abstract = abstracts::find($data['id']);
                
            }
            $abstract->chair = $chair;
            $abstract->remarks = $data['remarks'];
            $abstract->vc = $vchair->first_name.' '.$vchair->middle_name[0].'. '.$vchair->last_name;
            $abstract->members = $members;
            $abstract->rd = $rd->first_name.' '.$rd->middle_name[0].'. '.$rd->last_name;
            
            $abstract->ref_no = $ref;
            $abstract->pr_no = $data['prid'];
            $abstract->date = Carbon::parse($data['date']);      
            $abstract->save();

            

            $prs = purchase_request::where('ref_no', $data['prid'])->first();
            $prs->status = 'CANVASSED AND AWARDED';
            $prs->save();

            if($data['type'] == 'edit'){
                $prl = new abstract_rfq();
                $prl->deletelines($data['id']);
                foreach ($rfqs as $rfq) {

                    $rfs = DB::table('rfq_lines')->where('rfq_id', $rfq)->update(array('status' => '0'));
                    
                    $rfqr = rfq::where('id', $rfq)->first();
                    $rfqr->status = 'CANVASSED';
                    $rfqr->awarded_amount =  0;
                    $rfqr->save();
                }
            }
            //

            foreach ($data['abs'] as $ab => $arr) {
                $abrs = abstract_rfq::where('rfq_id', $arr['rfq_id'])->first();
                $rfq = rfq::where('id', $arr['rfq_id'])->first();
                $rfq->awarded_amount +=  $arr['amount'];
                $rfq->status = 'AWARDED';
                $rfq->save();
                
                if(empty($abrs)){
                    $abr = new abstract_rfq();
                    $abr->abstract_id = $abstract->id;
                    $abr->rfq_id = $arr['rfq_id'];
                    $abr->status = 'awarded';
                    $abr->save();
                }
                
                

                $rf = rfq_line::find($arr['id']);
                $rf->status = 'awarded';
                $rf->save();
            }

             foreach ($rfqs as $rfq) {
                //return $rfqr;
                $abrs = abstract_rfq::where('rfq_id', $rfq)->first();
                

                if(empty($abrs)){
                    $abr = new abstract_rfq();
                    $abr->abstract_id = $abstract->id;
                    $abr->rfq_id = $rfq;
                    $abr->status = 'not awarded';
                    $abr->save();
                }

                else{

                }
            }



            return redirect(route('abstracts'))->with('success', 'AC No. '.$abstract->ref_no.' Saved Successfully');
        }

        public function abstracts(){
            $prs = abstracts::join('purchase_requests', 'abstracts.pr_no', '=', 'purchase_requests.ref_no')->select('abstracts.*', 'purchase_requests.date as prdate', 'purchase_requests.total_amount', 'purchase_requests.purpose', 'purchase_requests.status')->get();
            //return $prs;
            $procmodes = DB::table('procmodes')->get();
            $suppliers = supplier::all();
            $rfq = new rfq();
            $units = unit::all();
            $mas = master_account::where('type', 'master')->get();
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
            return view('operations.abstracts.abstracts')->with('prs', $array)->with('suppliers', $suppliers)->with('units', $units)->with('mas', $mas)->with('rfqno', $rfq->getcontrol())->with('procmodes', $procmodes);
        }

        public function editabstract($id){
            $abstracts = new rfq();
            $abs = abstract_rfq::where('abstract_id', $id)->pluck('rfq_id');
            $prs = abstracts::join('purchase_requests', 'abstracts.pr_no', '=', 'purchase_requests.ref_no')->select('abstracts.*', 'purchase_requests.date as prdate', 'purchase_requests.total_amount', 'purchase_requests.purpose')->where('abstracts.id', $id)->first();

            $rfqslines = rfq_line::join('pr_lines', 'prline_id', '=', 'pr_lines.id')->join('items', 'pr_lines.item_id', '=', 'items.id')->join('rfqs', 'rfq_id', '=', 'rfqs.id')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->whereIn('rfq_lines.rfq_id', $abs)->select('items.name','items.id as stockno', 'pr_lines.unit_cost', 'pr_lines.total_cost', 'pr_lines.qty', 'rfq_lines.*', 'suppliers.name as supplier')->get();
            //return $abstracts->getpolines($id, $abs);
            return view('operations.abstracts.editabstract')->with('abstracts', $abstracts->getpolines($id, $abs))->with('prs', $prs)->with('rfqslines', $rfqslines)->with('abs', $abs);
        }

        public function createpos(Request $data){
            $po = new purchase_order();
            $prlines = new pr_line();
            $prlines = $prl->prlines($data['id']);

            return array($po->getcontrol($data['num']), $prlines);
        }

        public function getpolines(Request $data){
            $po = new purchase_order();
            $getpo = new rfq();

            $abs = abstract_rfq::where('abstract_id', $data['id'])->where('abstract_rfqs.status', 'awarded')->distinct('rfq_id')->pluck('rfq_id');
            //return $abs;
           
            return array($po->getcontrol(count($abs)), $getpo->getpolines($data['id'], $abs));
        }

        public function submitpo(Request $data){
            //return $data->all();
            if(isset($data['rfq'])){

            

                foreach ($data['rfq'] as $key => $arr) {

                    $control = DB::table('purchase_orders')->where('ref_no', $arr['poref'])->first();
                        $ref = $arr['poref'];
                    if($control != null){
                         $controls = DB::table('purchase_orders')->orderBy('id','desc')->first();
                        $ref =  'PO-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', $controls->id+1);
                    }

                    $rd = employee::where('posabv', 'RD')->first();
                    $pr = rfq::join('purchase_requests', 'pr_id','=', 'purchase_requests.id')->where('rfqs.id', $arr['id'])->pluck('purchase_requests.ref_no');
                    $prs = purchase_request::where('ref_no', $pr[0])->first();
                    $prs->status = 'PURCHASED';
                    $prs->save();
                    //return $pr;
                    $po = new purchase_order();
                    $po->rfq_id = $arr['id'];
                    $po->ref_no = $ref;
                    $po->amount_words = $arr['amountwords'];
                    $po->procmode = $arr['procmode'];
                    $po->pr_no = $pr[0];
                    $po->certified_funds = 25;
                    $po->amount = $arr['gtotal'];
                    // $po->ors_no = $arr['orsno'];
                    // $po->ors_date = Carbon::parse($arr['orsdate']);
                    // $po->ors_amount = $arr['orsamount'];
                    $po->supplier_id = $arr['supplier'];
                    $po->rd = $rd->first_name.' '.$rd->middle_name[0].'. '.$rd->last_name;
                    $po->date = Carbon::parse($arr['date']);
                    $po->status = 'FOR ORS/BURS';
                    $po->save();

                }
            }
            else{
                $control = DB::table('purchase_orders')->where('ref_no', $data['refno'])->first();
                $ref = $data['refno'];
                if($control != null){
                     $controls = DB::table('purchase_orders')->orderBy('id','desc')->first();
                    $ref =  'PO-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', $controls->id+1);
                }

                $rd = employee::where('posabv', 'RD')->first();
                $prs = purchase_request::where('purchase_requests.id', $data['prid'])->first();
                $prs->status = 'PURCHASED';
                $prs->save();
                //return $pr;
                $po = new purchase_order();
                $po->pr_no = $prs['ref_no'];
                $po->ref_no = $ref;
                $po->psno = $data['pno'];
                $po->procmode = $data['procmode'];
                $po->amount_words = $data['amountwords'];
                //$po->fund_cluster = $arr['fund'];
                $po->certified_funds = 25;
                $po->amount = $data['gtotal'];
                // $po->ors_no = $arr['orsno'];
                // $po->ors_date = Carbon::parse($arr['orsdate']);
                // $po->ors_amount = $arr['orsamount'];
                $po->supplier_id = $data['supplier'];
                $po->rd = $rd->first_name.' '.$rd->middle_name[0].'. '.$rd->last_name;
                $po->date = Carbon::parse($data['date']);
                $po->status = 'FOR ORS/BURS';
                $po->save();
            }

            foreach ($data['items'] as $key => $arr) {
                if(isset($arr['rfq_id'])){
                    $pos = purchase_order::where('rfq_id', $arr['rfq_id'])->first();
                    $rfql = rfq_line::where('id', $arr['id'])->first();
                    $poline = new po_line;
                    $poline->po_id = $pos->id;
                    $poline->qty = $arr['qty'];
                    $poline->prline_id = $rfql->prline_id;
                    $poline->rfqline_id = $arr['id'];
                    $poline->unit = $arr['unit'];
                    $poline->unit_cost = $arr['unit_cost'];
                    $poline->total_cost = $arr['total_cost'];
                    //return $poline;
                    $poline->save();
                }
                else{
                    $po = purchase_order::where('ref_no', $data['refno'])->first();
                    $poline = new po_line;
                    $poline->po_id = $po->id;
                    $poline->qty = $arr['qty'];
                    $poline->prline_id = $arr['id'];
                    $poline->unit = $arr['unit'];
                    $poline->unit_cost = $arr['unit_cost'];
                    $poline->total_cost = $arr['total_cost'];
                    $poline->save();
                }
                
               
            }

            return redirect(route('pos'))->with('success', 'PO No. '.$po->ref_no.' Saved Successfully');
        }

        public function editpo(Request $data){
            //return $data->all();

                $po = purchase_order::where('ref_no', $data['refno'])->first();
                //$po->rfq_id = $arr['id'];
                //$po->ref_no = $data['poref'];
                $po->amount_words = $data['amountwords'];
                //$po->fund_cluster = $arr['fund'];
                $po->procmode = $data['procmode'];
                $po->certified_funds = 25;
                $po->amount = $data['gtotal'];
                // $po->ors_no = $arr['orsno'];
                // $po->ors_date = Carbon::parse($arr['orsdate']);
                // $po->ors_amount = $arr['orsamount'];
                $po->supplier_id = $data['supplier'];
                //$po->rd = $rd->first_name.' '.$rd->middle_name[0].'. '.$rd->last_name;
                $po->date = Carbon::parse($data['date']);
                //$po->status = 'FOR ORS/BURS';
                $po->save();

                foreach ($data['items'] as $key => $arr) {
                    $poline = po_line::find($arr['id']);
                    $poline->unit_cost = $arr['unit_cost'];
                    $poline->total_cost = $arr['total_cost'];
                    $poline->qty = $arr['qty'];
                    $poline->save();
                }

                return redirect(route('pos'))->with('success', 'PO No. '.$po->ref_no.' Saved Successfully');
        }

        public function setors(Request $data){
            //return $data->all();
            $po = purchase_order::where('id', $data['id'])->first();
            $po->status = 'PENDING';
            
            $po->master_id = $data['master'];
            $po->save();

            $obligation = new obligation();
            $obligation->ref_no = $data['orsno'];
            $obligation->doc_id = $po['id'];
            $obligation->doc_type = "PO";
            $obligation->date = Carbon::parse($data['orsdate']);
            $obligation->total_amount = $data['orsamount'];
            $obligation->fund = $data['fund'];
            $obligation->fund_type = $data['fctype'];
            $obligation->particulars = $data['particulars'];
            $obligation->mfo = $data['mfo'];
            $obligation->uacs = $data['uacs'];
            $obligation->requested_by = Auth::user()->employee_id;
            $obligation->certified_funds = 25;
            $obligation->save();

            return redirect(route('pos'))->with('success', 'PO No. '.$po->ref_no.' Saved Successfully');
        }
        public function pos(){
            $pos = purchase_order::join('purchase_requests', 'pr_no', '=', 'purchase_requests.ref_no')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->join('employees', 'certified_funds', '=', 'employees.id')->leftjoin('master_accounts', 'master_id', '=', 'master_accounts.id')->select('purchase_orders.*', 'employees.first_name', 'employees.last_name', 'suppliers.name', 'purchase_requests.purpose', 'master_accounts.name as acc','purchase_requests.ref_no as prno')->get();
            $procmodes = DB::table('procmodes')->get();
            $employees = employee::all();
            $suppliers = supplier::all();
            $mas = master_account::where('type', 'master')->get();;
            $units = unit::all();
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
            $acc = new acceptance();
            return view('operations.abstracts.pos')->with('pos', $array)->with('employees', $employees)->with('suppliers', $suppliers)->with('mas', $mas)->with('procmodes', $procmodes)->with('units', $units)->with('iarno', $acc->getcontrol());
        }

        public function getpolist(Request $data){
            $poline = new purchase_order();
            return $poline->getpolines($data['id']);
        }

        public function submitacc(Request $data){
            //return $data->all();

            $control = DB::table('acceptances')->where('ref_no', $data['refno'])->first();
                $ref = $data['refno'];
            if($control != null){
                 $controls = DB::table('acceptances')->orderBy('id','desc')->first();
                $ref =  'RIS-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', $controls->id+1);
            }
            if($data['type'] == 'save'){
                $po = purchase_order::find($data['prid']);
                $po->status = 'INSPECTED AND RECEIVED';
                $po->save();

                

            
            }
            else{
                $ref = $data['refno'];
            }


            
             if($data['type'] == 'edit'){
                $acc = acceptance::where('ref_no', $data['refno'])->first();
                $acc->ref_no = $ref;
                $acc->date = Carbon::parse($data['date']);
                $acc->invoice_no = $data['invoice'];
                $acc->invoice_date = Carbon::parse($data['indate']);
                $acc->invoice_no = $data['invoice'];
                $acc->employee_id = 2;
                $acc->date_inspected = Carbon::parse($data['insdate']);
                $acc->date_received = Carbon::parse($data['rcdate']);
                $acc->inspected_by = $data['inemployee'];
                $acc->received_by = $data['premployee'];
                $acc->save();

                return redirect(route('pos'))->with('success', 'IAR No. '.$acc->ref_no.' Saved Successfully');
             }
             else{
                $acc = new acceptance();

                $acc->po_id = $data['prid'];
                $acc->ref_no = $ref;
                $acc->date = Carbon::parse($data['date']);
                $acc->invoice_no = $data['invoice'];
                $acc->invoice_date = Carbon::parse($data['indate']);
                $acc->invoice_no = $data['invoice'];
                $acc->employee_id = 2;
                $acc->date_inspected = Carbon::parse($data['insdate']);
                $acc->date_received = Carbon::parse($data['rcdate']);
                $acc->inspected_by = $data['inemployee'];
                $acc->received_by = $data['premployee'];
                $acc->inspected = $data['instatus'];
                $acc->complete = $data['status'];
                $acc->save();

                return redirect(route('pos'))->with('success', 'IAR No. '.$acc->ref_no.' Saved Successfully');
             }

            

            
        }

        public function editiar(Request $data){
            $acc =  acceptance::join('purchase_orders', 'po_id', '=', 'purchase_orders.id')->where('purchase_orders.id', $data['id'])->select('acceptances.*')->first();
            return $acc;
        }

        public function stockin(Request $data){
            //return $data->all();
            $ac = acceptance::where('ref_no', $data['iacid'])->pluck('po_id');
            $po = purchase_order::find($ac[0]);
            $po->status = 'STOCKED IN';
            $po->save();
            $pr = purchase_request::where('ref_no', $data['prid'])->first();
            $pr->status = 'IN THE INVENTORY';
            $pr->save();
            foreach ($data['items'] as $key => $item) {
                # code...

                $inv = inventory::where('item_id', $item['id'])->where('master_id', $data['master'])->pluck('id');
                $stock = inventory::where('item_id', $item['id'])->where('master_id', $data['master'])->orderBy('date', 'desc')->pluck('qty_instock');

                if($inv == '[]'){
                    $invs = new inventory();
                    $invs->item_id = $item['id'];
                    $invs->master_id = $data['master'];
                    $invs->date = Carbon::now();
                    $invs->qty_instock =  $item['qty'];
                    $invs->unit_cost =  $item['unit_cost'];
                    $invs->total_cost =  $item['total_cost'];
                    $invs->unit =  $item['unit'];
                    $invs->danger_lvl =   $item['qty'] * 0.10;
                    $invs->save();

                    $inop = new inventory_operation();
                    $inop->inventory_id = $invs->id;
                    $inop->operation = 'IN';
                    $inop->reason = 'STOCK IN';
                    $inop->qty =$item['qty'];
                    $inop->unit_cost =$item['unit_cost'];
                    $inop->date = Carbon::now();
                    $inop->pr_no = $data['prid'];
                    $inop->total_cost =  $item['total_cost'];
                    $inop->iac_id = $data['iacid'];
                    $inop->balance = $item['qty'];
                    $inop->save();
                    	
                    	$invmov = new inventory_mov();
		        $invmov->inventory_id = $invs->id;
		        $invmov->quantity = $invs->qty_instock;
		        $invmov->unit = $invs->unit;
		        $invmov->unit_cost = $invs->unit_cost;
		        $invmov->amount = $invs->total_cost;
		        $invmov->asof = Carbon::parse($data['date']);
		        $invmov->save();
                }
                else{
                    $in = inventory::find($inv[0]);
                    $in->qty_instock = $stock[0] + $item['qty'];
                    $in->danger_lvl =$in->qty_instock * 0.10;
                    $in->date = Carbon::now();
                    $in->save();
                    $inop = new inventory_operation();
                    $inop->inventory_id = $inv[0];
                    $inop->operation = 'IN';
                    $inop->reason = 'STOCK IN';
                    $inop->qty =$item['qty'];
                    $inop->unit_cost =$item['unit_cost'];
                    $inop->total_cost =  $item['total_cost'];
                    $inop->date = Carbon::now();
                    $inop->pr_no = $data['prid'];
                    $inop->iac_id = $data['iacid'];
                    $inop->balance = $item['qty']+$stock[0];
                    $inop->save();
                    
                        $invmov = new inventory_mov();
		        $invmov->inventory_id = $in->id;
		        $invmov->quantity = $in->qty_instock;
		        $invmov->unit = $in->unit;
		        $invmov->unit_cost = $in->unit_cost;
		        $invmov->amount = $in->total_cost;
		        $invmov->asof = Carbon::parse($data['date']);
		        $invmov->save();

                }
            }
            return redirect(route('items'))->with('success', 'Inventory Saved Successfully');
        }

        public function addris(){
            $ris = new ris();
            $employees = employee::all();
            $accounts = master_account::where('type', 'master')->get();
            $items = item::join('inventories', 'item_id', '=', 'items.id')->select('items.name', 'items.id as stockno', 'inventories.*')->get();
            return view('operations.abstracts.addris')->with('ref', $ris->getcontrol())->with('employees', $employees)->with('accounts', $accounts)
            ->with('items', $items);
        }

        public function submitris(Request $data){
            //return $data->all();

            $employee = employee::where('id', $data['inemployee'])->first();

            $control = DB::table('ris')->where('ref_no', $data['no'])->first();
            $ref = $data['no'];
            if($control != null){
                 $controls = DB::table('ris')->orderBy('id','desc')->first();
                $ref =  'RIS-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', $controls->id+1);
            }

            $ris = new ris();
            $ris->employee_id = $data['inemployee'];
            $ris->fund_cluster = $data['fc'];
            $ris->date = Carbon::parse($data['date']);
            $ris->entity = $data['entity'];
            $ris->ref_no = $ref;
            $ris->purpose = $data['purpose'];
            $ris->division_id = $employee->division_id;
            $ris->date_requested = Carbon::parse($data['date']);
            $ris->requested_by = $data['inemployee'];
            $ris->received_by = $data['inemployee'];
            $ris->date_requested = Carbon::parse($data['date']);
            $ris->master_id = $data['master'];
            $ris->approved_by = Auth::user()->employee_id;
            $ris->date_approved = Carbon::parse($data['date']);
            $ris->issued_by = Auth::user()->employee_id;
            $ris->date_issued = Carbon::parse($data['date']);
            $ris->status = 'ISSUED';
            $ris->save();
            
            foreach ($data['items'] as $key => $arr) {
                $rline = new ris_line();
                $rline->ris_id = $ris->id;
                $rline->item_id = $arr['stockno'];
                $rline->req_qty = $arr['qtyreq'];
                $rline->issued_qty = $arr['qtyiss'];
                $rline->available = $arr['stock'];
                $rline->unit = $arr['unit'];
                $rline->balance = $arr['stock'] -  $arr['qtyiss'];
                $rline->remarks = $arr['remark'];
                $rline->save();
                $in = inventory::where('item_id', $arr['stockno'])->where('master_id', $data['master'])->first();
                $in->qty_instock = $in->qty_instock - $arr['qtyiss'];
                $in->save();
                //$inv-> 
                $inop = new inventory_operation();
                $inop->inventory_id = $in->id;
                $inop->operation = 'OUT';
                $inop->reason = 'REQUESTED BY '.$employee->last_name.' '.$employee->first_name;
                $inop->qty =$arr['qtyiss'];
                $inop->unit_cost = $in->unit_cost;
                $inop->date = Carbon::parse($data['date']);
                $inop->ris_id = $ris->id;
                $inop->balance = $arr['stock'] -  $arr['qtyiss'];
                $inop->total_cost = $arr['qtyiss'] * $in->unit_cost;
                $inop->save();
                
                $invmov = new inventory_mov();
		        $invmov->inventory_id = $in->id;
		        $invmov->quantity = $in->qty_instock;
		        $invmov->unit = $in->unit;
		        $invmov->unit_cost = $in->unit_cost;
		        $invmov->amount = $in->total_cost;
		        $invmov->asof = Carbon::parse($data['date']);
		        $invmov->save();
            }

            return redirect(route('ris'))->with('success', 'RIS No. '.$ris->ref_no.' Saved Successfully');
        }

        public function ris(){
            $ris = new ris();
            //return $ris->ris();
            return view('operations.abstracts.ris')->with('ris', $ris->ris());
        }

        public function getrislines(Request $data){
            $ris = new ris();
            return $ris->getrislines($data['id']);
        }

        public function updaterline(Request $data){
            //return $data->all();
            $ris = ris::find($data['risid']);
            $ris->status = 'ISSUED';
            $ris->date_approved = Carbon::now();
            $ris->issued_by = Auth::user()->employee_id;
            $ris->date_issued = Carbon::now();        
            $ris->approved_by = Auth::user()->employee_id;
            $ris->received_by = $ris->employee_id;
            $ris->date_received = Carbon::now();        
            $ris->save();
            
            //return $ris;
            $ris_line = new ris_line();
            $ris_line->updaterline($data->all(), $ris->master_id, $ris->employee_id);
            
            return redirect(route('ris'))->with('success', 'Data Saved Successfully');
        }
        
         public function kanban(){
         	
            $prs = purchase_request::join('employees', 'purchase_requests.requested_by', '=', 'employees.id')->select('employees.first_name', 
            'employees.last_name', 'purchase_requests.*')->where('date', '>=', Carbon::now()->subDays(40)->endOfDay())->get();
            $rfqss = [];
            $abs = [];
            $poss = [];
            foreach ($prs as $key) {
                $rfqs = rfq::where('pr_id', $key->id)->pluck('rfqs.ref_no');
                if(!$rfqs->isEmpty()){
                    $rfqss[] = array(
                        'id' => $key->id,
                        'refs' => $rfqs
                    );
                }
               
                $abstracts = abstracts::where('pr_no', $key['ref_no'])->pluck('abstracts.ref_no');
                if(!$abstracts->isEmpty()){
                    $abs[] = array(
                        'id' => $key->id,
                        'refs' => $abstracts
                    );
                }
                $pos = purchase_order::where('pr_no', $key['ref_no'])->pluck('ref_no');
                if(!$pos->isEmpty()){
                    $poss[] = array(
                        'id' => $key->id,
                        'refs' => $pos
                    );
                }
            }
            //return $rfqss;
            
            
            return view('operations.kanban')->with('prs', $prs)->with('array', array($rfqss, $abs, $poss))->with('date', Carbon::now()->subDays(40)->endOfDay().' - '.Carbon::now());
        }

        public function searchkanban(Request $data){
            //return $data->all();
            $date = explode('-', $data['daterange']);
            $prs = purchase_request::join('employees', 'purchase_requests.requested_by', '=', 'employees.id')->select('employees.first_name', 
            'employees.last_name', 'purchase_requests.*')->whereBetween('date', [Carbon::parse($date[0])->toDateString(),Carbon::parse($date[1])->toDateString()])->get();
            $rfqss = [];
            $abs = [];
            $poss = [];
            foreach ($prs as $key) {
                $rfqs = rfq::where('pr_id', $key->id)->pluck('rfqs.ref_no');
                if(!$rfqs->isEmpty()){
                    $rfqss[] = array(
                        'id' => $key->id,
                        'refs' => $rfqs
                    );
                }
               
                $abstracts = abstracts::where('pr_no', $key['ref_no'])->pluck('abstracts.ref_no');
                if(!$abstracts->isEmpty()){
                    $abs[] = array(
                        'id' => $key->id,
                        'refs' => $abstracts
                    );
                }
                $pos = purchase_order::where('pr_no', $key['ref_no'])->pluck('ref_no');
                if(!$pos->isEmpty()){
                    $poss[] = array(
                        'id' => $key->id,
                        'refs' => $pos
                    );
                }
            }
            //return $prs;
            
            
            return view('operations.kanban')->with('prs', $prs)->with('array', array($rfqss, $abs, $poss))->with('date', Carbon::now()->subDays(40)->endOfDay().' - '.Carbon::now());
        }


 	public function updateprlist(Request $data){
            //return $id.' '.$status;
            //return $data->all();

            $pr = purchase_request::whereIn('id', $data['prs'])->update(['status' => 		$data['status']]);
          

                return 'ok';
            



        }
        
        public function updateitems(Request $data){
            //return $id.' '.$status;
            //return $data->all();

            $pr = item::whereIn('id', $data['items'])->update(['status' => 		$data['status']]);
          

                return 'ok';
            



        }
    
}
