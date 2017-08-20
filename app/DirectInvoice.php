<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirectInvoice extends Model
{
    protected $fillable = [
        'customer_id',
        'vehicle_id',
        'invoice_type',
        'net_amount',
        'remarks',
        'created_by'
    ];

    protected $table = 'direct_invoices';

    public function customer(){
        return $this->belongsTo('App\Customer', 'customer_id');
    }

    public function vehicle(){
        return $this->belongsTo('App\Vehicle');
    }

    public function direct_invoice_details(){
        return $this->hasMany('App\DirectInvoiceDetail');
    }

    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($invoice) { // before delete() method call this
            $invoice->direct_invoice_details()->delete();
            // do the rest of the cleanup...
        });
    }
}
