<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UssdRequest extends Model {
    protected $fillable = ['device_id','ussd_code','status','response'];
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
}
