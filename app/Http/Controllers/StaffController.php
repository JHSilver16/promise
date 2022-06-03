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
use App\classification;
use App\rfq;
use App\abstracts;
use App\purchase_order;
use App\acceptance;
use App\rfq_line;
use App\master_account;
use App\po_line;
use App\ris;
use App\ris_line;
use App\requests;
use App\obligation;
use Auth;

class StaffController extends Controller
{
    public function addris(){
        $ris = new ris();
        $employees = employee::all();
         $accounts = master_account::where('type', 'master')->get();
         
        $items = item::join('inventories', 'item_id', '=', 'items.id')->where('qty_instock', '>', '0')->select('items.name', 'items.id as stockno', 'inventories.*')->get();
        return view('staff.addris')->with('ref', $ris->getcontrol())->with('employees', $employees)->with('accounts', $accounts)
        ->with('items', $items);
    }

    public function editris($id){
        $ris = ris::find($id);
        $risl = new ris_line();
        $units = unit::all();
        $accounts = master_account::where('type', 'master')->get();
        $rislines = $risl->ris_lines($id);
        $items = item::join('inventories', 'item_id', '=', 'items.id')->where('qty_instock', '>', '0')->select('items.name', 'items.id as stockno', 'inventories.*')->get();
        return view('staff.editris')->with('rislines', $rislines)->with('ris', $ris)->with('items', $items)->with('accounts', $accounts)->with('units', $units);
    }

    public function submitris(Request $data){
        //return $data->all();
    	$employee = employee::where('id', Auth::user()->employee_id)->first();
        $control = DB::table('ris')->where('ref_no', $data['no'])->first();
        $ref = $data['no'];
            if($control != null){
                 $controls = DB::table('ris')->orderBy('id','desc')->first();
                $ref =  'RIS-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', $controls->id+1);
        }
        $ris = new ris();
        if($data['type'] == 'edit'){
            $ris = ris::find($data['id']);
            $ref = $ris['ref_no'];
        }
    	
        $ris->employee_id = Auth::user()->employee_id;
        $ris->fund_cluster = $data['fc'];
        $ris->date = Carbon::parse($data['date']);
        $ris->entity = $data['entity'];
        $ris->ref_no = $ref;
        $ris->purpose = $data['purpose'];
        $ris->division_id = $employee->division_id;
        $ris->master_id = $data['master'];
        $ris->date_requested = Carbon::parse($data['date']);
        $ris->requested_by = Auth::user()->employee_id;
        //$ris->date_requested = Carbon::parse($data['date']);
        $ris->status = 'PENDING';
        $ris->date_issued = Carbon::parse($data['date']);
        $ris->save();
        //return $ris;
        if($data['type'] == 'edit'){
            $riss = new ris_line();
            $riss->deletelines($data['id']);
        }
        //return (json_decode($data['type'] == 'edit'));
        foreach ($data['items'] as $key => $arr) {
            $rline = new ris_line();
            $rline->ris_id = $ris->id;
            $rline->item_id = $arr['stockno'];
            $rline->req_qty = $arr['qtyreq'];
            $rline->available = $arr['stock'];
            $rline->unit = $arr['unit'];
            $rline->save();

        }

        return redirect(route('risstaff'))->with('success', 'RIS No. '.$ris->ref_no.' Saved Successfully');
    }

    public function addpr(){
        $items = item::join('units', 'purchase_unit', '=', 'units.id')->join('categories', 'category_id', 'categories.id')->join('classifications', 'classification_id', 'classifications.id')->select('units.name as unit', 'items.*', 'classification_id as class')->get();
            $units = unit::all();
            $classifications = classification::where('type', 'LIKE', '%staff%')->get();
            $mas = master_account::where('type', 'master')->get();
            $control = DB::table('purchase_requests')->orderBy('id', 'desc')->first();
            $ref = '';
            if($control == null){
                $ref =  'PR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
            }
            else{
                
                 $ref = 'PR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($control->ref_no, -3)+1);
            }

            return view('staff.addpr')->with('items', $items)->with('mas', $mas)->with('units', $units)->with('classifications', $classifications)->with('ref', $ref);
    }

    public function prs(){
             $emp = employee::where('id', Auth::user()->employee_id)->first();
            $prs = purchase_request::join('employees', 'purchase_requests.requested_by', '=', 'employees.id')->select('employees.first_name', 'employees.last_name', 'purchase_requests.*')->where('employees.division', $emp->division)->get();

            $suppliers = supplier::all();
            $rfq = new rfq();
             $po = new purchase_order();
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
                    'rfqs' => count($rfqs),
                    'requested_by' => $key->requested_by,
                    
                );
            
            }
            //return $array;
            return view('staff.prs')->with('prs', $array)->with('auth', $emp)->with('suppliers', $suppliers)->with('rfqno', $rfq->getcontrol())->with('pono', $po->getcontrol(1)[0]);
        }

        public function editpr($id){
            $pr = purchase_request::find($id);
            $prl = new pr_line();
            $units = unit::all();
            $items = item::join('units', 'purchase_unit', '=', 'units.id')->select('units.name as unit', 'items.*')->get();
            $prlines = $prl->prlines($id);

            return view('staff.editpr')->with('prlines', $prlines)->with('pr', $pr)->with('items', $items)->with('units', $units);
        }

    public function ris(){
    	$ris = ris::join('employees as c', 'requested_by', '=', 'c.id')->leftjoin('employees as a', 'issued_by', '=', 'a.id')->leftjoin('employees as b', 'received_by', '=', 'b.id')->where('employee_id', Auth::user()->employee_id)->select('ris.*', DB::raw('CONCAT(a.last_name, ", ", a.first_name) AS infull_name'), DB::raw('CONCAT(b.last_name, ", ", b.first_name) AS rcfull_name'), DB::raw('CONCAT(c.last_name, ", ", c.first_name) AS rqfullname'))->get();
        //return $ris;
        $array = [];
        foreach ($ris as $key) {
            $master = master_account::where('id', $key->master_id)->first();
            $qty = ris_line::where('ris_id', $key->id)->count('id');
            $array[] = array(
                'no' => $key->ref_no,
                'id' => $key->id,
                'master' => empty($master) ? '' : $master->name,
                'employee' => $key->rqfullname,
                'entity' => $key->entity,
                'items' => $qty,
                'purpose' => $key->purpose,
                'date' => $key->date,
                'issued_by' => $key->infull_name,
                'received_by' => $key->rcfull_name,
                'status' => $key->status,
            );
        
        }

        //return $array;
         return view('staff.ris')->with('ris', $array);
        
    }

    public function requestitem(Request $data){
        //return $data->all();
        foreach ($data['items'] as $key => $k) {
            $req = new requests();
            $req->item = $k['name'];
            $req->qty = $k['qty'];
            $req->reason = $data['reason'];
            $req->employee_id = Auth::user()->id;
            $req->save();
        }

        return redirect(route('itemreqs'))->with('success', 'Item Request Saved Successfully');
    }

    public function items(){
         $items = item::all();
          $reqs = requests::where('employee_id', Auth::user()->employee_id)->select('requests.*')->get();
          return view('staff.items')->with('reqs', $reqs)->with('items', $items);
    }

     public function itemlist(){
        $array = [];

        $items = item::join('categories', 'category_id', '=', 'categories.id')->join('classifications', 'classification_id', '=', 'classifications.id')->join('units', 'purchase_unit', '=', 'units.id')->select('items.*', 'categories.name as type', 'units.name as unit', 'classifications.id as cl_id')->get();
       //return $items;
        $div = employee::where('id',  Auth::user()->employee_id)->first();
        $master = master_account::where('name', $div->division)->first();
        foreach ($items as $key) {
           // /return $div;
        $invs = inventory::join('master_accounts', 'master_id', '=', 'master_accounts.id')->where('item_id', $key->id)->where('name', $master->name)->select('inventories.*', 'master_accounts.name as master')->first();
        
        
        if(count($invs) > 0){
            
                $stock = inventory::where('id', $invs->id);
                $array[] = array(
                    'type' => $key->type,
                    'id' => $key->id,
                    'cl_id'=>$key->cl_id,
                    'inv_id' => $invs->id,
                    'master' => $invs->master,
                    'name' => $key->name,
                    'cost' => $key->unit_cost,
                    'description' => $key->description,
                    'price' => empty($stock->first()) ? '' : $stock->first()->unit_cost,
                    'dangerlvl' => empty($stock->first()) ? '' : $stock->first()->danger_level,
                    'punit' => empty($stock->first()) ? '' : $stock->first()->unit,
                    'prunit' => $key->unit,
                    'qty' =>empty($stock->first()) ? 'Not purchased' : $stock->sum('qty_instock'),
                );
            }
        
         
        
        }
        //return $array;
        return view('staff.inventory')->with('items', $array);
    }

}
