<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model 
{

    protected $table = 'images';
    public $timestamps = true;
    protected $fillable = array('name', 'imageable_type' , 'imageable_id');

    public function imageable()
    {
        return $this->morphTo();
    }

}