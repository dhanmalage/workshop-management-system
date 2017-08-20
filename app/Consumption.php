<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    protected $fillable = [
        'job_id',
        'total'
    ];

    public function consumption_details(){
        return $this->hasMany('App\ConsumptionDetail');
    }
}
