<?php

namespace App\Http\Controllers;

use App\BudgetType;
use App\BudgetTypeApproval;
use App\Employee;
use App\PurchaseRequisition;
use App\PurchaseRequisitionDetail;
use App\YearlyBudgetInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Mail;
use App\Mail\verifyEmail;
use Illuminate\Support\Facades\Validator;
use Auth;

class UserController extends Controller
{
    public function createUser($id){
        $employee = Employee::find($id);

        $user = User::create([
            'name'          => $employee->name,
            'email'         => $employee->email,
            'password'      => bcrypt('123456'),
            'user_type'     => 'employee',
            'email_token'   => str_random(40),
            'employee_id'   => $employee->id,
        ]);

        $this->sendMail($user);

        return redirect()->back();
    }

    public function resendEmail($id){
        $employee = Employee::find($id);
        $user = User::where('employee_id',$employee->id)->first();

        $user->update([
            'email_token'   => str_random(40),
        ]);

        $this->sendMail($user);
        return redirect()->back();
    }

    public function sendMail($user){
        Mail::to($user->email)->send(new verifyEmail($user));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => 'required|string|min:6',
        ]);
    }

    public function confirmUserRegistration(Request $request,$id,$token){
        $user = User::where('id',$id)
                ->where('email_token',$token)->first();
        $this->validator($request->all())->validate();

        $user->update([
            'email_token'   => '',
            'is_active'   => true,
            'password'  => bcrypt($request->input('password'))
        ]);

        return redirect()->route('login');
    }


    public function getUsers(){
        $users = User::all();

        return response()->json($users,200);
    }

    public function getMyBudgetApproval(){
        $employee = Employee::find(Auth::user()->employee_id);
        $id = $employee->id;

        $budget_types = BudgetType::with(['employees' => function($q) use($id){
                $q->where('employee_id', $id);
            }])
            ->where('type_info','budget')->get();

        return view('admin.my-approval')->with([
            'budget_types' => $budget_types
        ]);
    }

    public function getMyPurchaseReqApproval(){
        $employee = Employee::find(Auth::user()->employee_id);
        $id = $employee->id;

        $budget_types = BudgetType::with(['employees' => function($q) use($id){
            $q->where('employee_id', $id);
        }])
            ->where('type_info','purchase_requisition')->get();

        return view('admin.my-approval')->with([
            'budget_types' => $budget_types
        ]);
    }

    public function getMyBudgetApproved($id){
        $employee = Employee::find(Auth::user()->employee_id);
        $budget_types = BudgetType::find($id);

        $budget_types->employeesApproved()->attach($employee->id);

        if(count($budget_types->employeesApproved) == $budget_types->budget_type_level_apv){
            $budget_types->status = 3;
            $budget_types->save();
        }
        else{
            $budget_types->status = 2;
            $budget_types->save();
        }

        return redirect()->back();
    }


    public function getMyBudgetApprovalDetails($id){
        $budget_type = BudgetType::find($id);
        if(!$budget_type->employees->contains(Auth::user()->employee_id)){
            return redirect()->back();
        }

        $my_order = $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order;

        $approved_employees_upper_order = Employee::whereHas('budgetTypes', function($q) use($my_order,$id) {
            $q->where('employee_order','>',$my_order)->where('budget_type',$id);
        })->get()->pluck('id');

        $yearly_budget_infos = YearlyBudgetInfo::where('budget_type',$budget_type->id)->get();
        $yearly_budget_infos_usd_amount = YearlyBudgetInfo::where('budget_type',$budget_type->id)->get()->pluck('usd_amount')->sum();
        $yearly_budget_infos_bdt_amount = YearlyBudgetInfo::where('budget_type',$budget_type->id)->get()->pluck('bdt_amount')->sum();
        return view('admin.my-budget-approval-list')->with([
            'details_data' => $yearly_budget_infos,
            'budget_types' => $budget_type,
            'approved_employees_upper_order' => $approved_employees_upper_order,
            'usd'   => $yearly_budget_infos_usd_amount,
            'bdt'   => $yearly_budget_infos_bdt_amount
        ]);
    }

    public function cancelMyBudgetApproval($id){
        $budget_type = BudgetType::find($id);
        if(!$budget_type->employees->contains(Auth::user()->employee_id)){
            return redirect()->back();
        }
        if(
            $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_type->employeesApproved) ||
            $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_type->employeesApproved)+1
        ){
            BudgetTypeApproval::where('budget_type_id',$budget_type->id)->delete();
            $budget_type->status = 0;
            $budget_type->save();

            return redirect()->back();
        }
        return redirect()->back();
    }

    public function budgetModification(Request $request,$id,$yearly_budget){

        $budget_type = BudgetType::find($id);
        if(!$budget_type->employees->contains(Auth::user()->employee_id)){
            return redirect()->back();
        }

        if($budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_type->employeesApproved) || $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order == count($budget_type->employeesApproved)+1){
            if($budget_type->type_info == 'budget'){
                $yearly_budget_info = YearlyBudgetInfo::find($yearly_budget);
                $yearly_budget_info->update([
                    'comment'   => $request->input('comment')
                ]);
            }
            elseif ($budget_type->type_info == 'purchase_requisition'){
                $purchase_requisitions = PurchaseRequisitionDetail::find($yearly_budget);
                $purchase_requisitions->update([
                    'comment'   => $request->input('comment')
                ]);
            }
        }

        return redirect()->back();
    }

    public function reApproveModification($id){
        $budget_type = BudgetType::find($id);
        if(!$budget_type->employees->contains(Auth::user()->employee_id)){
            return redirect()->back();
        }

        $update_row = $budget_type->employeesApproved->find(Auth::user()->employee_id);
        $update_row->pivot->status = 'Approved';
        $update_row->pivot->comment = '';
        $update_row->pivot->save();

        return redirect()->back();
    }

    public function getMyBudgetReqApprovalDetails($id){
        $budget_type = BudgetType::find($id);
        if(!$budget_type->employees->contains(Auth::user()->employee_id)){
            return redirect()->back();
        }
        $my_order = $budget_type->employees->find(Auth::user()->employee_id)->pivot->employee_order;

        $purchase_requisitions = PurchaseRequisition::where('budget_type' ,$id)->get();
        $total_approximate_price = PurchaseRequisitionDetail::whereHas('purchaseRequisition',function($q) use($id){
            $q->where('budget_type',$id);
        })->get()->pluck('approx_price')->sum();
        return view('admin.my-purchase-approval-list')->with([
            'purchase_requisitions' => $purchase_requisitions,
            'budget_types' => $budget_type,
            'total_approximate_price'   => $total_approximate_price,
        ]);
    }



    /*
     * Send Approval Request
     */

    public function sendApprovalRequest(){
        $budget_types = BudgetType::where('status',0)->get();
        return view('admin.send-for-approval')->with([
            'budget_types'  => $budget_types
        ]);
    }

    public function sendToApprove($id){
        $budget_type = BudgetType::find($id);
        $budget_type->update([
            'status'    => 1
        ]);

        if($budget_type->type_info == 'budget'){
            $yearly_budgets = YearlyBudgetInfo::where('budget_type' ,$budget_type->id)
                ->whereNotNull('comment')->get();
            foreach ($yearly_budgets as $yearly_budget){
                $yearly_budget->comment = '';
                $yearly_budget->save();
            }
        }
        elseif ($budget_type->type_info == 'purchase_requisition'){
            $purchase_requisitions = PurchaseRequisition::where('budget_type' ,$budget_type->id)->get();
            foreach ($purchase_requisitions as $purchase_requisition){
                $purchase_req_details = PurchaseRequisitionDetail::where('purchase_req_id' ,$purchase_requisition->id)
                    ->whereNotNull('comment')->get();
                foreach ($purchase_req_details as $purchase_req_detail){
                    $purchase_req_detail->comment = '';
                    $purchase_req_detail->save();
                }
            }
        }
        return redirect()->back();
    }
}
