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

class UpdateController extends Controller
{
   public function updateinventory(){
        $invs = inventory_mov::pluck('inventory_id');
        $array = json_decode($invs,1);
        
        $items = inventory::whereNotIn('id', $array)->get();
        //return $items;
        foreach ($items as $item) {
            $inv =  new inventory_mov();
            $inv->inventory_id = $item->id;
            $inv->quantity = $item->qty_instock;
            $inv->unit = $item->unit;
            $inv->unit_cost = $item->unit_cost;
            $inv->amount = $item->unit_cost * $item->qty_instock;
            $inv->asof = Carbon::parse('2022-05-01');
            $inv->save();
        }
   }
}
