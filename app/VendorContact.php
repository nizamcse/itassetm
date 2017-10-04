<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VendorContact extends Model
{
    protected $fillable = [
        'vendor_id',
        'contact_person',
        'contact_number',
        'address',
    ];
}
