<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BudgetTypeApproval extends Model
{
    protected $fillable = [
        'budget_type_id',
        'approved_by',
    ];
}
