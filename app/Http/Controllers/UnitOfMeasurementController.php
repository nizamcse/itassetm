<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitOfMeasurementController extends Controller
{
    public function index(){
        return view('admin.unit-of-measurement');
    }
}
