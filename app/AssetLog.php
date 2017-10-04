<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetLog extends Model
{
    protected $fillable = [
        'asset_id',
        'asset_log',
    ];

    public function asset(){
        return $this->belongsTo('App\Asset','asset_id','id');
    }
}
