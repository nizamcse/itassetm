<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetLog;
use App\IssueDetail;
use App\Service;
use App\ServiceDetail;
use App\ServiceType;
use App\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(){
        $assets_in_service = Service::whereHas('ServiceDetails', function($query){
            $query->where('status','0');
        })->get();

        return view('admin.in-service')->with([
            'assets_in_service' => $assets_in_service
        ]);
    }

    public function getCreateService(){
        $issued_assets = IssueDetail::with(['asset' => function($query){
            $query->where('status','issued');
        }])->get();
        $service_types = ServiceType::all();
        $vendors = Vendor::all();
        return view('admin.send-to-service')->with([
            'issued_assets'     => $issued_assets,
            'service_types'     => $service_types,
            'vendors'           => $vendors,
        ]);
    }

    public function create(Request $request){
        $service = Service::create([
            'vendor_id'                 => $request->input('vendor'),
            'date'                      => $request->input('date'),
            'vendor_contact_details'    => $request->input('contact'),
            'service_type'              => $request->input('service_type'),
        ]);

        foreach($request->input('asset') as $asset){
            if(!$asset['name']){
                return redirect()->back()->with('message', 'Sorry ! No asset found');
            }
            $curr = ServiceDetail::where('asset_id',$asset['name'])->first();
            if($curr){
                continue;
            }
            $sd = ServiceDetail::create([
                'service_id'            => $service->id,
                'asset_id'              => $asset['name'],
                'problem_description'   => $asset['problem'],
                'sd_remarks'            => $asset['sd_remarks'],
            ]);

            $date = Carbon::today()->format('Y-m-d');

            $asset = Asset::find($asset['name']);
            $asset->update([
                'status'         => 'in-service',
                'status_date'    => $date,
            ]);

            AssetLog::create([
                'asset_id'   => $asset->id,
                'asset_log'  => "This asset sent to service in ".$date." and the service details id is ".$sd->id,
            ]);
        }

        return redirect()->route('in-service');
    }

    public function update(Request $request, $id){}

    public function delete($id){}

    public function serviceDetails($id){
        $service_details = Service::findOrFail($id);
        if(!count($service_details->ExistsServiceDetails)){
            return redirect()->back();
        }
        return view('admin.view-service-details')->with([
            'service_details'   => $service_details
        ]);
    }

    public function receiveFromService($id){
        $service_details = ServiceDetail::findOrFail($id);
        $asset = Asset::find($service_details->asset_id);
        $date = Carbon::today()->format('Y-m-d');
        $asset->update([
            'status'        => 'in-stock',
            'status_date'   => $date,
        ]);
        AssetLog::create([
            'asset_id'   => $asset->id,
            'asset_log'  => "This asset received from service in ".$date,
        ]);
        $service_details->update([
            'status'    => 1
        ]);

        return redirect()->route('in-service');

    }

    public function receiveAllAsset($id){
        $service_details = Service::find($id);
        if($service_details && count($service_details->ServiceDetails)){
            foreach ($service_details->ServiceDetails as $sd){
                $asset = Asset::find($sd->asset_id);
                $date = Carbon::today()->format('Y-m-d');
                $asset->update([
                    'status'        => 'in-stock',
                    'status_date'   => $date,
                ]);
                AssetLog::create([
                    'asset_id'   => $asset->id,
                    'asset_log'  => "This asset received from service in ".$date,
                ]);

                $sdetail = ServiceDetail::find($sd->id);
                $sdetail->update([
                    'status'    => 1
                ]);
            }
        }

        return redirect()->route('in-service');
    }

    public function receivedAssets(){
        $assets = Asset::where('status','in-stock')->get();

        return view('admin.received-from-service')->with([
            'assets'    => $assets
        ]);
    }

    public function receiveSelectedAsset(Request $request){
        foreach ($request->input('asset') as $a){
            $service_details = ServiceDetail::findOrFail($a);
            $asset = Asset::find($service_details->asset_id);
            $date = Carbon::today()->format('Y-m-d');
            $asset->update([
                'status'        => 'in-stock',
                'status_date'   => $date,
            ]);
            AssetLog::create([
                'asset_id'   => $asset->id,
                'asset_log'  => "This asset received from service in ".$date,
            ]);
            $service_details->update([
                'status'    => 1
            ]);
        }

        return redirect()->route('in-service');
    }
}
