<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    protected $fillable = [
        'job_id'
    ];

    public function labour_details(){
        return $this->hasMany('App\LabourDetail');
    }
}
