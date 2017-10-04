<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\VendorContact;
use Illuminate\Http\Request;

class VendorContactController extends Controller
{
    public function index($id){
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor-contacts')->with([
            'vendor'    => $vendor
        ]);
    }

    public function getContact($id){
        $vendor_contact = VendorContact::find($id);
        return response()->json($vendor_contact,201);
    }

    public function getContacts($id){
        $vendor = Vendor::findOrFail($id);
        $vendor_contacts['vendor_contacts'] = $vendor->vendorContacts;
        return response()->json($vendor_contacts,201);
    }

    public function create(Request $request,$id){
        $vendor = Vendor::findOrFail($id);

        VendorContact::create([
            'vendor_id'         => $vendor->id,
            'contact_person'    => $request->input('contact_person'),
            'contact_number'    => $request->input('contact_number'),
            'address'           => $request->input('address'),
        ]);

        return response()->json([
            'message'   => 'Successfully created this contact.'
        ],201);
    }

    public function update(Request $request,$id){
        $vendor_contact = VendorContact::findOrFail($id);
        $vendor_contact->update([
            'contact_person'    => $request->input('contact_person'),
            'contact_number'    => $request->input('contact_number'),
            'address'           => $request->input('address'),
        ]);
        return response()->json([
            'message'   => 'Successfully updated this contact.'
        ],201);
    }

    public function delete($id){
        VendorContact::findOrFail($id)->delete();
        return response()->json([
            'message'   => 'Successfully deleted this contact.'
        ],201);
    }
}
