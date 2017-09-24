<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{
    protected $fillable = ['purchase_req_id','status'];

    public function purchaseRequisition(){
        return $this->belongsTo('App\PurchaseRequisition','purchase_req_id','id');
    }

    public function receiveDetails(){
        return $this->hasMany('App\ReceiveDetail','receive_id','id');
    }
}


/*
 * SELECT
	asset_id
FROM
	purchase_requisition_details PD,
receives RD

where PD.purchase_req_id=RD.purchase_req_id
and PD.asset_id not in (SELECT
			asset_id
		FROM
			receive_details
		WHERE
			receive_id = RD.id)
AND RD.id=1
 */
