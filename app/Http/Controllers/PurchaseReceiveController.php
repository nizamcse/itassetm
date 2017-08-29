<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseReceiveController extends Controller
{
    public function index(){
        return view('admin.purchase-receive');
    }
}
