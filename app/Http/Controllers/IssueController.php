<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Department;
use App\Employee;
use App\Issue;
use App\IssueDetail;
use App\VwIssueDetail;
use Illuminate\Http\Request;
use Auth;

class IssueController extends Controller
{
    public function index(){
        $vw_issue_details = VwIssueDetail::all();
        $ids = [];

        foreach($vw_issue_details as $vw_issue_detail){
            if($vw_issue_detail->received_qty == $vw_issue_detail->issued_qty){
                $ids[] = $vw_issue_detail->asset_id;
            }
        }

        $assets = Asset::whereHas('receiveDetails',function($query){
            $query->whereHas('receive',function($q){
                $q->whereHas('purchaseRequisition',function($q3){
                    $q3->where('status',3);
                });
            });
        })->whereNotIn('id',$ids)->get();

        $departments = Department::all();
        $employees = Employee::all();

        return view('admin.issue-received-asset')->with([
            'assets'    => $assets,
            'departments'    => $departments,
            'employees'    => $employees,
        ]);
    }

    public function create(Request $request){
        if(count($request->input('asset')) && $request->input('date')){
            $issue = Issue::create([
                'date'  => $request->input('date'),
                'particulars'   => $request->input('particulars'),
                'created_by'    => Auth::user()->id
            ]);

            foreach($request->input('asset') as $issue_asset){
                if($issue_asset['name']){
                    $asset = Asset::find($issue_asset['name']);
                    $employee = Employee::find($issue_asset['employee']);
                    IssueDetail::create([
                        'issue_id'  => $issue->id,
                        'asset_id'  => $asset->id,
                        'quantity'  => $issue_asset['quantity'],
                        'particulars'   => $issue_asset['particulars'],
                        'reqn_number'   => $asset->receiveDetails->receive->purchaseRequisition->id,
                        'dept_id'   => $issue_asset['dept'],
                        'location_id'   => $employee->location,
                        'employee_id' => $issue_asset['employee'],
                        'created_by'    => Auth::user()->id,
                    ]);
                }
            }

        }

        return redirect()->back();
    }

    public function issuedItems(){
        $issued_assets = IssueDetail::with(['asset' => function($query){
            $query->where('status','issued');
        }])->get();
        return view('admin.issued-item-list')->with([
            'issued_assets' => $issued_assets
        ]);
    }
}
