<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetTypeApprovalEmployee extends Model
{
    protected $fillable = [
        'budget_type',
        'employee_id',
        'employee_order',
        'budget_org',
        'created_by',
    ];

    public function employee(){
        return $this->belongsTo('App\Employee','employee_id');
    }

    public function budgetType(){
        return $this->belongsTo('App\BudgetType','employee_id');
    }

    public function user(){
        return $this->belongsTo('App\User','created_by');
    }

    public function organization(){
        return $this->belongsTo('App\Organization','budget_org');
    }
}
