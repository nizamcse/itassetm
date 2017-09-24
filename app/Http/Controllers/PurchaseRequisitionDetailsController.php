<?php

namespace App\Http\Controllers;

use App\Asset;
use App\BudgetType;
use App\Organization;
use App\PurchaseRequisition;
use App\PurchaseRequisitionDetail;
use Illuminate\Http\Request;
use Auth;

class PurchaseRequisitionDetailsController extends Controller
{
    public function index(){

        $assets = Asset::whereDoesntHave('purchaseRequisition')->get();
        $purchase_equisitions = PurchaseRequisition::all();
        return view('admin.purchase-requisition-details')->with([
            'assets'  => $assets,
            'purchase_equisitions'  => $purchase_equisitions,
        ]);
    }

    public function getPurchaseRequisitionDetail($id){
        $purchase_requisition_detail = PurchaseRequisitionDetail::with(['asset','purchaseRequisition.budgetType'])
            ->where('id',$id)->first();
        return response()->json($purchase_requisition_detail,201);
    }

    public function getPurchaseRequisitionDetails(){
        /*
         * This may need later
         */
        /*
        $purchase_requisition_details['purchase_requisition_details'] = PurchaseRequisitionDetail::with([
            'asset.employee' => function($q){
                $q->with(['department','section'])->get();
            }
        ])->get();
        */

        $purchase_requisition_details['purchase_requisition_details'] = PurchaseRequisitionDetail::with(['asset.employee'])->get();

        return response()->json($purchase_requisition_details,201);
    }

    public function create(Request $request){
        $org = Organization::first();
        $asset = Asset::find($request->input('asset_id'));
        $purchase_requisition_details = PurchaseRequisitionDetail::create([
            'asset_id'  => $asset->id,
            'quantity'  => $request->input('quantity'),
            'approx_price'  => $request->input('approx_price'),
            'budget_org'   => $org->id,
            'purchase_req_id'   => $request->input('purchase_req_id'),
            'created_by'   => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this purchase requisition details'
        ],200);
    }

    public function update(Request $request, $id){
        $asset = Asset::find($request->input('asset_id'));
        $purchase_requisition_detail = PurchaseRequisitionDetail::find($id);
        $purchase_requisition_detail->update([
            'asset_id'  => $asset->id,
            'quantity'  => $request->input('quantity'),
            'approx_price'  => $request->input('approx_price'),
            'purchase_req_id'   => $request->input('purchase_req_id'),
            'created_by'   => Auth::user()->id,
        ]);
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this purchase requisition details'
        ],200);
    }

    public function delete($id){
        PurchaseRequisitionDetail::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this purchase requisition details'
        ],200);
    }
}
