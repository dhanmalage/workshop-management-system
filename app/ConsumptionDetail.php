<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumptionDetail extends Model
{
    protected $fillable = [
        'job_id',
        'description',
        'amount'
    ];

    public function consumption()
    {
        return $this->belongsTo('App\Consumption');
    }
}
