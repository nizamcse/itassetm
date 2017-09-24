<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('admin.roles')->with([
            'roles' => $roles
        ]);
    }

    public function delete($id){
        Role::findOrFail($id)->delete();
        return redirect()->back();
    }
}
