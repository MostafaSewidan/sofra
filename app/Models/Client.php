<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'district_id', 'password', 'api_token', 'activation_report');
    protected $hidden = array('password', 'api_token');

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function contacts()
    {
        return $this->morphMany('App\Models\Contact' , 'contactable');
    }

    public function resturants()
    {
        return $this->belongsToMany('App\Models\Resturant');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification' , 'notifiable');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image','imageable');
    }

    public function token()
    {
        return $this->morphMany('App\Models\Token','tokenable');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}