<?php

namespace App;
use App\item;

use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    public function itemlist(){
    	$array = [];

        $items = item::join('categories', 'category_id', '=', 'categories.id')->join('units', 'purchase_unit', '=', 'units.id')->select('items.*', 'categories.name as type', 'units.name as unit')->get();
       
        foreach ($items as $key) {
            $stock = inventory::where('item_id', $key->id);
            $array[] = array(
                'type' => $key->type,
                'id' => $key->id,
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

        return $array;
    }

    public function barcodelist(){
        $array = [];

        $items = item::join('categories', 'category_id', '=', 'categories.id')->join('units', 'purchase_unit', '=', 'units.id')->select('items.*', 'categories.name as type', 'units.name as unit')->get();
       
        foreach ($items as $key) {
            $stock = inventory::join('master_accounts', 'master_id', '=', 'master_accounts.id')->where('item_id', $key->id)->get();
            foreach ($stock as $inv) {
                
                $array[] = array(
                'type' => $key->type,
                'id' => $key->id,
                'name' => $key->name,
                'description' => $key->description,
                'master' => $inv->name
                );
            }
        
        }

        return $array;
    }
}
