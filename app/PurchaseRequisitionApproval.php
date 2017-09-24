<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequisitionApproval extends Model
{
    protected $fillable = [
        'purchase_reqn_id',
        'approved_by'
    ];
}
