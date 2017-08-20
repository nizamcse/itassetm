<?php

namespace App\Http\Controllers;

use App\Organization;
use App\SubAsset;
use Illuminate\Http\Request;
use Auth;

class SubAssetController extends Controller
{
    public function index(){
        return view('admin.sub-asset');
    }

    public function create(Request $request){

        $subAsset = SubAsset::create([
            'suba_name'  => $request->input('name')
        ]);

        $org = Organization::first();

        $time = strtotime($request->input('suba_retainment_dt'));
        $newformat = date('Y-m-d',$time);

        $subAsset->fill([
            'suba_asset_cd'         => $request->input('suba_asset_cd'),
            'sub_asset_old_code'    => $request->input('sub_asset_old_code'),
            'suba_name'             => $request->input('name'),
            'suba_lifetime'         => $request->input('suba_lifetime'),
            'suba_life_unit'        => $request->input('suba_life_unit'),
            'suba_org'              => $org->id,
            'suba_des'              => $request->input('suba_des'),
            'suba_retainment_dt'    => $newformat,
            'created_by'            => Auth::user()->id,
        ])->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this sub asset'
        ],200);
    }

    public function delete($id){
        SubAsset::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this asset'
        ],200);
    }

    public function getSubAsset($id){
        $sub_asset['sub_asset'] = SubAsset::find($id);
        return response()->json($sub_asset,200);
    }

    public function update(Request $request, $id){
        $sub_asset = SubAsset::findOrFail($id);
        $time = strtotime($request->input('asset_retainment_dt'));
        $newformat = date('Y-m-d',$time);
        $sub_asset->update([
            'suba_asset_cd'         => $request->input('suba_asset_cd'),
            'sub_asset_old_code'    => $request->input('sub_asset_old_code'),
            'suba_name'             => $request->input('name'),
            'suba_lifetime'         => $request->input('suba_lifetime'),
            'suba_life_unit'        => $request->input('suba_life_unit'),
            'suba_des'              => $request->input('suba_des'),
            'suba_retainment_dt'    => $newformat,
            'created_by'            => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this sub asset'
        ],200);
    }

    public function getSubAssets(){
        $sub_assets['sub_assets'] = SubAsset::all();

        return response()->json($sub_assets,200);
    }
}
