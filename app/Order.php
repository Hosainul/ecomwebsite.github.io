<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderRelationTocustomer(){

    	return $this->hasOne('App\Customer','id','customer_id');
    }
}
