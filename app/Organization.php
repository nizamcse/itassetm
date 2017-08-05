<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city',
        'postal_code',
        'state',
        'country',
        'phone',
        'email',
        'fax',
        'web',
        'photo',
        'key',
        'created_by',
    ];
}
