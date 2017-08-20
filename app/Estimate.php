<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'mileage_in',
        'net_amount',
        'insurance_company',
        'parent_estimate_id',
        'department',
        'created_by'
    ];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function vehicle(){
        return $this->belongsTo('App\Vehicle');
    }

    public function estimate_details(){
        return $this->hasMany('App\EstimateDetail');
    }

    public function supplementary_estimates(){
        return $this->hasMany('App\SupplementaryEstimates');
    }

    public function job(){
        return $this->belongsTo('App\Job');
    }

   /* public function job(){
        return $this->belongsTo('App\Job');
    }*/

}
