<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

	use SoftDeletes;

    protected $fillable = ['product_name','category_id','product_short_description','product_detail_description','product_price','publication_status','deleted_at','product_image'];


    public function relationToCategory(){

    	return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
