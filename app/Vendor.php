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
        'email',
        'status',
        'comment',
        'vendor_type_id',
    ];

    public function yearlyBudget(){
        return $this->hasOne('App\YearlyBudgetInfo', 'supplier_id', 'id');
    }

    public function vendorContacts(){
        return $this->hasMany('App\VendorContact', 'vendor_id', 'id');
    }

    public function VendorDocuments(){
        return $this->hasMany('App\VendorDocument', 'vendor_id', 'id');
    }
}
