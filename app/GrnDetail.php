<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrnDetail extends Model
{
    protected $fillable = [
            'grn_id',
            'item_id',
            'item_description',
            'quantity',
            'quantity_in',
            'status'
        ];
    public function item()
    {
        return $this->hasMany('App\Item');
    }

    public function grn()
    {
        return $this->belongsTo('App\Grn');
    }

}
