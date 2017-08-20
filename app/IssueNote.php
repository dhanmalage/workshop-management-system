<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueNote extends Model
{
    protected $fillable = [
        'remark'
    ];
    public function issue_note_details(){
        return $this->hasMany('App\IssueNoteDetail');
    }
}
