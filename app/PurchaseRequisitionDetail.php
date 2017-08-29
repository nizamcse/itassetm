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
        'purchase_req_id',
        'created_by',
        'comment',
    ];

    public function asset(){
        return $this->belongsTo('App\Asset','asset_id','id');
    }

    public function purchaseRequisition(){
        return $this->belongsTo('App\PurchaseRequisition','purchase_req_id','id');
    }
}
