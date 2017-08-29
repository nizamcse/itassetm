<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiveDetail extends Model
{
    protected $fillable = [
        'vendor_id',
        'purchase_order_no',
        'purchase_order_date',
        'vendor_invoice_no',
        'vendor_delivery_date',
        'receive_id',
        'asset_id',
        'product_sl_no',
        'product_licence_no',
        'warranty_start_from',
        'warranty_duration',
        'quantity',
        'price',
        'received_by',
    ];
}
