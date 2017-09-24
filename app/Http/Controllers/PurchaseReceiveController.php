<?php

namespace App\Http\Controllers;

use App\Asset;
use App\BudgetType;
use App\PurchaseRequisition;
use App\PurchaseRequisitionDetail;
use App\Receive;
use Illuminate\Http\Request;

class PurchaseReceiveController extends Controller
{
    public function index(){
        $data_pr_req = array();

        $prs = PurchaseRequisition::all();

        foreach ($prs as $pr){
            $receives = Receive::where('purchase_req_id',$pr->id)->first();
            $contain_assets = $pr->purchaseRequisitionDetails->pluck('asset_id');
            if(count($receives))
            {
                $data = $receives->receiveDetails->pluck('asset_id');
            }
            else{
                $data = [];
            }
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
        $receives = Receive::where('purchase_req_id',$id)->first();
        $purchase_requisitions = PurchaseRequisition::find($id);
        $contain_assets = $purchase_requisitions->purchaseRequisitionDetails->pluck('asset_id');
        $data = $receives->receiveDetails->pluck('asset_id');
        $asset = Asset::whereNotIn('id',$data)->whereIn('id',$contain_assets)->get();
        return $asset;
    }
}
