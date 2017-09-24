<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetType extends Model
{
    protected $fillable = [
        'budget_type_year',
        'budget_type_name',
        'budget_type_level_apv',
        'type_info',
        'budget_org',
        'created_by',
        'status'
    ];

    public function yearlyBudget(){
        return $this->hasOne('App\YearlyBudgetInfo', 'budget_type', 'id');
    }

    public function approvalEmployee(){
        return $this->hasMany('App\BudgetTypeApprovalEmployee','budget_type');
    }

    public function employees(){
        return $this->belongsToMany('App\Employee','budget_type_approval_employees','budget_type','employee_id')->withPivot('employee_order');
    }

    public function employeesApproved(){
        return $this->belongsToMany('App\Employee','budget_type_approvals','budget_type_id','approved_by')->withTimestamps();
    }

    public function employeesApprovedAlready(){
        return $this->belongsToMany('App\Employee','budget_type_approvals','budget_type_id','approved_by')->withTimestamps();
    }

    public function purchaseRequisions(){
        return $this->hasMany('App\PurchaseRequisition','budget_type','id');
    }


}
