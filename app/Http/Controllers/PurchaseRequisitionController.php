<?php

namespace App\Http\Controllers;

use App\BudgetType;
use App\Organization;
use App\PurchaseRequisition;
use Illuminate\Http\Request;
use Auth;

class PurchaseRequisitionController extends Controller
{
    public function index(){

        $budget_types = BudgetType::where('type_info','purchase_requisition')->get();
        return view('admin.purchase-requisition')->with([
            'budget_types'  => $budget_types
        ]);
    }

    public function getPurchaseRequisition($id){
        $purchase_requisition = PurchaseRequisition::with(['budgetType'])
                                    ->where('id',$id)->first();
        return response()->json($purchase_requisition,201);
    }

    public function getPurchaseRequisitions(){
        $purchase_requisitions['purchase_requisitions'] = PurchaseRequisition::with(['budgetType'])->get();
        return response()->json($purchase_requisitions,201);
    }

    public function create(Request $request){
        $org = Organization::first();
        $purchase_requisition = PurchaseRequisition::create([
            'budget_type'  => $request->input('budget_type'),
            'particulars'  => $request->input('particulars'),
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
        $purchase_requisition->update([
            'budget_type'  => $request->input('budget_type'),
            'particulars'  => $request->input('particulars'),
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
}
