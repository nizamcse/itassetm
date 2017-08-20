<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetType;
use App\Department;
use App\Employee;
use App\Manufacturer;
use App\Organization;
use App\Section;
use Illuminate\Http\Request;
use Auth;

class AssetController extends Controller
{

    public function index(){
        $assetType = AssetType::all();
        $manufacturers = Manufacturer::all();
        $departments = Department::all();
        $sections = Section::all();

        return view('admin.assets')->with([
            'assets_type'   => $assetType,
            'manufacturers'   => $manufacturers,
            'departments'   => $departments,
            'sections'   => $sections,
        ]);
    }
    public function getAssets(){
       $assets['assets'] = Asset::all();
       return response()->json($assets,200);
    }

    public function createAsset(Request $request){
        $asset = Asset::create([
            'name'  => $request->input('name')
        ]);

        $asset->fill([
            'asset_old_cd' => $request->input(''),
            'name'         => $request->input(''),
            'description'  => $request->input(''),
            'asset_type'   => $request->input(''),
            'asset_manufac'=> $request->input(''),
            'asset_dept'   => $request->input(''),
            'asset_sec'    => $request->input(''),
            'asset_emp'    => $request->input(''),
            'asset_life'   => $request->input(''),
            'asset_life_unit'  => $request->input(''),
            'asset_dep_method' => $request->input(''),
            'asset_retainment_dt'  => $request->input(''),
            'created_by'   => $request->input(''),
            'asset_org'    => $request->input(''),
        ])->save();
    }

    public function employeeAssets($dept = null){

        if($dept) {
            $employees['employees'] = Employee::where('dept_id',$dept)->get();
            return response()->json($employees,200);
        }
        else{
            $employees['employees'] = Employee::all();
            return response()->json($employees,200);
        }

    }

    public function createAssetJson(Request $request){
        $asset = Asset::create([
            'name'  => $request->input('name')
        ]);

        $org = Organization::first();

        $time = strtotime($request->input('asset_retainment_dt'));

        $newformat = date('Y-m-d',$time);

        $asset->fill([
            'asset_old_cd'  => $request->input('asset_old_cd'),
            'description'  => $request->input('description'),
            'asset_type'  => $request->input('asset_type'),
            'asset_manufac'  => $request->input('asset_manufac'),
            'asset_dept'  => $request->input('asset_dept'),
            'asset_sec'  => $request->input('asset_sec'),
            'asset_emp'  => $request->input('asset_emp'),
            'asset_life'  => $request->input('asset_life'),
            'asset_life_unit'  => $request->input('asset_life_unit'),
            'asset_retainment_dt'  => $newformat,
            'created_by'  => Auth::user()->id,
            'asset_org'  => $org->id,
        ])->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this asset'
        ],200);
    }

    public function assetsJson(){
        $assets['assets'] = Asset::with(['assetTypes','departments'])->get();

        return response()->json($assets,200);
    }

    public function deleteAsset($id){
        Asset::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this asset'
        ],200);
    }

    public function getSingleAsset($id){
        $asset['asset'] = Asset::find($id);
        return response()->json($asset,200);
    }

    public function updateAssetJson(Request $request, $id){
        $asset = Asset::findOrFail($id);
        $time = strtotime($request->input('asset_retainment_dt'));
        $newformat = date('Y-m-d',$time);
        $asset->update([
            'name'  => $request->input('name'),
            'asset_old_cd'  => $request->input('asset_old_cd'),
            'description'  => $request->input('description'),
            'asset_type'  => $request->input('asset_type'),
            'asset_manufac'  => $request->input('asset_manufac'),
            'asset_dept'  => $request->input('asset_dept'),
            'asset_sec'  => $request->input('asset_sec'),
            'asset_emp'  => $request->input('asset_emp'),
            'asset_life'  => $request->input('asset_life'),
            'asset_life_unit'  => $request->input('asset_life_unit'),
            'asset_retainment_dt'  => $newformat,
            'created_by'  => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this asset'
        ],200);
    }
}
