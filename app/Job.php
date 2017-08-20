<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'estimate_id',
        'promised_date',
        's_adviser',
        'status',
        'remarks',
        'tested_by',
        'section_incharge',
        'created_by',
    ];

    public function estimate()
    {
        return $this->belongsTo('App\Estimate');
    }

    public function job_details(){
        return $this->hasMany('App\JobDetail');
    }
}
