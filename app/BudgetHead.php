<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetHead extends Model
{
    protected $fillable = [
        'name',
        'parent_id',
        'bhead_level',
        'bhead_org',
        'created_by'
    ];

    public function parent(){
        return $this->belongsTo('App\BudgetHead','parent_id','id');
    }

    public function yearlyBudget(){
        return $this->hasOne('App\YearlyBudgetInfo', 'budget_head', 'id');
    }
}
