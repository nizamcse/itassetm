<?php

namespace App\Http\Controllers;

use App\PurchaseRequisition;
use App\Receive;
use App\ReceiveDetail;
use App\YearlyBudgetInfo;
use Illuminate\Http\Request;
use Auth;

class PurchaseReceiveDetailsController extends Controller
{
    public function index(){
        $receive_details = ReceiveDetail::groupBy('asset_id')->sum('quantity');
        $receive_details = ReceiveDetail::groupBy('asset_id')->get();
        //return $receive_details;
        //return $receive_details;
        return view('admin.purchase-receive-details');
    }

    public function saveReceive(Request $request,$per_req_id,$asset_id){
        //return $request->input('receive_date');
        $receive = Receive::firstOrCreate([
            'purchase_req_id'   => $per_req_id,
            'date'   => $request->input('receive_date')
        ]);

        $yearly_bgt_info = YearlyBudgetInfo::where('budget_type',$request->input('budget'))
            ->where('budget_head', $request->input('budget_head'))->first();

        $receive_details = ReceiveDetail::create([
            'vendor_id' => $request->input('vendor_id'),
            'purchase_order_no' => $request->input('purchase_order_no'),
            'purchase_order_date' => $request->input('purchase_order_date'),
            'vendor_invoice_no' => $request->input('vendor_invoice_no'),
            'vendor_delivery_date' => $request->input('vendor_delivery_date'),
            'receive_id' => $receive->id,
            'asset_id' => $asset_id,
            'product_sl_no' => $request->input('product_sl_no'),
            'product_licence_no' => $request->input('product_licence_no'),
            'warranty_start_from' => $request->input('warranty_start_from'),
            'warranty_duration' => $request->input('warranty_duration'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
            'yearly_budget_info_id' => $yearly_bgt_info->id,
            'received_by' => Auth::user()->id,
        ]);

        return redirect()->route('purchase-receive');
    }
}
