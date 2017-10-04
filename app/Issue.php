<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
        'date',
        'particulars',
        'created_by',
    ];

    public function issueDetails(){
        return $this->hasMany('App\IssueDetail','issue_id','id');
    }
}
