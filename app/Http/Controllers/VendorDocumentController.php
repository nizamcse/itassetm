<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\VendorDocument;
use Illuminate\Http\Request;

class VendorDocumentController extends Controller
{
    public function index($id){
        $vendor = Vendor::findOrFail($id);
        return view('admin.vendor-documents')->with([
            'vendor'    => $vendor
        ]);
    }

    public function getDocuments($id){
        $vendor = Vendor::findOrFail($id);
        $vendor_documents['vendor_documents'] = $vendor->VendorDocuments;
        return response()->json($vendor_documents,201);
    }

    public function create(Request $request, $id){

        $vendor = Vendor::findOrFail($id);
        if($request->file('document')){
            $photoName = time().'.'.$request->document->getClientOriginalExtension();
            $request->document->move(public_path('documents/vendor'), $photoName);
            VendorDocument::create([
                'title'     => $request->input('title'),
                'document'  => $photoName,
                'vendor_id' => $vendor->id,
            ]);

            return redirect()->back();
        }

    }

    public function delete(Request $request, $id){

        VendorDocument::findOrFail($id)->delete();

        return response()->json([
            'message'   => 'Successfully deleted this document.'
        ],201);

    }
}
