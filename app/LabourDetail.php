<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabourDetail extends Model
{
    protected $fillable = [
        'job_id',
        'employee_id',
        'normal_hrs',
        'normal_min',
        'ot_hrs',
        'ot_min',
        'dot_hrs',
        'dot_min',
        'other_hrs',
        'other_min'
    ];

    public function labour()
    {
        return $this->belongsTo('App\Labour');
    }
}
