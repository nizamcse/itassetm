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
}
