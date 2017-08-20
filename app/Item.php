<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'type',
        'location',
        'quantity',
        'sale_price',
        'unit_of_sale',
        'pre_order_level',
        'created_by',
        'category_id',
        'service_only_cost',
        'vat',
        'nbt',
        'updated_at'
    ];

    public function estimate_details()
    {
        return $this->hasMany('App\EstimateDetail');
    }

    public function supplementary_estimate_details()
    {
        return $this->hasMany('App\SupplementaryEstimateDetail');
    }

}
