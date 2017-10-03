<?php

namespace App\Http\Controllers;

use App\BudgetHead;
use App\BudgetType;
use App\Manufacturer;
use App\Organization;
use App\UnitOfMesurement;
use App\User;
use App\Vendor;
use App\YearlyBudgetInfo;
use Illuminate\Http\Request;
use Auth;

class YearlyBudgetController extends Controller
{
    public function index(){
        $units = UnitOfMesurement::all();
        $budget_types = BudgetType::where('status',0)->where('type_info','budget')->get();
        $budget_heads =  $this->get_budget_head_tree();
        $manufacturers = Manufacturer::all();
        $suppliers = Vendor::where('status',1)->get();
        return view('admin.budget-declear')->with([
            'budget_types'  => $budget_types,
            'budget_heads'  => $budget_heads,
            'manufacturers' => $manufacturers,
            'suppliers'     => $suppliers,
            'units'     => $units,
        ]);
    }

    public function createJson(Request $request){
        $yearly_budget = YearlyBudgetInfo::create([
            'budget_particulars' => $request->input('budget_particulars'),
            'usd_amount' => $request->input('usd_amount'),
            'bdt_amount' => $request->input('bdt_amount'),
            'usd_conversion' => $request->input('usd_conversion'),
            'quantity' => $request->input('quantity')
        ]);

        $units = UnitOfMesurement::findOrFail($request->input('unit'));
        $budget_types = BudgetType::findOrFail($request->input('budget_type'));
        $budget_heads = BudgetHead::findOrFail($request->input('budget_head'));
        $manufacturers = Manufacturer::findOrFail($request->input('manufacturer_id'));
        $suppliers = Vendor::findOrFail($request->input('supplier_id'));
        $org = Organization::first();
        $user = User::find(Auth::user()->id);

        $yearly_budget->update([
            'unit' => $units->id,
            'budget_type' => $budget_types->id,
            'budget_head' => $budget_heads->id,
            'manufacturer_id' => $manufacturers->id,
            'supplier_id' => $suppliers->id,
            'org_id' => $org->id,
            'created_by' => $user->id,
        ]);

        return response()->json([
            'status'    => 'ok',
            'message'   => 'Successfully created this budget'
        ],200);
    }

    public function yearlyBudgetsJson(Request $request){
        $yearly_budgets['yearly_budgets'] = YearlyBudgetInfo::with([
            'unit',
            'budgetType',
            'budgetHead',
            'manufacturer',
            'vendor',
        ])->whereDoesntHave('budgetType',function($q){
            $q->where('status','>',0);
        })->get();
        return response()->json($yearly_budgets,200);
    }

    public function yearlyBudgetJson($id){
        $yearly_budget['yearly_budget'] = YearlyBudgetInfo::findOrFail($id);
        return response()->json($yearly_budget,200);
    }

    public function updateJson(Request $request,$id){
        $yearly_budget = YearlyBudgetInfo::findOrFail($id);



        $units = UnitOfMesurement::findOrFail($request->input('unit'));
        $budget_types = BudgetType::findOrFail($request->input('budget_type'));
        $budget_heads = BudgetHead::findOrFail($request->input('budget_head'));
        $manufacturers = Manufacturer::findOrFail($request->input('manufacturer_id'));
        $suppliers = Vendor::findOrFail($request->input('supplier_id'));
        $org = Organization::first();
        $user = User::find(Auth::user()->id);

        $yearly_budget->update([
            'budget_particulars' => $request->input('budget_particulars'),
            'usd_amount' => $request->input('usd_amount'),
            'bdt_amount' => $request->input('bdt_amount'),
            'usd_conversion' => $request->input('usd_conversion'),
            'quantity' => $request->input('quantity'),
            'unit' => $units->id,
            'budget_type' => $budget_types->id,
            'budget_head' => $budget_heads->id,
            'manufacturer_id' => $manufacturers->id,
            'supplier_id' => $suppliers->id,
            'org_id' => $org->id,
            'created_by' => $user->id,
        ]);

        return response()->json([
            'status'    => 'ok',
            'message'   => 'Successfully updated this budget'
        ],200);

    }

    public function deleteJson($id){
        YearlyBudgetInfo::findOrFail($id)->delete();
        return response()->json([
            'status'    => 'ok',
            'message'   => 'Successfully deleted this budget'
        ],200);
    }

    public function get_budget_head_tree($parent_id = null,$level = 0)
    {
        $menu = "";
        $budgetHead = BudgetHead::where('parent_id',$parent_id)->get();
        foreach ($budgetHead as $row)
        {

            $menu .= '<option value="'.$row->id.'" data-level="'.($level+1).'">';
            for($i=1; $i<=$level; $i++){
                $menu.="--";
            }
            $menu.=$row->name.'</option>';

            $child = BudgetHead::where('parent_id',$row->id)->get();
            if(count($child) >0){
                $menu .= $this->get_budget_head_tree($row->id,$level+1);
            }

        }

        return $menu;
    }
}
