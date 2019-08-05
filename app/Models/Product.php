<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model 
{

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('name', 'offer_price', 'details', 'prepare_time', 'image_id', 'resturant_id', 'price');

    public function image()
    {
        return $this->morphOne('App\Models\Image' , 'imageable');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order');
    }

    public function products()
    {
        return $this->belongsTo(Resturant::class);
    }

}