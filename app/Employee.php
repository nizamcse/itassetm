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
        'location_id'
    ];
}
