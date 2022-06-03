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

class ParICSController extends Controller
{
    public function createics(){
        $types = equipment_type::all();
        $ppes = ppe::all();
        $employees = employee::orderBy('first_name')->get();
        $categories = category::all();
        $units = unit::all();
        $master =  master_account::where('type', 'master')->get();
        $icscontrol = DB::table('ics_forms')->orderBy('id', 'desc')->first();
        $icsref = '';
        if($icscontrol == null){
            $icsref =  'ICS-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
            
             $icsref = 'ICS-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($icscontrol->ref_no, -3)+1);
        }

        $parcontrol = DB::table('par_forms')->orderBy('id', 'desc')->first();
        $parref = '';
        if($parcontrol == null){
            $parref =  'PAR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
            
             $parref = 'PAR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($parcontrol->ref_no, -3)+1);
        }


        return view('operations.icspar.addics')->with('mas', $master)->with('units', $units)->with('types', $types)->with('icsref', $icsref)->with('parref', $parref)->with('categories', $categories)->with('ppes', $ppes)->with('employees', $employees);
    }

    public function submitprop(Request $data){
        //return $data->all();
        $item = new item();
        $item->name = $data['item'];
        $item->description = $data['item'];
        $item->unit_cost = $data['amount'];
        $item->purchase_unit = $data['unit'];
        $item->category_id = $data['category'];
        $item->save();
        $unit = unit::find($data['unit']);
        
        if($data['itemtype'] == 'equip'){

            $ics = new ics_forms();
            $ics->ref_no = $data['refno'];
            $ics->fund = $data['fc'];
            $ics->date = Carbon::parse($data['dateform']);
            $ics->entity = $data['entity'];
            $ics->iar_id = 0;
            $ics->save();

            $icv = new ics_inventories();
            $icv->date_acquired = Carbon::parse($data['date']);
            $icv->issued_by = $data['issuedby'];   
            $icv->issued_to = $data['issuedto'];
            $icv->item_id = $item->id;
            $icv->brand = $data['brand'];
            $icv->item_no = $data['itemno'];
            $icv->ics_id = $ics->id;
            $icv->current_issued = $data['issuedto'];
            $icv->item_status = $data['status'];
            $icv->life = $data['life'];
            $icv->type = $data['eqtype'];
            $icv->unit = $unit->name;
            $icv->qty = 1;
            $icv->unit_cost = $data['amount'];
            $icv->total_cost = $data['amount'];
            $icv->deprate = $data['deprate'];
            $icv->status = 'CURRENT';
            $icv->serial = $data['serial'];
            $icv->model = $data['model'];
            $icv->size = $data['size'];
            $icv->color = $data['color'];
            $icv->save();

            $emp = employee::find($data['issuedto']);
            $trans = new transfer();
            $trans->transform_id = 0;
            $trans->item_id = $icv->id;
            $trans->type = 'ics';
            $trans->from_emp = $data['issuedto'];
            $trans->to_emp = $data['issuedto'];
            $trans->from_entity = $emp['first_name'].' '.$emp['middle_name'][0].'. '.$emp['last_name'];
            $trans->date = Carbon::parse($data['date']);
            $trans->remarks = 'ISSUED';
            $trans->amount = $data['amount'];
            $trans->save();   
            
            return redirect(route('ics_inv'))->with('success', 'Items Saved Successfully');
        }
        else{

            $par = new par_forms();
            $par->ref_no = $data['refno'];
            $par->fund = $data['fc'];
            $par->date = Carbon::parse($data['dateform']);
            $par->entity = $data['entity'];
            $par->iar_id = 0;
            $par->save();
            
            $prop = new properties();
            $prop->item_id = $item->id;
            $prop->par_id = $par->id;
            $prop->property_no = $data['itemno'];
            $prop->date_acquired = Carbon::parse($data['date']);
            $prop->qty = 1;
            $prop->unit = $unit->name;;
            $prop->amount = $data['amount'];
            $prop->current_issued = $data['issuedto'];
            $prop->issued_by = $data['issuedby'];   
            $prop->issued_to = $data['issuedto'];
            $prop->brand = $data['brand'];
            $prop->deprate = $data['deprate'];
            $prop->status = 'CURRENT';
            $prop->item_status = 'SERVICABLE';
            $prop->life = $data['life'];
            $prop->serial = $data['serial'];
            $prop->model = $data['model'];
            $prop->size = $data['size'];
            $prop->color = $data['color'];
            $prop->ppe = $data['ppe'];
            $prop->save();

            $emp = employee::find($data['issuedto']);
            $trans = new transfer();
            $trans->transform_id = 0;
            $trans->item_id = $prop->id;
            $trans->type = 'par';
            $trans->from_emp = $data['issuedto'];
            $trans->to_emp = $data['issuedto'];
            $trans->from_entity = $emp['first_name'].' '.$emp['middle_name'][0].'. '.$emp['last_name'];
            $trans->date = Carbon::parse($data['date']);
            $trans->remarks = 'ISSUED';
            $trans->amount = $data['amount'];
            $trans->save();    

            return redirect(route('pars'))->with('success', 'Items Saved Successfully');
        }

        
    }
    public function submiticspar(Request $data){
        //return $data->all();
        $forms = array();
        foreach ($data['items'] as $key => $arr) {
           
                array_push($forms, $arr['form_no']);
            
        };
        //return array_unique($forms);
        foreach(array_unique($forms) as $form){
            $entity = master_account::find($data['entity']);
             if(str_contains($form, 'ICS')){
                 $iar = acceptance::where('ref_no', $data['iarno'])->first();
                 $po = purchase_order::where('id', $iar->po_id)->first();
                 $pr = purchase_request::where('ref_no', $po->pr_no)->first();
                 $pr->status = 'WITH ICS';
                 $po->status = 'WITH ICS';
                 //return $pr;
                 $pr->save();
                 $po->save();
                 $ics = new ics_forms();
                 $ics->ref_no = $form;
                 $ics->fund = $data['fc'];
                 $ics->date = Carbon::parse($data['date']);
                 $ics->entity = $entity->name;
                 $ics->iar_id = $iar->id;
                 $ics->save();

                 foreach ($data['items'] as $key => $arr) {
                    if($form == $arr['form_no']){
                        $icv = new ics_inventories();
                        $icv->item_id = $arr['id'];
                        $icv->ics_id = $ics->id;
                        $icv->item_no = $arr['itemno'];
                        $icv->date_acquired = Carbon::parse($data['date']);
                        $icv->qty = $arr['qty'];
                        $icv->current_issued = $arr['issuedto'];
                        $icv->unit = $arr['unit'];
                        $icv->unit_cost = $arr['unit_cost'];
                        $icv->total_cost = $arr['unit_cost'] * $arr['qty'];
                        $icv->issued_by = $arr['issuedby'];   
                        $icv->issued_to = $arr['issuedto'];
                        $icv->brand = $arr['brand'];
                        $icv->status = 'CURRENT';
                        $icv->item_status = 'SERVICABLE';
                        $icv->save();

                        $emp = employee::find($arr['issuedto']);
                        $trans = new transfer();
                        $trans->transform_id = 0;
                        $trans->item_id = $icv->id;
                        $trans->type = 'ics';
                        $trans->from_emp = $arr['issuedto'];
                        $trans->to_emp = $arr['issuedto'];
                        $trans->from_entity = $emp['first_name'].' '.$emp['middle_name'][0].'. '.$emp['last_name'];
                        $trans->date = Carbon::parse($data['date']);
                        $trans->remarks = 'ISSUED';
                        $trans->amount = $arr['unit_cost'] * $arr['qty'];
                        $trans->save();     
                    }
                                        
                 }
             }
             else{
                 $iar = acceptance::where('ref_no', $data['iarno'])->first();
                 $po = purchase_order::where('id', $iar->po_id)->first();
                 $pr = purchase_request::where('ref_no', $po->pr_no)->first();
                 $pr->status = 'WITH PAR';
                 $po->status = 'WITH PAR';
                 $pr->save();
                 $po->save();
                 $par = new par_forms();
                 $par->ref_no = $form;
                 $par->fund = $data['fc'];
                 $par->date = Carbon::parse($data['date']);
                 $par->entity = $entity->name;
                 $par->iar_id = $iar->id;
                 $par->save();


                 foreach ($data['items'] as $key => $arr) {
                    if($form == $arr['form_no']){
                        $prop = new properties();
                        $prop->item_id = $arr['id'];
                        $prop->par_id = $par->id;
                        $prop->property_no = $arr['itemno'];
                        $prop->date_acquired = Carbon::parse($data['date']);
                        $prop->qty = $arr['qty'];
                        $prop->unit = $arr['unit'];
                        $prop->current_issued = $arr['issuedto'];
                        $prop->amount = $arr['unit_cost'] * $arr['qty'];
                        $prop->issued_by = $arr['issuedby'];   
                        $prop->issued_to = $arr['issuedto'];
                        $prop->brand = $arr['brand'];
                        $prop->status = 'CURRENT';
                        $prop->item_status = 'SERVICABLE';
                        $prop->save();

                        $emp = employee::find($arr['issuedto']);
                        $trans = new transfer();
                        $trans->transform_id = 0;
                        $trans->item_id = $prop->id;
                        $trans->type = 'par';
                        $trans->from_emp = $arr['issuedto'];
                        $trans->to_emp = $arr['issuedto'];
                        $trans->from_entity = $emp['first_name'].' '.$emp['middle_name'][0].'. '.$emp['last_name'];
                        $trans->date = Carbon::parse($data['date']);
                        $trans->remarks = 'ISSUED';
                        $trans->amount = $arr['unit_cost'] * $arr['qty'];
                        $trans->save();   
                    }
                                        
                 }
             }
        }

        return redirect(route('ics_inv'))->with('success', 'Items Saved Successfully');  
        
    }

    public function ics_inv(){
        $ics = ics_inventories::join('items','item_id', '=', 'items.id')->join('employees as b', 'issued_to', '=', 'b.id')->join('employees as a', 'issued_by', '=', 'a.id')->leftjoin('equipment_types','type', '=', 'equipment_types.id')->leftjoin('ics_forms', 'ics_id', '=', 'ics_forms.id')->select('items.name', 'items.id as stockno', 'ics_inventories.*', 'ics_forms.ref_no', DB::raw('CONCAT(a.first_name," ",SUBSTRING(a.middle_name, 1,1),". ",a.last_name) AS issuedby'), DB::raw('CONCAT(b.first_name," ",SUBSTRING(b.middle_name, 1,1),". ",b.last_name) AS issuedto'), 'equipment_types.name as type', 'issued_to')->get();
        //return $ics;
        $types = equipment_type::all();
        $employees = employee::orderBy('first_name')->get();
        $trans = transfer_type::all();
        $control = DB::table('transfer_forms')->orderBy('id', 'desc')->first();
        $ref = '';
        if($control == null){
            $ref =  'PTR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
            
             $ref = 'PTR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($control->ref_no, -3)+1);
        }
        return view('operations.icspar.ics')->with('ics', $ics)->with('types', $types)->with('employees', $employees)->with('trans', $trans)->with('ref', $ref);
    }
    public function icsforms(){
        $ics = ics_forms::leftjoin('acceptances', 'iar_id', '=', 'acceptances.id')->select('acceptances.ref_no as iar','ics_forms.*')->get();
        $array=[];
        //return $ics;
        foreach($ics as $key){
            $item = ics_inventories::join('items','item_id', '=', 'items.id')->where('ics_id', $key->id)->get();
            $itemnos = '';
            $items = '';
            $issued_by = '';
            $issued_to = '';

            foreach($item as $it){
                
                $itemnos .= $it->item_no.', ';
                $items .= $it->brand.' '.$it->name.', ';

                $issued_by =  employee::where('id', $it->issued_by)->first();
                $issued_to = employee::where('id', $it->issued_to)->first();
            }
            $array[] = array(
                    'id' => $key->id,
                    'iar' => $key->iar,
                    'no' => $key->ref_no,
                    'date' => $key->date,
                    'itemnos' =>$itemnos,
                    'items' =>$items,
                    'issued_by' =>  $issued_by->first_name." ".$issued_by->last_name,
                    'issued_to' =>  $issued_to->first_name." ".$issued_to->last_name,
                );

        }

        return view('operations.icspar.icsforms')->with('ics', $array);

    }

    public function getics(Request $data){
         $ics = ics_inventories::where('id', $data['id'])->first();

         return $ics;


    }

    public function updateics(Request $data){
        //return $data->all();
        $icv = ics_inventories::find($data['id']);
        $icv->date_acquired = Carbon::parse($data['date']);
        $icv->issued_by = $data['issuedby'];   
        $icv->issued_to = $data['issuedto'];
        $icv->brand = $data['brand'];
        $icv->type = $data['eqtype'];
        $icv->item_status = $data['status'];
        $icv->life = $data['life'];
        $icv->deprate = $data['deprate'];
        $icv->serial = $data['serial'];
        $icv->model = $data['model'];
        $icv->size = $data['size'];
        $icv->color = $data['color'];
        $icv->save(); 

        return redirect(route('ics_inv'))->with('success', 'ICS No. '.$icv->ref_no.' Saved Successfully');  
    }

    public function pars(){
        $pars = properties::join('items','item_id', '=', 'items.id')->join('employees as b', 'issued_to', '=', 'b.id')->join('employees as a', 'issued_by', '=', 'a.id')->leftjoin('ppes','ppe', '=', 'ppes.id')->select('items.name', 'items.id as stockno', 'properties.*', 'properties.property_no', DB::raw('CONCAT(a.first_name," ",SUBSTRING(a.middle_name, 1,1),". ",a.last_name) AS issuedby'), DB::raw('CONCAT(b.first_name," ",SUBSTRING(b.middle_name, 1,1),". ",b.last_name) AS issuedto'), 'ppes.name as ppe', 'issued_by', 'issued_by_others', 'issued_to', 'issued_to_others')->get();
        //return $pars;

        $ppes = ppe::all();
        $trans = transfer_type::all();
        $employees = employee::orderBy('first_name')->get();

        $control = DB::table('transfer_forms')->orderBy('id', 'desc')->first();
        $ref = '';
        if($control == null){
            $ref =  'PTR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
            
             $ref = 'PTR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($control->ref_no, -3)+1);
        }
        return view('operations.icspar.par')->with('ref', $ref)->with('pars', $pars)->with('ppes', $ppes)->with('trans', $trans)->with('employees', $employees);
    }

    public function parforms(){
         $pars = par_forms::leftjoin('acceptances', 'iar_id', '=', 'acceptances.id')->select('acceptances.ref_no as iar','par_forms.*')->get();
        $array=[];
        //return $pars;
        foreach($pars as $key){
            $item = properties::join('items','item_id', '=', 'items.id')->where('par_id', $key->id)->get();
            $itemnos = '';
            $items = '';
            $issued_by = '';
            $issued_to = '';

            foreach($item as $it){
                
                $itemnos .= $it->property_no.', ';
                $items .= $it->brand.' '.$it->name.', ';

                $issued_by =  employee::where('id', $it->issued_by)->first();
                $issued_to = employee::where('id', $it->issued_to)->first();
            }
            $array[] = array(
                    'id' => $key->id,
                    'iar' => $key->iar,
                    'no' => $key->ref_no,
                    'date' => $key->date,
                    'itemnos' =>$itemnos,
                    'items' =>$items,
                    'issued_by' =>  $issued_by->first_name." ".$issued_by->last_name,
                    'issued_to' =>  $issued_to->first_name." ".$issued_to->last_name,
                );
        }
        return view('operations.icspar.parforms')->with('pars', $array);
    }

    public function getpar(Request $data){
         $par = properties::where('id', $data['id'])->first();
         return $par;
    }

    public function updatepar(Request $data){
        //return $data->all();
        $par = properties::find($data['id']);
        $par->date_acquired = Carbon::parse($data['date']);
        $par->issued_by = $data['issuedby'];   
        $par->issued_to = $data['issuedto'];
        $par->brand = $data['brand'];
        $par->item_status = $data['status'];
        $par->life = $data['life'];
        $par->serial = $data['serial'];
        $par->model = $data['model'];
        $par->size = $data['size'];
        $par->color = $data['color'];
        $par->ppe = $data['ppe'];
        $par->save(); 

        return redirect(route('pars'))->with('success', 'PAR No. '.$par->property_no.' Saved Successfully');  
    }

    public function transfer(Request $data){
        //return $data->all();
        if($data['type'] == 'par'){
            $par = properties::find($data['id']);
            $fromemp = employee::find($data['from']);
            $toemp = employee::find($data['to']);
            $par->status = 'TRANSFERRED FROM '.$fromemp->first_name.' '.$fromemp->last_name.' TO '.$toemp->first_name.' '.$toemp->last_name;
            $par->current_issued = $data['to'];
            $par->save();
        }
        else{
            $ics = ics_inventories::find($data['id']);
            $fromemp = employee::find($data['from']);
            $toemp = employee::find($data['to']);
            $ics->status = 'TRANSFERRED FROM '.$fromemp->first_name.' '.$fromemp->last_name.' TO '.$toemp->first_name.' '.$toemp->last_name;
            $ics->current_issued = $data['to'];
            $ics->save();
        }
        

        $transfer = new transfer_forms();
        $transfer->entity = $data['entity'];
        $transfer->ref_no = $data['ptrno'];
        $transfer->date = Carbon::parse($data['date']);
        $transfer->purpose = $data['reason'];
        $transfer->transfer_type = $data['transfer'];
        $transfer->fund_cluster = $data['fc'];
        $transfer->approved_by = $data['approved'];
        $transfer->date_approved = Carbon::parse($data['date']);
        $transfer->issued_by = $data['issued'];
        $transfer->date_issued = Carbon::parse($data['date']);
        $transfer->received_by = $data['to'];
        $transfer->date_received = Carbon::parse($data['date']);
        $transfer->save();


        $trans = new transfer();
        $trans->transform_id = $transfer->id;
        $trans->item_id = $data['id'];
        $trans->type = $data['type'];;
        $trans->from_emp = $data['from'];
        $trans->to_emp = $data['to'];
        $trans->from_entity = $data['froment'];
        $trans->to_entity = $data['toment'];
        $trans->date = Carbon::parse($data['date']);
        $trans->remarks = 'TRANSFERRED TO ANOTHER ACC. OFFICER';
        $trans->amount = $data['depamount'];
        $trans->save();

        return redirect(route('ptrs'))->with('success', 'PTR No. '.$data['ptrno'].' Saved Successfully'); 
    }

    public function createptr(){
        $employees = employee::orderBy('first_name')->get();
        $transfer_types = transfer_type::all();
        $control = DB::table('transfer_forms')->orderBy('id', 'desc')->first();
        $ref = '';
        $parcontrol = DB::table('par_forms')->orderBy('id', 'desc')->first();
        $parref = '';
        if($parcontrol == null){
            $parref =  'PAR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
            
             $parref = 'PAR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($parcontrol->ref_no, -3)+1);
        }
        $ppes = ppe::all();
        $equipment_types = equipment_type::all();
        $units = unit::all();
        $categories = category::all();
        $master =  master_account::where('type', 'master')->get();
        if($control == null){
            $ref =  'PTR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
            
             $ref = 'PTR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($control->ref_no, -3)+1);
        }

        return view('operations.icspar.addptr')->with('mas', $master)->with('ppes', $ppes)->with('equipment_types', $equipment_types)->with('categories', $categories)->with('parref', $parref)->with('ref', $ref)->with('units', $units)->with('trans', $transfer_types)->with('employees', $employees);
    }

    public function submitptr(Request $data){
        //return $data->all();

        $transfer = new transfer_forms();
        $transfer->entity = $data['entity'];
        $transfer->ref_no = $data['no'];
        $transfer->date = Carbon::parse($data['date']);
        $transfer->purpose = $data['reason'];
        $transfer->transfer_type = $data['transfer'];
        $transfer->fund_cluster = $data['fc'];
        $transfer->approved_by = $data['approved'];
        $transfer->approved_others = $data['appent'];
        $transfer->issued_others = $data['isent'];
        $transfer->received_others = $data['toent'];
        $transfer->date_approved = Carbon::parse($data['date']);
        $transfer->issued_by = $data['issued'];
        $transfer->date_issued = Carbon::parse($data['date']);
        $transfer->received_by = $data['to'];
        $transfer->date_received = Carbon::parse($data['date']);
        $transfer->save();

        foreach ($data['items'] as $key => $arr) {

            $unit = unit::find($arr['unit']);
            $item = new item();
            $item->name = $arr['item'];
            $item->description = $arr['item'];
            $item->unit_cost = $arr['cost'];
            $item->purchase_unit = $arr['unit'];
            $item->category_id = 30;
            $item->save();

            if($arr['type'] == 'prop'){
                $prop = new properties();
                $prop->item_id = $item->id;
                $prop->par_id = $transfer->id;
                $prop->property_no = $arr['property'];
                $prop->date_acquired = Carbon::parse($data['date']);
                $prop->qty = 1;
                $prop->ppe = $arr['ppe'];
                $prop->unit = $unit->name;
                $prop->amount = $arr['cost'];
                $prop->issued_by = $data['from'];   
                $prop->issued_to = $data['to'];
                $prop->current_issued = $data['to'];
                $prop->issued_by_others = $data['froment'];   
                $prop->issued_to_others = $data['toent'];
                $prop->brand = $arr['brand'];
                $prop->status = 'CURRENT';
                $prop->item_status = 'SERVICABLE';
                $prop->save();

                $trans = new transfer();
                $trans->transform_id = $transfer->id;
                $trans->item_id = $prop->id;
                $trans->type = 'ptr';
                $trans->from_emp = $data['from'];
                $trans->to_emp = $data['to'];
                $trans->from_entity = $data['froment'];
                $trans->to_entity = $data['toent'];
                $trans->date = Carbon::parse($data['date']);
                $trans->remarks = 'ISSUED';
                $trans->amount = $arr['cost'];
                $trans->save();
            }
            else{

                $icv = new ics_inventories();
                $icv->item_id = $item->id;
                $icv->ics_id = $transfer->id;
                $icv->item_no = $arr['property'];
                $icv->date_acquired = Carbon::parse($data['date']);
                $icv->qty = 1;
                $icv->type = $arr['eqtype'];
                $icv->ics_type = 'ptr';
                $icv->unit = $unit->name;
                $icv->unit_cost = $arr['cost'];
                $icv->total_cost = $arr['cost'];
                $icv->issued_by = $data['from'];   
                $icv->issued_to = $data['to'];
                $icv->current_issued = $data['to'];
                $icv->brand = $arr['brand'];
                $icv->status = 'CURRENT';
                $icv->item_status = 'SERVICABLE';
                $icv->save();

                $trans = new transfer();
                $trans->transform_id = $transfer->id;
                $trans->item_id = $icv->id;
                $trans->type = 'icsptr';
                $trans->from_emp = $data['from'];
                $trans->to_emp = $data['to'];
                $trans->from_entity = $data['froment'];
                $trans->to_entity = $data['toent'];
                $trans->date = Carbon::parse($data['date']);
                $trans->remarks = 'ISSUED';
                $trans->amount = $arr['cost'];
                $trans->save();
            }

            
        }

        return redirect(route('pars'))->with('success', 'Items Saved Successfully');
    }

    public function ptrs(){

        $ptrs = transfer_forms::all();
        
        //return $ptrs;
        
        $array =[];
        foreach($ptrs as $key){

            $properties = transfer::where('transform_id', $key->id)->get();
            $props = '';
            $items = '';
            $issued_by = '';
            $issued_to = '';
            $is_to = '';
            $from = '';
            $to = '';

            foreach($properties as $it){
                
                if($it->type == 'ics'){
                    $item = ics_inventories::join('items', 'item_id', '=', 'items.id')->where('ics_inventories.id', $it->item_id)->first();
                    
                    $props .= $item->item_no.', ';
                    $items .= $item->brand.' '.$item->name.', ';
                }
                else{
                    $item = properties::join('items', 'item_id', '=', 'items.id')->where('properties.id', $it->item_id)->first();
                    
                    $props .= $item->property_no.', ';
                    $items .= $item->brand.' '.$item->name.', ';
                }
                
                $issuedby = $it->from_entity;
                $issuedto = $it->to_entity;
                $is_to = $it->to_emp;
                $is_by = $it->from_emp;

                $from =  employee::where('id', $it->from_emp)->first();
                $to = employee::where('id', $it->to_emp)->first();

            }
            
            $approve = employee::where('id', $key->approved_by)->first();
            if(!empty($properties)){
                $array[] = array(
                        'id' => $key->id,
                        'no' => $key->ref_no,
                        'date' => $key->date,
                        'property_no' =>$props,
                        'items' =>$items,
                        'from' =>  $is_by == 54 ? $issuedby :$from->first_name." ".$from->last_name,
                        'to' =>  $is_to == 54 ? $issuedto :$to->first_name." ".$to->last_name,
                        'reason' => $key->purpose,
                        'approve' =>  $key->approved_by == 54 ? $key->approved_others :$approve->first_name." ".$approve->last_name,
                        'issued_by'
                    );
            }

        }
        //return $array;
        return view('operations.icspar.ptrs')->with('ptrs', $array);
    }

    public function createdisposal(){
        $ics = ics_inventories::join('items', 'item_id', '=', 'items.id')->select('items.name', 'ics_inventories.*')->get();
        $props = properties::join('items', 'item_id', '=', 'items.id')->select('items.name', 'properties.*')->get();
        $employees = employee::orderBy('first_name')->get();
        $disposal_modes = disposal_mode::all();
        $master =  master_account::where('type', 'master')->get();
        $control = DB::table('disposals')->orderBy('id', 'desc')->first();
        $ref = '';
        if($control == null){
            $ref =  'PDR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-001';
        }
        else{
            
             $ref = 'PDR-'.Carbon::now()->year.'-'.(Carbon::now()->month < 10 ? '0'.Carbon::now()->month : Carbon::now()->month).'-'.sprintf('%03d', substr($control->ref_no, -3)+1);
        }

        return view('operations.icspar.adddisposal')->with('mas', $master)->with('props', $props)->with('ics', $ics)->with('ref', $ref)->with('employees', $employees)->with('disposal_modes', $disposal_modes);
    }

    public function submitdisposal(Request $data){
        //return $data->all();
        $disposal =  new disposal();
        $disposal->entity = $data['entity'];
        $disposal->ref_no = $data['no'];
        $disposal->date = Carbon::parse($data['date']);
        $disposal->or_no = $data['or'];
        $disposal->total = $data['total'];
        $disposal->disposal_mode = $data['mode'];
        $disposal->date_sale = Carbon::parse($data['date']);
        $disposal->or_no = $data['or'];
        $disposal->approved_by = $data['approved'];
        $disposal->date_approved = Carbon::parse($data['date']);
        $disposal->issued_by = $data['issued'];
        $disposal->date_issued = Carbon::parse($data['date']);
        $disposal->save();

        foreach ($data['items'] as $key => $arr) {
            if($arr['type'] == 'ics'){
                $ics = ics_inventories::find($arr['id']);
                $ics->item_status = 'DISPOSED';
                $ics->status = 'DISPOSED';
                $ics->save();
            }
            else{
                $par = properties::find($arr['id']);
                $par->item_status = 'DISPOSED';
                $par->status = 'DISPOSED';
                $par->save();
            }

            $dis = new disposal_line();
            $dis->item_id = $arr['id'];
            $dis->disposal_id = $disposal->id;
            $dis->amount = $arr['amount'];
            $dis->save();
        }
        return redirect(route('disposals'))->with('success', 'Items Saved Successfully');
    }

    public function disposals(){
        $disposals = disposal::join('disposal_modes', 'disposal_mode', '=', 'disposal_modes.id')->join('employees as b', 'approved_by', '=', 'b.id')->join('employees as a', 'issued_by', '=', 'a.id')->select('disposals.*','disposal_modes.name as mode',DB::raw('CONCAT(a.first_name," ",SUBSTRING(a.middle_name, 1,1),". ",a.last_name) AS issuedby'), DB::raw('CONCAT(b.first_name," ",SUBSTRING(b.middle_name, 1,1),". ",b.last_name) AS approved_by'))->get();
        //return $disposals;
        foreach($disposals as $key){
            $disline = disposal_line::where('disposal_id', $key->id)->get();
            $props = '';
            $items = '';
            foreach($disline as $it){
                
                if($it->type == 'ics'){
                    $item = ics_inventories::join('items', 'item_id', '=', 'items.id')->where('ics_inventories.id', $it->item_id)->first();
                    
                    $props .= $item->item_no.', ';
                    $items .= $item->brand.' '.$item->name.', ';
                }
                else{
                    $item = properties::join('items', 'item_id', '=', 'items.id')->where('properties.id', $it->item_id)->first();
                    
                    $props .= $item->property_no.', ';
                    $items .= $item->brand.' '.$item->name.', ';
                }
            }

            $array[] = array(
                'id' => $key->id,
                'no' => $key->ref_no,
                'date' => $key->date,
                'refs' =>$props,
                'items' =>$items,
                'reason' => $key->purpose,
                'approve' => $key->approved_by,
                'issued_by'=> $key->issuedby,
                'mode'=>$key->mode

            );

        }

        return view('operations.icspar.disposals')->with('disposals', $array);
    }

}
