<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitOfMesurement extends Model
{
    protected $fillable = ['name'];

    public function yearlyBudget(){
        return $this->hasOne('App\YearlyBudgetInfo', 'unit', 'id');
    }
}
