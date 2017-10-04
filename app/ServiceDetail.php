<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceDetail extends Model
{
    protected $fillable = [
        'service_id',
        'asset_id',
        'problem_description',
        'sd_remarks',
        'status',
    ];

    public function asset(){
        return $this->belongsTo('App\Asset','asset_id','id');
    }

    public function service(){
        return $this->belongsTo('App\Service','service_id','id');
    }
}
