<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model 
{

    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = array(
                                    'contact_type_id',
                                    'name',
                                    'email',
                                    'phone',
                                    'sms_body',
                                    'contactable_type',
                                    'contactable_id',
                                    'type',
                                    'is_read'
                                    );

    public function contactable()
    {
        return $this->morphTo();
    }


}