<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('client_id', 'resturant_id', 'order_notes', 'state', 'price','address');

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
    public function resturant()
    {
        return $this->belongsTo(Resturant::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

}