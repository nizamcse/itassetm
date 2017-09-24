<?php

namespace App\Http\Controllers;

use App\SupportDept;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function index(){
        $support_depts = SupportDept::all();
        return view('admin.support-dept')->with([
            'support_depts'    => $support_depts
        ]);
    }

    public function create(Request $request){
        $support_dept = SupportDept::firstOrCreate([
            'name'  => $request->input('name')
        ]);
        return redirect()->back();
    }

    public function update(Request $request,$id){
        $support_dept = SupportDept::find($id);
        $support_dept->update([
            'name'  => $request->input('name')
        ]);
        return redirect()->back();
    }

    public function delete($id){
        SupportDept::findOrFail($id)->delete();
        return redirect()->back();
    }
}
