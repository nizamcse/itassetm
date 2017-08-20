<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubAsset extends Model
{
    protected $fillable = [
        'suba_asset_cd',
        'sub_asset_old_code',
        'suba_name',
        'suba_lifetime',
        'suba_life_unit',
        'suba_org',
        'suba_des',
        'suba_dep_method',
        'suba_retainment_dt',
        'created_by',
    ];
}
