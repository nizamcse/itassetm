<?php

namespace App\Http\Controllers;

use App\VendorType;
use Illuminate\Http\Request;

class VendorTypeController extends Controller
{
    public function index(){
        return view('admin.vendor-type');
    }

    public function create(Request $request){
        VendorType::create([
            'name'  => $request->input('name')
        ]);

        return response()->json([
            'message'   => 'Successfully created this vendor type'
        ],200);
    }

    public function getVendorTypes(){
        $vendor_types = VendorType::all();

        return response()->json([
            'vendor_types'  => $vendor_types
        ],201);
    }

    public function getVendorType($id){
        $vendor_type['vendor_type'] = VendorType::find($id);
        return response()->json($vendor_type,201);
    }

    public function updateVendorType(Request $request,$id){
        $vendor_type = VendorType::find($id);
        $vendor_type->update([
            'name'  => $request->input('name')
        ]);

        return response()->json([
            'message'   => 'Successfully updated this vendor type'
        ],200);
    }

    public function deleteVendorType(Request $request,$id){
        $vendor_type = VendorType::find($id);
        $vendor_type->delete();

        return response()->json([
            'message'   => 'Successfully deleted this vendor type'
        ],200);
    }

}
