<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 
use App\item;


class pr_line extends Model
{
	use SoftDeletes;
    
    public function prlines($id){
    	$prlines = pr_line::join('items', 'pr_lines.item_id', '=', 'items.id')->where('pr_id', $id)->select('items.name', 'pr_lines.*', 'items.id as stock')->get();
    	return $prlines;
    }

    public function deletelines($id){
    	$prlines = pr_line::where('pr_id', $id)->delete();
    }
}
