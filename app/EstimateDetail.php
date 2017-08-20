<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstimateDetail extends Model
{
    protected $fillable = [
        'estimate_id',
        'item_id',
        'item_description',
        'units',
        'quantity_issued',
        'balance_quantity',
        'quantity_issued',
        'rate',
        'labor_amount_final',
        'initial_amount',
        'approved_amount',
        'task_status'
    ];

    public function item()
    {
        return $this->hasMany('App\Item');
    }

    public function estimate()
    {
        return $this->belongsTo('App\Estimate');
    }
}
