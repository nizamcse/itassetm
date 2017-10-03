<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'employee_code',
        'dept_id',
        'joined_at',
        'name',
        'phone',
        'email',
        'designation',
        'location',
        'org',
        'created_by',
        'location_id',
        'section_id',
        'status',
    ];

    public function budgetTypeApproval(){
        return $this->hasMany('App\BudgetTypeApprovalEmployee','employee_id');
    }

    public function department(){
        return $this->belongsTo('App\Department','dept_id','id');
    }

    public function section(){
        return $this->belongsTo('App\Section','section_id','id');
    }

    public function user(){
        return $this->hasOne('App\User','employee_id','id');
    }

    public function budgetTypes(){
        return $this->belongsToMany('App\BudgetType','budget_type_approval_employees','employee_id','budget_type')
            ->withPivot('employee_order')
            ->orderBy('id','asc');
    }

    public function yearlyBudgetInfo(){
        return $this->belongsToMany('App\YearlyBudgetInfo','budget_type_approvals','approved_by','budget_type_id');
    }
}
