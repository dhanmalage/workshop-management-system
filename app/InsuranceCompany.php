<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceCompany extends Model
{
    protected $fillable = [
        'name',
        'address',
        'telephone',
        'email',
        'fax',
        'website',
        'contact_person',
        'vat_no'
    ];
}
