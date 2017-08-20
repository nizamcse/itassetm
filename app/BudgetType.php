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
        'created_by'
    ];

    public function yearlyBudget(){
        return $this->hasOne('App\YearlyBudgetInfo', 'budget_type', 'id');
    }

    public function approvalEmployee(){
        return $this->hasMany('App\BudgetTypeApprovalEmployee','budget_type');
    }


}
