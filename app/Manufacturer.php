<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'name',
        'org',
        'created_by'
    ];

    public function yearlyBudget(){
        return $this->hasOne('App\YearlyBudgetInfo', 'manufacturer_id', 'id');
    }
}
