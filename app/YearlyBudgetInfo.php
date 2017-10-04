<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YearlyBudgetInfo extends Model
{
    protected $fillable = [
        'budget_type',
        'budget_head',
        'budget_particulars',
        'manufacturer_id',
        'supplier_id',
        'usd_amount',
        'bdt_amount',
        'usd_conversion',
        'quantity',
        'unit',
        'org_id',
        'created_by',
        'comment'
    ];

    public function unit(){
        return $this->belongsTo('App\UnitOfMesurement','unit','id');
    }
    public function budgetType(){
        return $this->belongsTo('App\BudgetType','budget_type','id');
    }
    public function budgetHead(){
        return $this->belongsTo('App\BudgetHead','budget_head','id');
    }
    public function manufacturer(){
        return $this->belongsTo('App\Manufacturer','manufacturer_id','id');
    }
    public function vendor(){
        return $this->belongsTo('App\Vendor','supplier_id','id');
    }
    public function user(){
        return $this->belongsTo('App\User','created_by','id');
    }
    public function organization(){
        return $this->belongsTo('App\Organization','org_id','id');
    }

    public function remainingBudget(){
        return $this->hasOne('App\VwRemainingBudget', 'id', 'id');
    }

}
