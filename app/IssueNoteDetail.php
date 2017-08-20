<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueNoteDetail extends Model
{
    protected $fillable = [
            'job_id',
            'item_id',
            'item_description',
            'quantity_requested',
            'quantity_issued'
        ];
    public function item()
    {
        return $this->hasMany('App\Item');
    }

    public function issue_note()
    {
        return $this->belongsTo('App\IssueNote');
    }
}
