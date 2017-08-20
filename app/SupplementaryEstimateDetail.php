<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplementaryEstimateDetail extends Model
{
    protected $fillable = [
        'supplementary_estimate_id',
        'item_id',
        'item_description',
        'units',
        'rate',
        'labor_amount_final',
        'initial_amount',
        'task_status'
    ];

    public function item()
    {
        return $this->hasMany('App\Item');
    }

    public function supplementary_estimate()
    {
        return $this->belongsTo('App\SupplementaryEstimate');
    }
}
