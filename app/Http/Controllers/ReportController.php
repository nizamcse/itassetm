<?php

namespace App\Http\Controllers;

use App\BudgetType;
use App\Issue;
use App\PurchaseRequisition;
use App\VwReceiveDetail;
use App\YearlyBudgetInfo;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function pendingAssets(){

        $remaining_assets = VwReceiveDetail::whereRaw('REQ_QTY > Receive_QTY')->get()->pluck('asset_id');

        $purchase_requisitions = PurchaseRequisition::with(['purchaseRequisitionDetails.asset'=> function ($q) use($remaining_assets){
            $q->whereIn('asset_id',$remaining_assets);
        }])->get();

        /*
         $purchase_requisitions = PurchaseRequisition::with(['purchaseRequisitionDetails' => function($q) use($remaining_assets) {
            $q->whereIn('asset_id', $remaining_assets)->with('asset');
        }])->get();
         */

        return view('admin.report-pending-asset')->with([
            'purchase_requisitions' => $purchase_requisitions
        ]);

    }

    public function receivedAssets(){
        $remaining_assets = VwReceiveDetail::where('Receive_QTY','>',0)->get()->pluck('asset_id');

        $purchase_requisitions = PurchaseRequisition::with(['purchaseRequisitionDetails' => function($q) use($remaining_assets) {
            $q->whereIn('asset_id', $remaining_assets)->with('asset');
        }])->get();

        return view('admin.report-received-asset')->with([
            'purchase_requisitions' => $purchase_requisitions
        ]);
    }

    public function issuedAssets(){
        $issues = Issue::all();
        return view('admin.report-issued-asset')->with([
            'issues' => $issues
        ]);

    }

    public function budgetDetails(){
        $yearly_budgets = YearlyBudgetInfo::all();
        return view('admin.report-budget-details')->with([
            'yearly_budgets' => $yearly_budgets
        ]);
    }
}
