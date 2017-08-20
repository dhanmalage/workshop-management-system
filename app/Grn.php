<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grn extends Model
{
    protected $fillable = [
        'supplier_id'
    ];
    public function supplier(){
        return $this->belongsTo('App\Supplier');
    }
    public function grn_details(){
        return $this->hasMany('App\GrnDetail');
    }

}
