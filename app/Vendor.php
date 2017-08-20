<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'address',
        'contact_person',
        'contact_no',
        'web',
        'trade_no',
        'vat_no',
        'company',
        'org',
        'created_by',
    ];

    public function yearlyBudget(){
        return $this->hasOne('App\YearlyBudgetInfo', 'supplier_id', 'id');
    }
}
