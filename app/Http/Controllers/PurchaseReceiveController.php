<?php

namespace App\Http\Controllers;

use App\Asset;
use App\BudgetType;
use App\PurchaseRequisition;
use App\PurchaseRequisitionDetail;
use App\Receive;
use App\VwReceiveDetail;
use App\VwRemainingBudget;
use Illuminate\Http\Request;

class PurchaseReceiveController extends Controller
{
    public function index(){
        $data_pr_req = array();

        $prs = PurchaseRequisition::where('status',3)->get();

        foreach ($prs as $pr){
            $data = [];
            $receives = VwReceiveDetail::where('PUR_REQ_ID',$pr->id)->get();
            foreach($receives as $receive){
                if($receive->REQ_QTY - $receive->Receive_QTY == 0){
                    $data[]= $receive->asset_id;
                }
            }
            $contain_assets = $pr->purchaseRequisitionDetails->pluck('asset_id');
            $asset = Asset::whereNotIn('id',$data)->whereIn('id',$contain_assets)->get();

            if(count($asset)>0){
                $data_pr_req[] = $pr->id;
            }

        }


        $pur_reqns = PurchaseRequisition::whereIn('id',$data_pr_req)->get();

        //return $pur_reqns;

        return view('admin.purchase-receive')->with([
            'pur_reqns'  => $pur_reqns
        ]);
    }

    public function receiveAsset($id){

        $data = [];
        $receives = VwReceiveDetail::where('PUR_REQ_ID',$id)->get();
        foreach($receives as $receive){
            if($receive->REQ_QTY - $receive->Receive_QTY == 0){
                $data[]= $receive->asset_id;
            }
        }

        $data_asset = PurchaseRequisitionDetail::where('purchase_req_id',$id)->get();
        $data2 = $data_asset->pluck('asset_id');
        //return $data2;
        $assets = Asset::whereIn('id',$data2)->whereNotIn('id',$data)->get();
        return view('admin.purchase-receive-asset')->with([
            'assets'  => $assets,
            'purchase_req_id' => $id
        ]);

    }

    public function getRemBalance($bgt,$bhd){
        $remaining_amount['remaining_amount'] = VwRemainingBudget::where('budget_type',$bgt)->where('budget_head',$bhd)->first();
        return response()->json($remaining_amount,201);

    }
}
