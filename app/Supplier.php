<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'address1',
        'address2',
        'city',
        'telephone',
        'mobile',
        'email',
        'fax',
        'website',
        'vat_no',
        'contact_person',
        'credit_limit',
        'account_sys_id'
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function grn()
    {
        return $this->hasMany('App\Grn');
    }
}

