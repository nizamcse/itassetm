<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\VendorContact;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(){
        $vendors = Vendor::all();
        return $vendors;
    }

    public function vendor($id){
        $vendor = Vendor::findOrFail($id);
        return $vendor;
    }

    public function removeContact($id){
        VendorContact::findOrFail($id)->delete();
        return response()->json([
            'message'   => 'Successfully deleted this contact'
        ],200);
    }

    public function addContact(Request $request, $id){
        $vendor = Vendor::findOrFail($id);
        VendorContact::create([
            'vendor_id' => $vendor->id,
            'contact_person' => $request->input('contact_person'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
        ]);

        return response()->json([
            'message'   => 'Successfully created this contact'
        ],200);
    }

    public function updateContact(Request $request, $id){
        $vendor = Vendor::findOrFail($id);

        $vendor_contact = VendorContact::where('vendor_id',$vendor->id)->first();

        $vendor_contact->update([
            'contact_person' => $request->input('contact_person'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
        ]);

        return response()->json([
            'message'   => 'Successfully created this contact'
        ],200);
    }

    public function enable($id){
        $vendor = Vendor::findOrFail($id);
        $vendor->update([
            'status'    => 1
        ]);
        return response()->json([
            'message'   => 'Successfully enabled this vendor.'
        ],200);
    }

    public function disable($id){
        $vendor = Vendor::findOrFail($id);
        $vendor->update([
            'status'    => 0
        ]);
        return response()->json([
            'message'   => 'Successfully disabled this vendor.'
        ],200);
    }
}
