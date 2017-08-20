<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectInvoiceDetail extends Model
{
    protected $fillable = [
        'direct_invoice_id',
        'item_id',
        'item_description',
        'units',
        'rate',
        'initial_amount'
    ];

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
    public function direct_invoice()
    {
        return $this->belongsTo('App\DirectInvoice');
    }
}
