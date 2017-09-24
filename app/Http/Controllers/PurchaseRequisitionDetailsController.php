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
        $purchase_equisition = PurchaseRequisition::all();
        //return $purchase_equisition;
        return redirect()->back();
        return view('admin.purchase-requisition-details')->with([
            'purchase_equisition'  => $purchase_equisition,
        ]);
    }

    public function getPurchaseRequisitionDetail($id){
        $purchase_requisition_detail = PurchaseRequisitionDetail::with(['asset' => function($q){
            $q->with(['employee']);
        },'purchaseRequisition.budgetType'])
            ->where('id',$id)->first();
        return response()->json($purchase_requisition_detail,201);
    }

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


    public function create(Request $request,$id){
        $org = Organization::first();
        $asset = Asset::find($request->input('asset'));
        $purchase_requisition_details = PurchaseRequisitionDetail::create([
            'asset_id'  => $asset->id,
            'quantity'  => $request->input('quantity'),
            'approx_price'  => $request->input('price'),
            'budget_org'   => $org->id,
            'purchase_req_id'   => $id,
            'created_by'   => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this purchase requisition details'
        ],200);
    }

    public function update(Request $request, $id){
        $asset = Asset::find($request->input('asset'));
        $purchase_requisition_detail = PurchaseRequisitionDetail::find($id);
        $purchase_requisition_detail->update([
            'asset_id'  => $asset->id,
            'quantity'  => $request->input('quantity'),
            'approx_price'  => $request->input('price'),
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

    public function getPurchaseRequisitionDetails($id){
        $purchase_equisition = PurchaseRequisition::find($id);
        $assets = Asset::whereDoesntHave('purchaseRequisition')->get();
        return view('admin.purchase-requisition-details')->with([
            'purchase_equisition'  => $purchase_equisition,
            'assets'  => $assets,
        ]);
    }

    public function getPurchaseRequisitionDetailsJson($id){
        $pr_req_details['pr_req_details']['data'] = PurchaseRequisitionDetail::with(['asset','purchaseRequisition'])
            ->where('purchase_req_id',$id)->get();
        $pr_req_details['pr_req_details']['info'] = PurchaseRequisition::find($id);

        return response()->json($pr_req_details,200);
    }
}
