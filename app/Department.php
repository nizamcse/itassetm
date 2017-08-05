<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'org',
        'reporting_to',
        'created_by',
    ];
}
