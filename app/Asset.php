<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'asset_old_cd',
        'name',
        'description',
        'asset_type',
        'asset_manufac',
        'asset_dept',
        'asset_sec',
        'asset_emp',
        'asset_life',
        'asset_life_unit',
        'asset_dep_method',
        'asset_retainment_dt',
        'created_by',
        'asset_org',
    ];

    public function assetTypes(){
        return $this->belongsTo('App\AssetType','asset_type','id');
    }

    public function departments(){
        return $this->belongsTo('App\Department','asset_dept','id');
    }

    public function employee(){
        return $this->belongsTo('App\Employee','asset_emp','id');
    }
}
