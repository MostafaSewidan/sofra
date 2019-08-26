<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'details', 'start_date', 'end_date', 'resturant_id' ,'photo');

    public function resturant()
    {
        return $this->belongsTo('App\Models\Resturant');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image' , 'imageable');
    }

}