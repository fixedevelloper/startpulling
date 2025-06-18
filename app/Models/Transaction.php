<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class,'bank_id','id');
    }
}
