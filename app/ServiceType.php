<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $fillable = [
        'name',
        'service_type',
        'service_org',
        'created_by'
    ];
}
