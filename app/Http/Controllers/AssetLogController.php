<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetLog;
use Illuminate\Http\Request;

class AssetLogController extends Controller
{
    public function index(){
        $asset_logs =  AssetLog::all();

        return view('admin.asset-log')->with([
            'asset_logs'    => $asset_logs
        ]);
    }

    public function assetLog($id){
        $asset = Asset::findOrFail($id);
        $asset_logs =  $asset->assetLog;

        return view('admin.asset-log')->with([
            'asset_logs'    => $asset_logs
        ]);
    }

    public function delete($id){
        $log = AssetLog::findOrFail($id);
        $log->delete();

        return redirect()->back();
    }
}
