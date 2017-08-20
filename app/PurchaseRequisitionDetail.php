<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequisitionDetail extends Model
{
    protected $fillable = [
        'asset_id',
        'quantity',
        'approx_price',
        'budget_org',
        'created_by',
    ];

    public function asset(){
        return $this->belongsTo('App\Asset','asset_id','id');
    }
}
