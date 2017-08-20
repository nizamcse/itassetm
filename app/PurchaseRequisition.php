<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequisition extends Model
{
    protected $fillable = [
        'budget_type',
        'particulars',
        'budget_org',
        'created_by'
    ];

    public function budgetType(){
        return $this->belongsTo('App\BudgetType','budget_type','id');
    }


    public function setParticularsAttribute($value)
    {
        $this->attributes['particulars'] = strtoupper($value);
    }
}
