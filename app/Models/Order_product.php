<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_product extends Model 
{

    protected $table = 'order_product';
    public $timestamps = true;
    protected $fillable = array('product_id', 'order_id', 'quantity', 'special_notes', 'price');

}