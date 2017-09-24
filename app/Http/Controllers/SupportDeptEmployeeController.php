<?php

namespace App\Http\Controllers;

use App\SupportDept;
use App\User;
use Illuminate\Http\Request;

class SupportDeptEmployeeController extends Controller
{
    public function index(){
        $dept_employees = SupportDept::with('users')->get();
        return view('admin.support-department-employee')->with([
            'dept_employees'   => $dept_employees
        ]);
    }

    public function create(Request $request){
        $user = User::find($request->input('user'));
        //$dept = SupportDept::find($request->input('department'));
        $user->supportDepartments()->attach($request->input('department'));
        return redirect()->back();
    }

    public function remove($id,$user_id){
        $dept = SupportDept::find($id);
        $dept->users()->detach($user_id);
        return redirect()->back();
    }

    public function getRemainingUser($id){
        $users = User::whereDoesntHave('supportDepartments', function ($q) use($id){
            $q->where('support_dept_id', $id);
        })->get();

        $option = '<option value=""> - Select User </option>';
        foreach ($users as $user){
            $option .= '<option value="'.$user->id.'">'.$user->name.'</option>';
        }
        return $option;
    }
}
