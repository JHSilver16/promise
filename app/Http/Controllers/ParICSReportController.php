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
use App\ics_forms;
use App\ics_inventories;
use App\par_forms;
use App\properties;
use App\equipment_type;
use App\ppe;
use App\transfer;
use App\transfer_forms;
use App\transfer_type;
use App\disposal;
use App\disposal_line;
use App\disposal_mode;

class ParICSReportController extends Controller
{
    public function ptr($id){
         $ptr = transfer_forms::join('employees as rec', 'received_by', '=', 'rec.id')->join('employees as c', 'transfer_forms.issued_by', '=', 'c.id')->join('employees as d', 'approved_by', '=', 'd.id')->where('transfer_forms.id', $id)->select('transfer_forms.*', DB::raw('CONCAT(rec.first_name," ",SUBSTRING(rec.middle_name, 1,1),". ",rec.last_name) AS recfull_name'), DB::raw('CONCAT(d.first_name," ",SUBSTRING(c.middle_name, 1,1),". ",d.last_name) AS apfull_name'),DB::raw('CONCAT(c.first_name," ",SUBSTRING(c.middle_name, 1,1),". ",c.last_name) AS isfull_name'),  'rec.posabv as recpos','c.posabv as ispos' ,'d.posabv as appos', 'approved_others', 'issued_others', 'received_others')->first();
        //return $ptr;
        
        $array =[];
        
        $item = transfer::join('properties', 'transfers.item_id', '=', 'properties.id')->join('items','properties.item_id', '=', 'items.id')->whereIn('type', ['par', 'ptr'])->where('transform_id', $id)->get();
        //return $item;
            $from = '';
            $to = '';

            $froment = '';
            $toent = '';

            foreach($item as $it){
                

                $from =  employee::where('id', $it->from_emp)->first();
                $to = employee::where('id', $it->to_emp)->first();

                $array[] = array(
                    'date' => $it->date_acquired,
                    'property_no' =>$it->property_no,
                    'item' =>$it->brand.' '.$it->model.' '.$it->serial.' '.$it->name.' '.$it->size.'  '.$it->color,
                    'amount' =>$it->amount,
                    'status' =>$it->item_status,
                );

                $froment =$it->from_emp == 54 ? $it->from_entity : $from->first_name." ".$from->middle_name[0].". ".$from->last_name;
                $toent =$it->to_emp == 54 ? $it->to_entity : $to->first_name." ".$to->middle_name[0].". ".$to->last_name;
            }

            $icvs = transfer::join('ics_inventories', 'transfers.item_id', '=', 'ics_inventories.id')->join('items','ics_inventories.item_id', '=', 'items.id')->whereIn('transfers.type', ['ics', 'icsptr'])->where('transform_id', $id)->get();

            foreach($icvs as $it){
                
                $from =  employee::where('id', $it->from_emp)->first();
                $to = employee::where('id', $it->to_emp)->first();

                $array[] = array(
                    'date' => $it->date_acquired,
                    'property_no' =>$it->item_no,
                    'item' =>$it->brand.' '.$it->model.' '.$it->serial.' '.$it->name.' '.$it->size.' '.$it->color,
                    'amount' =>$it->amount,
                    'status' =>$it->item_status,
                );

                $froment =$it->from_emp == 54 ? $it->from_entity : $from->first_name." ".$from->middle_name[0].". ".$from->last_name;
                $toent =$it->to_emp == 54 ? $it->to_entity : $to->first_name." ".$to->middle_name[0].". ".$to->last_name;

            }

        //return $froment;
        $transfer_types = transfer_type::all();

         return view('reports.ptrprint')->with('items', $array)->with('to', $toent)->with('from', $froment)->with('ptr', $ptr)->with('transfer_types', $transfer_types);

    }

    public function icsform($id){

        $ics = ics_forms::leftjoin('acceptances', 'iar_id', '=', 'acceptances.id')->select('acceptances.ref_no as iar','ics_forms.*')->where('ics_forms.id', $id)->first();
        $array=[];
        
            $item = ics_inventories::join('items','item_id', '=', 'items.id')->where('ics_id', $id)->select('items.name', 'ics_inventories.*')->get();
            $itemnos = '';
            $items = '';
            $issued_by = '';
            $issued_to = '';

            foreach($item as $it){

                $issued_by =  employee::where('id', $it->issued_by)->first();
                $issued_to = employee::where('id', $it->issued_to)->first();

                $array[] = array(
                    'qty' => $it->qty,
                    'unit' => $it->unit,
                    'no' => $it->item_no,
                    'unit_cost' => $it->unit_cost,
                    'total_cost' =>$it->total_cost,
                    'name' =>$it->brand.' '.$it->name,
                    'life' =>  $it->life,
                );
            }
            //return $ics;
            return view('reports.icsprint')->with('ics', $ics)->with('items', $array)->with('issued_by', $issued_by)->with('issued_to', $issued_to);
        
    }

    public function parform($id){

        $par = par_forms::leftjoin('acceptances', 'iar_id', '=', 'acceptances.id')->select('acceptances.ref_no as iar','par_forms.*')->where('par_forms.id', $id)->first();
        $array=[];
        
            $item = properties::join('items','item_id', '=', 'items.id')->where('par_id', $id)->select('items.name', 'properties.*')->get();
            $itemnos = '';
            $items = '';
            $issued_by = '';
            $issued_to = '';

            foreach($item as $it){

                $issued_by =  employee::where('id', $it->issued_by)->first();
                $issued_to = employee::where('id', $it->issued_to)->first();

                $array[] = array(
                    'qty' => $it->qty,
                    'unit' => $it->unit,
                    'no' => $it->property_no,
                    'date'=> $it->date_acquired,
                    'amount' => $it->amount,
                    'name' =>$it->brand.' '.$it->name,
                );
            }
            //return $ics;
            return view('reports.parprint')->with('par', $par)->with('items', $array)->with('issued_by', $issued_by)->with('issued_to', $issued_to);
        
    }

    public function disposal($id){
        $disposal = disposal::join('employees as b', 'approved_by', '=', 'b.id')->join('employees as a', 'issued_by', '=', 'a.id')->where('disposals.id', $id)->select('disposals.*',DB::raw('CONCAT(a.first_name," ",SUBSTRING(a.middle_name, 1,1),". ",a.last_name) AS issuedby'), DB::raw('CONCAT(b.first_name," ",SUBSTRING(b.middle_name, 1,1),". ",b.last_name) AS approved_by'), 'a.position as ispos', 'b.position as appos')->first();

        $disline = disposal_line::where('disposal_id', $id)->get();

        $array = [];
        $disposal_modes = disposal_mode::all();

        foreach($disline as $d){


            if($d->type == 'ics'){
                $it = ics_inventories::join('items','item_id', '=', 'items.id')->where('ics_inventories.id', $d->item_id)->select('items.name', 'ics_inventories.*')->first();
               $array[] = array(
                    'qty' => $it->qty,
                    'no' => $it->item_no,
                    'unit_cost' => $it->unit_cost,
                    'name' =>$it->brand.' '.$it->name,
                    'date' =>  $it->date_acquired,
                );
            }
            else{
                $it = properties::join('items','item_id', '=', 'items.id')->where('properties.id', $d->item_id)->select('items.name', 'properties.*')->first();
               $array[] = array(
                    'qty' => $it->qty,
                    'no' => $it->property_no,
                    'unit_cost' => $it->amount,
                    'name' =>$it->brand.' '.$it->name,
                    'date' =>  $it->date_acquired,
                );
            }            
        }
        //return $disposal;
        return view('reports.disposalprint')->with('disposal',$disposal)->with('items', $array)->with('disposal_modes', $disposal_modes);
    }

    public function card($id, $type){
        if($type == 'ics'){
            $ics = ics_inventories::join('items','ics_inventories.item_id', '=', 'items.id')->leftjoin('ics_forms','ics_id', '=', 'ics_forms.id')->where('ics_inventories.id', $id)->select('items.name', 'ics_inventories.*', 'ics_forms.entity', 'ics_forms.fund')->first();
            $transfers = transfer::join('ics_inventories', 'transfers.item_id', '=', 'ics_inventories.id')->where('transfers.item_id', $id)->whereIn('transfers.type', ['ics', 'icsptr'])->select('transfers.*', 'ics_inventories.qty', 'ics_inventories.total_cost', 'ics_inventories.item_status', 'transfers.amount as depamount')->get();
            //return $transfers;
            $array = [];

            foreach($transfers as $trans){
               
                if($trans->transform_id == 0){
                     
                    $issued = $trans->from_entity;
                    $no = ics_forms::where('id', $ics->ics_id)->first();
                    $array[] = array(
                        'date'=>$trans->date,
                        'no' => $no->ref_no,
                        'recqty' => $trans->qty,
                        'isqty'=>$trans->qty,
                        'officer'=>$issued,
                        'balqty'=> $trans->qty,
                        'amount' => $trans->depamount,
                        'status' => $trans->item_status
                    );
                }
                else{
                    $emp = employee::where('id', $trans->to_emp)->first();
                    $issued = $emp->first_name.' '.$emp->middle_name[0].'. '.$emp->last_name;
                    
                    $no = transfer_forms::where('id', $trans->transform_id)->first();
                    $array[] = array(
                        'date'=>$trans->date,
                        'no' => $no->ref_no,
                        'recqty' => $trans->qty,
                        'isqty'=>$trans->qty,
                        'officer'=>$issued,
                        'balqty'=> $trans->qty,
                        'amount' => $trans->depamount,
                        'status' => $trans->item_status
                    );
                }
            }

            return view('reports.iccard')->with('ics', $ics)->with('array', $array);
        }
        else{
            $prop = properties::leftjoin('ppes', 'ppe', '=', 'ppes.id')->join('items','properties.item_id', '=', 'items.id')->join('par_forms','par_id', '=', 'par_forms.id')->where('properties.id', $id)->select('items.name', 'properties.*', 'par_forms.entity', 'par_forms.fund', 'ppes.name as ppe')->first();
            $transfers = transfer::join('properties', 'transfers.item_id', '=', 'properties.id')->where('transfers.item_id', $id)->whereIn('transfers.type', ['par', 'ptr'])->select('transfers.*', 'properties.qty', 'properties.amount', 'properties.item_status' ,'transfers.amount as depamount')->get();
            $array = [];

            foreach($transfers as $trans){
               
                if($trans->transform_id == 0){
                     
                    $issued = $trans->from_entity;
                    $no = par_forms::where('id', $prop->par_id)->first();
                    $array[] = array(
                        'date'=>$trans->date,
                        'no' => $no->ref_no,
                        'recqty' => $trans->qty,
                        'isqty'=>$trans->qty,
                        'officer'=>$issued,
                        'balqty'=> $trans->qty,
                        'amount' => $trans->depamount,
                        'status' => $trans->item_status
                    );
                }
                else{
                    $emp = employee::where('id', $trans->to_emp)->first();
                    $issued = $emp->first_name.' '.$emp->middle_name[0].'. '.$emp->last_name;
                    
                    $no = transfer_forms::where('id', $trans->transform_id)->first();
                    $array[] = array(
                        'date'=>$trans->date,
                        'no' => $no->ref_no,
                        'recqty' => $trans->qty,
                        'isqty'=>$trans->qty,
                        'officer'=>$issued,
                        'balqty'=> $trans->qty,
                        'amount' => $trans->depamount,
                        'status' => $trans->item_status
                    );
                }
            }

            return view('reports.propcard')->with('prop', $prop)->with('array', $array);
        }
    }

    public function ppelist(Request $data){
        //return $data->all();
        $props = properties::join('items','properties.item_id', '=', 'items.id')->where('ppe', $data['ppe'])->where('date_acquired', '<=',Carbon::parse($data['date']))->select('items.name', 'properties.*')->get();
        $array = [];
        $type = ppe::where('id', $data['ppe'])->first();
        foreach($props as $prop){
            $transfer = transfer::join('employees', 'to_emp', '=', 'employees.id')->where('type', $prop->par_type)->where('item_id', $prop->id)->orderBy('date')->first();
            $array[] = array(
                'article' => '',
                'desc' => $prop->brand.' '.$prop->name.' '.$prop->serial.' '.$prop->model.' '.$prop->color.' '.$prop->size,
                'no'=> $prop->property_no,
                'unit'=> $prop->unit,
                'amount' => $prop->amount,
                'qty'=> $prop->qty,
                'remarks' => $prop->date_acquired.', '.$prop->item_status.', '.(!empty($transfer) ? $transfer->first_name[0].$transfer->middle_name[0].$transfer->last_name[0] : '')
            );
        }
        $emp = employee::join('users', 'employee_id', '=', 'employees.id')->where('usertype_id', 5)->first();
        //return $array;
        return view('reports.ppelist')->with('array', $array)->with('type', $type)->with('emp', $emp)->with('date', Carbon::parse($data['date'])->toFormattedDateString());
    }

    public function empaccount(Request $data){
        $emp = employee::where('id', $data['emp'])->first();
        $props = properties::join('items','properties.item_id', '=', 'items.id')->where('current_issued', $data['emp'])->where('date_acquired', '<=',Carbon::parse($data['date']))->select('items.name', 'properties.*',DB::raw('@rownum  := @rownum  + 1 AS rownum'))->get();
        $row = 1;
        $total = 0;
        $array = [];
        foreach($props as $prop){
            $refno = '';
            if($prop->par_type == 'par'){
                $ref = par_forms::where('id', $prop->par_id)->first();
                $refno = $ref->ref_no;
            }
            else{
                $ref = transfer_forms::where('id', $prop->par_id)->first();
                $refno = $ref->ref_no;
            }
        $array[] = array(
                'rowno' => $row,
                'desc' => $prop->brand.' '.$prop->name.' '.$prop->serial.' '.$prop->model.' '.$prop->color.' '.$prop->size,
                'no'=> $prop->property_no,
                'paricsno'=> $refno,
                'amount' => $prop->amount,
                'qty'=> $prop->qty,
                'date' => $prop->date_acquired
            );
            $total += $prop->amount;
            $row++;
        }
        $icvs = ics_inventories::join('items','ics_inventories.item_id', '=', 'items.id')->where('current_issued', $data['emp'])->where('date_acquired', '<=',Carbon::parse($data['date']))->select('items.name', 'ics_inventories.*')->get();

        foreach($icvs as $ic){
            $ref = ics_forms::where('id', $ic->ics_id)->first();
            $refno = $ref->ref_no;
        $array[] = array(
                'rowno' => $row,
                'desc' => $ic->brand.' '.$ic->name.' '.$ic->serial.' '.$ic->model.' '.$ic->color.' '.$ic->size,
                'no'=> $ic->item_no,
                'paricsno'=> $refno,
                'amount' => $ic->unit_cost,
                'qty'=> $ic->qty,
                'date' => $ic->date_acquired
            );
            $row++;
            $total += $ic->unit_cost;
        }
        //return $array;
        return view('reports.empaccounted')->with('array', $array)->with('emp', $emp)->with('date', Carbon::parse($data['date'])->toFormattedDateString())->with('total', $total);
    }

    public function unservelist(Request $data){
        $props = properties::join('items','properties.item_id', '=', 'items.id')->where('date_acquired', '<=',Carbon::parse($data['date']))->where('item_status', 'like', '%UNSERVICABLE%')->select('items.name', 'properties.*')->get();
        $icvs = ics_inventories::join('items','ics_inventories.item_id', '=', 'items.id')->where('date_acquired', '<=',Carbon::parse($data['date']))->where('item_status', 'like', '%UNSERVICABLE%')->select('items.name', 'ics_inventories.*')->get();
        $row = 1;
        $total = 0;
        $array = [];
        foreach($props as $prop){
            $refno = '';
            if($prop->par_type == 'par'){
                $ref = par_forms::where('id', $prop->par_id)->first();
                $refno = $ref->ref_no;
            }
            else{
                $ref = transfer_forms::where('id', $prop->par_id)->first();
                $refno = $ref->ref_no;
            }
        $array[] = array(
                'rowno' => $row,
                'desc' => $prop->brand.' '.$prop->name.' '.$prop->serial.' '.$prop->model.' '.$prop->color.' '.$prop->size,
                'no'=> $prop->property_no,
                'paricsno'=> $refno,
                'amount' => $prop->amount,
                'qty'=> $prop->qty,
                'date' => $prop->date_acquired
            );
            $total += $prop->amount;
            $row++;
        }
        foreach($icvs as $ic){
        $array[] = array(
                'rowno' => $row,
                'desc' => $ic->brand.' '.$ic->name.' '.$ic->serial.' '.$ic->model.' '.$ic->color.' '.$ic->size,
                'no'=> $ic->item_no,
                'amount' => $ic->unit_cost,
                'qty'=> $ic->qty,
                'date' => $ic->date_acquired
            );
            $row++;
            $total += $ic->unit_cost;
        }

        return view('reports.unservelist')->with('array', $array)->with('date', Carbon::parse($data['date'])->toFormattedDateString())->with('total', $total);
    }
}
