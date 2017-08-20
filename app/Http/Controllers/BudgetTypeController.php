<?php

namespace App\Http\Controllers;

use App\BudgetType;
use App\Organization;
use Illuminate\Http\Request;
use Auth;

class BudgetTypeController extends Controller
{
    public function index(){
        return view('admin.budget-type');
    }

    public function create(Request $request){

        $budgetType = BudgetType::create([
            'budget_type_name'  => $request->input('budget_type_name'),
            'budget_type_year'         => $request->input('budget_type_year')
        ]);

        $org = Organization::first();

        $type_info = [
            'budget'    => true,
            'purchase_requisition'  => true
        ];

        $budgetType->fill([
            'budget_type_level_apv' => $request->input('budget_type_level_apv'),
            'budget_org'            => $org->id,
            'type_info'             => $type_info[$request->input('type_info')] ? $request->input('type_info') : '' ,
            'created_by'            => Auth::user()->id,
        ])->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this budget type'
        ],200);
    }

    public function delete($id){
        BudgetType::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this budget type.'
        ],200);
    }


    public function update(Request $request, $id){
        $budgetType = BudgetType::findOrFail($id);
        $type_info = [
            'budget'    => true,
            'purchase_requisition'  => true
        ];
        $budgetType->update([
            'budget_type_name'         => $request->input('budget_type_name'),
            'budget_type_year'         => $request->input('budget_type_year'),
            'budget_type_level_apv'    => $request->input('budget_type_level_apv'),
            'type_info'                 => $type_info[$request->input('type_info')] ? $request->input('type_info') : '' ,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this budget type'
        ],200);
    }

    public function getBudgetTypes(){
        $budgetType['budget_types'] = BudgetType::all();

        return response()->json($budgetType,200);
    }

    public function getBudgetType($id){
        $budgetType['budget_type'] = BudgetType::find($id);
        return response()->json($budgetType,200);
    }
}
