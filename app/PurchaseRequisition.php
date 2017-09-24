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
        'created_by',
        'status',
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

    public function employeesApprovedAlready(){
        return $this->belongsToMany('App\Employee','purchase_requisition_approvals','purchase_reqn_id','approved_by')->withTimestamps();
    }
}
