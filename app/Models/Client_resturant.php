<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client_resturant extends Model 
{

    protected $table = 'client_resturant';
    public $timestamps = true;
    protected $fillable = array('client_id', 'resturant_id', 'rate', 'comment');

    public function resturant()
    {
        return $this->belongsTo(Resturant::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}