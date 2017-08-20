<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'supplier_id',
        'total',
        'order_status',
        'item_status',
        'created_at',
        'created_by'
    ];

    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }
    public function order_details(){
        return $this->hasMany('App\OrderDetail');
    }
}
