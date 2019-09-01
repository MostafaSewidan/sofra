<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resturant extends Model 
{
    protected $guard = 'resturent';
    protected $table = 'resturants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'district_id', 'password',
        'min_charge', 'deliver_cost', 'whats_app', 'state',
        'payment_activate', 'activation_report', 'api_token','rate');

    protected $hidden = array('password' , 'api_token');

    protected $with = ['district.city'];

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function contacts()
    {
        return $this->morphMany('App\Models\Contact'  , 'contactable');
    }

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client')->withPivot('comment','rate');
    }

    public function commissions()
    {
        return $this->belongsTo(Commission::class);
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification','notifiable');
    }

    public function image()
    {
        return $this->morphOne('App\Models\Image' , 'imageable');
    }

    public function token()
    {
        return $this->morphMany('App\Models\Token' , 'tokenable');
    }

    public function reviews()
    {
        return $this->hasMany(Client_resturant::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

//    public function city()
//    {
//        return $this->hasManyThrough(City::class,District::class );
//    }
}