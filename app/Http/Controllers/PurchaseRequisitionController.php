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

        $purchase_requisitions = PurchaseRequisition::all();
        return view('admin.purchase-requisition')->with([
            'purchase_requisitions'  => $purchase_requisitions,
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

    public function getCreatePurchaseRequisition(){

        $budget_types = BudgetType::where('type_info','purchase_requisition')->where('status',0)->get();
        $assets = Asset::all();
        //return $assets;
        return view('admin.create-purchase-requisition')->with([
            'budget_types'  => $budget_types,
            'assets'    => $assets
        ]);
    }

    public function create(Request $request){

        $time = strtotime($request->input('date'));
        $time2 = strtotime($request->input('expected_receive_date'));

        $newFormat = date('Y-m-d',$time);
        $newFormat2 = date('Y-m-d',$time2);

        $org = Organization::first();

        $purchase_requisition = PurchaseRequisition::create([
            'budget_type'  => $request->input('budget_type'),
            'particulars'  => $request->input('particulars'),
            'budget_org'   => $org->id,
            'date'   => $newFormat,
            'expected_receive_date'   => $newFormat2,
            'created_by'   => Auth::user()->id,
        ]);

        foreach ($request->input('asset') as $asset){
            $purchase_requisition_details = PurchaseRequisitionDetail::create([
                'asset_id'  => $asset['name'],
                'purchase_req_id'  => $purchase_requisition->id,
                'quantity'  => $asset['quantity'],
                'approx_price'  => $asset['price'],
                'budget_org'   => $org->id,
                'created_by'   => Auth::user()->id,
            ]);
        }

        return redirect()->route('pr-details',['id' => $purchase_requisition->id]);
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
        $data = "<option>--Select Asset</option>";

        foreach($assets as $asset){
            $type = $asset->assetTypes ? $asset->assetTypes->name : '';
            $dept = $asset->departments ? $asset->departments->name : '';
            $emp = $asset->employee ? $asset->employee->name : '';
            $tmp = '<option value="'.$asset->id.'">'.$asset->name.'Type - '.$type.' Dept - '.$dept.' Empl - '.$emp.'</option>';
            $data .= $tmp;
        }

        return $data;
    }

    public function newPurchaseRequisition(){
        $budget_types = $budget_types = BudgetType::where('type_info','purchase_requisition')->get();;
        $assets = Asset::whereDoesntHave('purchaseRequisition')->get();
        return view('admin.create-purchase-requisition')->with([
            'budget_types'  => $budget_types,
            'assets'  => $assets,
        ]);
    }

    public function deletePurchaseRequisition($id){
        $purchase_requisition = PurchaseRequisition::find($id);
        if(count($purchase_requisition->receives) == 0 && Auth::user()->user_type == 'ADMIN'){
            $ids = $purchase_requisition->purchaseRequisitionDetails->pluck('id');
            $emp_ids = $purchase_requisition->employeesApprovedAlready->pluck('id');
            $purchase_requisition->employeesApprovedAlready()->detach($emp_ids);
            PurchaseRequisitionDetail::whereIn('id',$ids)->delete();
            $purchase_requisition->delete();
        }

        return redirect()->back();
    }

    public function forceApprovePurchaseRequisition($id){
        $purchase_requisition = PurchaseRequisition::find($id);
        if(
            ($purchase_requisition->status > 0 && $purchase_requisition->status < 3) &&
            count($purchase_requisition->receives) == 0
            && Auth::user()->user_type == 'ADMIN'
        ){
            $purchase_requisition->update([
                'status'    => 3,
                'admin_approved'    => 1
            ]);
        }

        return redirect()->back();
    }
}
