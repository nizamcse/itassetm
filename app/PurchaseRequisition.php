<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequisition extends Model
{
    protected $fillable = [
        'budget_type',
        'particulars',
        'budget_org',
        'date',
        'created_by'
    ];

    public function budgetType(){
        return $this->belongsTo('App\BudgetType','budget_type','id');
    }

    public function purchaseRequisitionDetails(){
        return $this->hasMany('App\PurchaseRequisitionDetail','purchase_req_id','id');
    }


    public function setParticularsAttribute($value)
    {
        $this->attributes['particulars'] = strtoupper($value);
    }

    public function receives(){
        return $this->hasMany('App\Receive','purchase_req_id','id');
    }
}
