<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'vendor_id',
        'date',
        'vendor_contact_details',
        'service_type',
    ];

    public function vendor(){
        return $this->belongsTo('App\Vendor','vendor_id','id');
    }

    public function serviceType(){
        return $this->belongsTo('App\ServiceType','service_type','id');
    }

    public function ServiceDetails(){
        return $this->hasMany('App\ServiceDetail','service_id','id');
    }

    public function ExistsServiceDetails(){
        return $this->hasMany('App\ServiceDetail','service_id','id')->where('status',0);
    }
}
