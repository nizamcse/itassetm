<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseReceiveDetailsController extends Controller
{
    public function index(){
        return view('admin.purchase-receive-details');
    }
}
