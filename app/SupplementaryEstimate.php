<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplementaryEstimate extends Model
{
    protected $fillable = [
        'estimate_id',
        'net_amount',
        'created_by'
    ];

    public function estimate(){
        return $this->belongsTo('App\Estimate');
    }

    public function supplementary_estimate_details(){
        return $this->hasMany('App\SupplementaryEstimateDetail');
    }
}
