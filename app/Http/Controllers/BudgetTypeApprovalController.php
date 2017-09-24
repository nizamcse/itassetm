<?php

namespace App\Http\Controllers;

use App\BudgetType;
use App\BudgetTypeApprovalEmployee;
use App\Employee;
use App\Organization;
use Illuminate\Http\Request;
use Auth;

class BudgetTypeApprovalController extends Controller
{
    public function index(){
        $budget_types = BudgetType::all();
        return view('admin.budget-type-approval')->with([
            'budget_types'  => $budget_types
        ]);
    }

    public function approvalEmployee($id){
        $budget_types = BudgetType::find($id);
        $employees = Employee::whereDoesntHave('budgetTypeApproval', function($query) use($id){
            $query->where('budget_type',$id);
        })->get();

        $data = [
            'level'     => $budget_types->budget_type_level_apv,
            'employee'  => $budget_types->approvalEmployee->count(),
            'employees'  => $employees,
            'tm' => $budget_types->approvalEmployee
        ];

        return response()->json($data,200);
    }

    public function createBudgetTypeApproval(Request $request, $id){
        $budget_types = BudgetType::find($id);
        $ord = Organization::first();

        foreach ($request->input('budget_type_app_emp') as $budget_type_app_emp)
        {

            $approvalEmplyeeExistingLevel =  BudgetTypeApprovalEmployee::where('budget_type',$id)
                                                ->where('employee_order',$budget_type_app_emp['level'])
                                                ->get();


            if(count($approvalEmplyeeExistingLevel) > 0){
                return response()->json([
                    'status'    => false,
                    'message'   => 'Sorry! You can not assign same level for multiple employee',
                    'id'        => $id
                ],200);
            }

            $approvalEmplyeeExist =  BudgetTypeApprovalEmployee::where('budget_type',$id)
                ->where('employee_id',$budget_type_app_emp['employee_id'])
                ->get();
            if(count($approvalEmplyeeExist) > 0){
                return response()->json([
                    'status'    => false,
                    'message'   => 'Sorry! You can not assign same employee multiple time',
                    'id'        => $id
                ],200);
            }

            $currentApprovalEmployee = BudgetTypeApprovalEmployee::where('budget_type',$id)->get();
            if($budget_types->budget_type_level_apv > count($currentApprovalEmployee)){
                BudgetTypeApprovalEmployee::create([
                    'budget_type'   => $budget_types->id,
                    'employee_id'   => $budget_type_app_emp['employee_id'],
                    'employee_order'=> $budget_type_app_emp['level'],
                    'budget_org'    => $ord->id,
                    'created_by'    => Auth::user()->id,
                ]);
                return response()->json([
                    'status'    => 'ok',
                    'message'   => 'Successfully Assigned Employee',
                    'id'        => $id
                ],200);
            }

            return response()->json([
                'status'    => false,
                'message'   => 'Sorry! You have reach the employee assign limit for this budget type',
                'id'        => $id
            ],200);



        }
    }

    public function getBudgetTypeApproval($id){
        $budget_types_employees['budget_types_employee'] = BudgetTypeApprovalEmployee::with(['employee'])
            ->where('budget_type',$id)
            ->orderBy('employee_order','asc')
            ->get();

        return response()->json($budget_types_employees,200);
    }

    function updateBudgetTypeApproval(Request $request, $id){

        $budget_type_approval_employee = BudgetTypeApprovalEmployee::find($id);

        $order_repeat = BudgetTypeApprovalEmployee::where('budget_type',$budget_type_approval_employee->budget_type)
            ->where('employee_order',$request->input('level'))
            ->get();

        if(count($order_repeat)){
            return response()->json([
                'status'    => false,
                'message'   => 'Sorry! You can not assign same level for multiple employee',
                'id'        => $id
            ],200);
        }

        $budget_type_approval_employee->update([
            'employee_id'       => $request->input('employee_id'),
            'employee_order'    => $request->input('level'),
            'created_by'        => Auth::user()->id
        ]);

        return response()->json([
            'status'    => 'ok',
            'message'   => 'Successfully updated Assigned Employee',
            'id'        => $budget_type_approval_employee->budget_type
        ],200);

    }

    public function removeEmployee($id){
        BudgetTypeApprovalEmployee::find($id)->delete();
        return response()->json([
            'status'    => 'ok',
            'message'   => 'Successfully deleted Assigned Employee'
        ],200);
    }

}
