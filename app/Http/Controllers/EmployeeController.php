<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function makeActive($id){
        $employee = Employee::findOrFail($id);
        $employee->update([
            'status'    => 1
        ]);
    }

    public function makeInActive($id){
        $employee = Employee::findOrFail($id);
        $employee->update([
            'status'    => 0
        ]);
    }
}
