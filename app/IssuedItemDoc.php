<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssuedItemDoc extends Model
{
    protected $fillable = [
        'issued_item_id',
        'docs',
        'document',
    ];

    public function issueDetails(){
        return $this->belongsTo('App\IssueDetail','issued_item_id','id');
    }
}
