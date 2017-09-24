<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueDetail extends Model
{
    protected $fillable = [
        'issue_id',
        'asset_id',
        'quantity',
        'particulars',
        'sl_no',
        'reqn_number',
        'dept_id',
        'location_id',
        'employee_id',
        'created_by',
    ];

    public function IssuedItemDoc(){
        return $this->hasOne('App\IssuedItemDoc','issued_item_id','id');
    }

    public function asset(){
        return $this->belongsTo('App\Asset','asset_id','id');
    }

    public function employee(){
        return $this->belongsTo('App\Employee','employee_id','id');
    }

    public function itemDoc(){
        return $this->hasOne('App\IssuedItemDoc','issued_item_id','id');
    }




}
