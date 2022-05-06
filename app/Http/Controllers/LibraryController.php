<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\classification;
use App\supplier;
use App\item;
use App\inventory;
use App\requests;
use App\inventory_operation;
use App\inventory_mov;
use App\purchase_request;
use App\purchase_order;
use Carbon\Carbon;
use App\unit;
use App\master_account;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    public function categories(){
    	$categories = category::join('classifications', 'classification_id', '=', 'classifications.id')->select('classifications.name as class', 'categories.*')->get();
    	$classifications = classification::all();
    	return view('libraries.categories')->with('categories', $categories)->with('classifications', $classifications);
    }

    public function addcategory(Request $data){

        $category = new category();
        if($data['type'] == 'edit'){
            $category = category::find($data['id']);
        }
        $category->name = $data['name'];
        $category->classification_id = $data['classification'];
        $category->save();
        return redirect()->route('categories');
    }

    public function units(){
        $units = unit::all();
        return view('libraries.units')->with('units', $units);
    }

    public function addunit(Request $data){

        $unit = new unit();
        if($data['type'] == 'edit'){
            $unit = unit::find($data['id']);
        }
        $unit->name = $data['name'];
        $unit->abv = $data['agv'];
        $unit->save();
        return redirect()->route('units');
    }

    public function suppliers(){
    	$suppliers = supplier::all();
    	$suppliers = supplier::all();
    	return view('libraries.suppliers')->with('suppliers', $suppliers);
    }

    public function addsupplier(Request $data){
    	//return $data->all();
        $supplier = new supplier();
        if($data['type'] == 'edit'){
            $supplier = supplier::find($data['id']);
        }
        //return $supplier;
        $supplier->name = $data['name'];
        $supplier->address = $data['address'];
        $supplier->tin = $data['tin'];
        $supplier->contact = $data['contact'];
        $supplier->vat = $data['vat'];
        $supplier->save();
        return redirect()->route('suppliers');
    }

    public function additem(){
        $categories = category::all();
        $master = master_account::where('type', 'master')->get();
        $units = unit::all();
        $po='';
        $control = DB::table('items')->orderBy('id', 'desc')->first();
        if($control == null){
            $po = 101;
        }
        else{
             $po = $control->id+1;
        }
        return view('items.additem')->with('categories', $categories)->with('po', $po)->with('units', $units)->with('master', $master);
    }

    public function submititem(Request $data){
        //return $data->all();

        

        if($data['type'] == 'bulk'){
            foreach ($data['items'] as $key => $it) {
                $req = requests::find($key);
                $req->status = 'ADDED TO ITEM LIST';
                $req->save();
                 $item = new item();
                  $item->name = $req['item'];
                $item->description = $it['desc'];
                $item->unit_cost = $it['cost'];
                $item->category_id = $it['typeid'];
                $item->purchase_unit = $it['unittype'];
                $item->save();
            }
        }
        else{
            $item = new item();

            if($data['type'] == 'edit'){
                $item = item::find($data['id']);
            }

                $item->name = $data['name'];
                $item->description = $data['desc'];
                $item->unit_cost = $data['cost'];
                $item->category_id = $data['typeid'];
                $item->purchase_unit = $data['unittype'];
                $item->save();
                
           if(isset($data['inv'])){
                foreach($data['invs'] as $array => $arr){

                    $inv = new inventory();
                    $inv->item_id = $item['id'];
                    $inv->master_id = $arr['id'];
                    $inv->date = Carbon::now();
                    $inv->qty_instock =  $arr['qty'];
                    $inv->unit_cost =  $arr['cost'];
                    $inv->total_cost =  $arr['qty'] * $arr['cost'];
                    $inv->unit =  $arr['unittype'];
                    $inv->danger_lvl =   $arr['qty'] * 0.10;
                    $inv->save();


                    $inop = new inventory_operation();
                    $inop->inventory_id = $inv->id;
                    $inop->operation = 'IN';
                    $inop->reason = 'STOCK IN';
                    $inop->qty =$arr['qty'];
                    $inop->unit_cost =$arr['cost'];
                    $inop->date = Carbon::now();
                    $inop->total_cost =  $arr['qty'] * $arr['cost'];
                    $inop->balance = $arr['qty'];
                    $inop->save();

                    $invmov = new inventory_mov();
                    $invmov->inventory_id = $arr['id'];
                    $invmov->quantity = $arr['qty'];
                    $invmov->unit = $arr['unittype'];
                    $invmov->unit_cost = $arr['cost'];
                    $invmov->amount = $arr['qty'] * $arr['cost'];
                    $invmov->asof = Carbon::now()->toDateString();
                    $invmov->save();
                }
            }

        }
        

       

      
        return redirect(route('items'))->with('success', 'Item No. '.$item->id.' Updated Successfully');
    }


    public function items(){
        $array = [];

        $items = item::join('categories', 'category_id', '=', 'categories.id')->join('classifications', 'classification_id', '=', 'classifications.id')->join('units', 'purchase_unit', '=', 'units.id')->select('items.*', 'categories.name as type', 'units.name as unit', 'classifications.id as cl_id')->get();
       //return $items;
        foreach ($items as $key) {
           
            $invs = inventory::join('master_accounts', 'master_id', '=', 'master_accounts.id')->where('item_id', $key->id)->where('master_accounts.type', 'master')->select('inventories.*', 'master_accounts.name as master')->get();
            if(count($invs) > 0){
            foreach ($invs as $inv) {
                $stock = inventory::where('id', $inv->id);
                $array[] = array(
                    'type' => $key->type,
                    'id' => $key->id,
                    'cl_id'=>$key->cl_id,
                    'inv_id' => $inv->id,
                    'master' => $inv->master,
                    'name' => $key->name,
                    'cost' => $key->unit_cost,
                    'description' => $key->description,
                    'price' => empty($stock->first()) ? '' : $stock->first()->unit_cost,
                    'dangerlvl' => empty($stock->first()) ? '' : $stock->first()->danger_level,
                    'punit' => empty($stock->first()) ? '' : $stock->first()->unit,
                    'prunit' => $key->unit,
                    'status' => $key->status == true ? 'ACTIVE' : 'INACTIVE',
                    'qty' =>empty($stock->first()) ? 'Not purchased' : $stock->sum('qty_instock'),
                );
            }
        }

        else{

             $array[] = array(
                    'type' => $key->type,
                    'id' => $key->id,
                    'inv_id' => '',
                    'master' => '',
                    'cl_id'=>$key->cl_id,
                    'name' => $key->name,
                    'cost' => $key->unit_cost,
                    'description' => $key->description,
                    'price' =>  '',
                    'dangerlvl' =>  '',
                    'punit' =>  '',
                    'status' => $key->status == true ? 'ACTIVE' : 'INACTIVE',
                    'prunit' => $key->unit,
                    'qty' => 'Not purchased'
                );
        }   
        
        }

        return view('items.items')->with('items', $array);
    }

    public function updateinv(){
        $array = [];

        $items = item::join('categories', 'category_id', '=', 'categories.id')->join('classifications', 'classification_id', '=', 'classifications.id')->join('units', 'purchase_unit', '=', 'units.id')->select('items.*', 'categories.name as type', 'units.name as unit', 'classifications.id as cl_id')->get();
       //return $items;
        foreach ($items as $key) {
           
            $invs = inventory::join('master_accounts', 'master_id', '=', 'master_accounts.id')->where('item_id', $key->id)->where('master_accounts.type', 'master')->select('inventories.*', 'master_accounts.name as master')->get();
            if(count($invs) > 0){
            foreach ($invs as $inv) {
                $stock = inventory::where('id', $inv->id);
                $array[] = array(
                    'type' => $key->type,
                    'id' => $key->id,
                    'cl_id'=>$key->cl_id,
                    'inv_id' => $inv->id,
                    'master' => $inv->master,
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

        else{

           
        }   
        
        }
        //return $array;
        return view('items.updateinv')->with('itemss', $array);
    }

    public function setinv(Request $data){
         $stock = inventory::where('id', $data['id'])->first();
         if($data['type'] == 'cost'){
            $stock->unit_cost = $data['cost'];
         }
         else{
           $stock->qty_instock = $data['qty']; 
         }
         
         $stock->save();
    }

    public function inventoryview(Request $data){
        $inp = new inventory();
        return $inp->getinventory($data['id']);
    }

    public function edititem(Request $data){
         $master = master_account::where('type', 'master')->get();
        $item = item::where('id', $data->route('id'))->first();
        $category = category::all();
        $units = unit::all();
        $inv = inventory::where('id', $data->route('id'))->first();
       //return $data->route('id');
        return view('items.edititem')->with('item', $item)->with('category', $category)->with('units', $units)->with('master', $master)
        ->with('inv', $inv);
    }

    public function dashboard(){
        $array = [];
        $itemin = item::join('inventories', 'item_id', '=', 'items.id')->count();
        $itemdep = item::join('inventories', 'item_id', '=', 'items.id')->where('qty_instock', '=', '0')->count();
        $itemnot = item::whereNotIn('id', function($query) {
        $query->select('item_id')
              ->from('inventories');
    })->count();
         $categories = category::all();
        $units = unit::all();
        $items = item::join('inventories', 'item_id', '=', 'items.id')->where('qty_instock', '<=', 'dangerlvl')->orderBy('qty_instock')->get();
        $prs = purchase_request::join('employees', 'purchase_requests.requested_by', '=', 'employees.id')->select('employees.first_name', 'employees.last_name', 'purchase_requests.*')->where('status', 'PENDING')->get();
        $reqs = requests::join('employees', 'requests.employee_id', '=', 'employees.id')->select('employees.first_name', 'employees.last_name', 'requests.*')->where('status', 'PENDING')->get();
        $array = [$itemin, $itemdep, $itemnot];
        //return $itemin;
        return view('libraries.dashboard')->with('items', $items)->with('prs', $prs)->with('reqs', $reqs)->with('count', $array)->with('categories', $categories)->with('units', $units);
    }

    public function getnotiff(){
        $prs = purchase_request::join('employees', 'purchase_requests.requested_by', '=', 'employees.id')->select('employees.first_name', 'employees.last_name', 'purchase_requests.*')->where('status', 'PENDING')->get();
        $pos = purchase_order::join('purchase_requests', 'pr_no', '=', 'purchase_requests.ref_no')->join('suppliers', 'supplier_id', '=', 'suppliers.id')->where('purchase_orders.status', 'PENDING')->select('purchase_orders.*', 'suppliers.name', 'purchase_requests.purpose', 'purchase_requests.ref_no as prno')->get();

        return array($prs, $pos);
    }
}
