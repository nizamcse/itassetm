<?php

namespace App\Http\Controllers;

use App\BudgetHead;
use App\Organization;
use App\YearlyBudgetInfo;
use Illuminate\Http\Request;
use Auth;

class BudgetHeadController extends Controller
{
    public function index(){
        return view('admin.budget-head');
    }

    public function create(Request $request){

        $level = $this->getBheadLevel($request->input('parent_id'));

        $budgetHead = BudgetHead::create([
            'name'  => $request->input('name')
        ]);

        $org = Organization::first();

        $budgetHead->fill([
            'parent_id'    => $request->input('parent_id'),
            'bhead_level'  => $level,
            'bhead_org'    => $org->id,
            'created_by'   => Auth::user()->id,
        ])->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this budget head'
        ],200);
    }

    public function delete($id){
        BudgetHead::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this budget head.'
        ],200);
    }

    public function update(Request $request, $id){
        $budgetHead = BudgetHead::findOrFail($id);
        $level = $this->getBheadLevel($request->input('parent_id'));

        $budgetHead->update([
            'name'         => $request->input('name'),
            'parent_id'    => $request->input('parent_id'),
            'bhead_level'  => $level,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this budget head'
        ],200);
    }

    public function getBudgetHeades(){
        $budgetHead['budget_heades'] = BudgetHead::with('parent')->get();

        return response()->json($budgetHead,200);
    }

    public function getBudgetHead($id){
        $budgetHead['budget_head'] = BudgetHead::with('parent')->where('id',$id)->first();
        return response()->json($budgetHead,200);
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

    public function getBheadLevel($id = null){
        $level = 1;
        while($id){
            $budgetHead = BudgetHead::find($id);
            $id = $budgetHead->parent_id;
            $level++;
        }
        return $level;
    }

    public function getBudgetHeadList($id){
        $yearly_budgets = YearlyBudgetInfo::where('budget_type',$id)->get();
        $budget_head_ids = $yearly_budgets->pluck('budget_head');
        $budget_heads = BudgetHead::whereIn('id',$budget_head_ids)->get();
        $options = '<option value="">Select Budget Head</option>';
        foreach ($budget_heads as $budget_head){
            $options .= '<option value="'.$budget_head->id.'">'.$budget_head->name.'</option>';
        }
        return $options;
    }
}
