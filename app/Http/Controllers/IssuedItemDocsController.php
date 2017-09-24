<?php

namespace App\Http\Controllers;

use App\Asset;
use App\IssueDetail;
use App\IssuedItemDoc;
use Illuminate\Http\Request;

class IssuedItemDocsController extends Controller
{
    public function index(){


        $issue_details_assets = IssueDetail::has('asset')
            ->whereDoesntHave('IssuedItemDoc')->get();

        return view('admin.create-issued-item-docs')->with([
            'issue_details_assets'    => $issue_details_assets
        ]);
    }

    public function create(Request $request){
        $issued_item_doc = IssuedItemDoc::create([
            'issued_item_id' => $request->input('issued_item_id'),
            'docs' => $request->input('docs')
        ]);

        if($request->file('document')){
            $photoName = time().'.'.$request->document->getClientOriginalExtension();
            $request->document->move(public_path('documents'), $photoName);
            $issued_item_doc->document = $photoName;
            $issued_item_doc->save();
        }

        return redirect()->back();
    }

    public function viewDoc($id){
        $issued_item_doc = IssuedItemDoc::find($id);
        return $issued_item_doc;
    }
}
