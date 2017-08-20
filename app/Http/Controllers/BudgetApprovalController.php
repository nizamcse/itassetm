<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BudgetApprovalController extends Controller
{
    public function index(){
        return view('admin.budget-approval');
    }
}
