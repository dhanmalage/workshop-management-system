<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'role_id',
        'rate',
        'ot_rate',
        'double_ot_rate',
        'other'
    ];
}
