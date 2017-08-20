<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubAssetType extends Model
{
    protected $fillable = [
        'name',
        'sub_level',
        'parent_id',
        'sub_type_org',
        'created_by',
    ];
}
