<?php

namespace App\Http\Controllers;

use App\Asset;
use App\BudgetType;
use App\Organization;
use App\PurchaseRequisition;
use App\PurchaseRequisitionDetail;
use Illuminate\Http\Request;
use Auth;

class PurchaseRequisitionController extends Controller
{
    public function index(){

        $budget_types = BudgetType::where('type_info','purchase_requisition')->where('status',0)->get();
        $assets = Asset::whereDoesntHave('purchaseRequisition')->get();
        //return $assets;
        return view('admin.purchase-requisition')->with([
            'budget_types'  => $budget_types,
            'assets'    => $assets
        ]);
    }

    public function getPurchaseRequisition($id){
        $purchase_requisition['purchase_requisition'] = PurchaseRequisition::with(['budgetType'])->where('id',$id)->first();
        $purchase_requisition['pur_req_details'] = PurchaseRequisitionDetail::where('purchase_req_id',$id)->first();
        return response()->json($purchase_requisition,201);
    }

    public function getPurchaseRequisitions(){
        $purchase_requisitions['purchase_requisitions'] = PurchaseRequisition::with(['budgetType','purchaseRequisitionDetails.asset.employee'])
            ->whereDoesntHave('budgetType',function($q){
                $q->where('status','>',0);
            })->get();
        return response()->json($purchase_requisitions,201);
    }

    public function create(Request $request){

        $time = strtotime($request->input('date'));

        $newFormat = date('Y-m-d',$time);

        $asset = Asset::find($request->input('asset_id'));
        $asset_id = $asset->id;
        $purchase_req_details = PurchaseRequisitionDetail::whereHas('asset',function($q) use($asset_id){
            $q->where('asset_id', $asset_id);
        })->get();

        if(count($purchase_req_details)){
            return response()->json([
                'status' => 'ok',
                'message' => 'You are trying to assign multiple asset on single purchase requisition'
            ],500);
        }

        $org = Organization::first();
        $purchase_requisition = PurchaseRequisition::create([
            'budget_type'  => $request->input('budget_type'),
            'particulars'  => $request->input('particulars'),
            'budget_org'   => $org->id,
            'date'   => $newFormat,
            'created_by'   => Auth::user()->id,
        ]);

        $purchase_requisition_details = PurchaseRequisitionDetail::create([
            'asset_id'  => $asset->id,
            'purchase_req_id'  => $purchase_requisition->id,
            'quantity'  => $request->input('quantity'),
            'approx_price'  => $request->input('approx_price'),
            'budget_org'   => $org->id,
            'created_by'   => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this purchase requisition'
        ],200);
    }

    public function update(Request $request, $id){

        $purchase_requisition = PurchaseRequisition::find($id);

        $time = strtotime($request->input('date'));

        $newFormat = date('Y-m-d',$time);

        $purchase_requisition->update([
            'budget_type'  => $request->input('budget_type'),
            'particulars'  => $request->input('particulars'),
            'date'   => $newFormat,
            'created_by'   => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this purchase requisition'
        ],200);
    }

    public function delete($id){
        PurchaseRequisition::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this purchase requisition'
        ],200);
    }

    public function remainingAsset(){
        $assets = Asset::whereDoesntHave('purchaseRequisition')->get();
        $data = "<option>--Select Asset</option>>";

        foreach($assets as $asset){
            $type = $asset->assetTypes ? $asset->assetTypes->name : '';
            $dept = $asset->departments ? $asset->departments->name : '';
            $emp = $asset->employee ? $asset->employee->name : '';
            $tmp = '<option value="'.$asset->id.'">'.$asset->name.'Type - '.$type.' Dept - '.$dept.' Empl - '.$emp.'</option>';
            $data .= $tmp;
        }

        return $data;
    }
}
