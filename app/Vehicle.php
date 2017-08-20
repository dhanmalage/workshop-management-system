<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;
use App\Estimate;

class Vehicle extends Model
{
    protected $fillable = [
        'customer_id',
        'reg_no',
        'make',
        'model',
        'year',
        'chasis_no',
        'next_service'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function estimate()
    {
        return $this->hasMany('App\Estimate');
    }

}

