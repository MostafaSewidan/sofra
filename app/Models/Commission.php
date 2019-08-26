<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model 
{

    protected $table = 'commissions';
    public $timestamps = true;
    protected $fillable = array('remain_amount', 'resturant_id');

    public function resturants()
    {
        return $this->hasOne(Resturant::class);
    }

}