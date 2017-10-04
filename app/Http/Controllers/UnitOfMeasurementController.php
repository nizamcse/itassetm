<?php

namespace App\Http\Controllers;

use App\Organization;
use App\UnitOfMesurement;
use Illuminate\Http\Request;
use Auth;

class UnitOfMeasurementController extends Controller
{
    public function index(){
        return view('admin.unit-of-measurement');
    }

    public function getUnit($id){
        $unit['unit'] = UnitOfMesurement::findOrFail($id);

        return response()->json($unit, 200);
    }

    public function jsonUnits(){
        $units_of_measurement['units_of_measurement'] = UnitOfMesurement::all();
        return response()->json($units_of_measurement, 200);
    }

    public function create(Request $request){
        $org = Organization::first();
        $unit = UnitOfMesurement::firstOrCreate([
            'name'  => $request->input('name')
        ]);

        $unit->fill([
            'created_by'    => Auth::user()->id,
            'org_id'    => $org ? $org->id : '',
        ])->save();

        return response()->json([
            'status'    => 'ok',
            'message'   => 'Successfully created this unit.'
        ],201);
    }

    public function update(Request $request, $id){
        $unit = UnitOfMesurement::findOrFail($id);

        $unit->update([
            'name'  => $request->input('name'),
            'created_by'    => Auth::user()->id
        ]);

        return response()->json([
            'status'    => 'ok',
            'message'   => 'Successfully updated this unit.'
        ],200);
    }

    public function delete($id){
        UnitOfMesurement::findOrFail($id)->delete();
        return response()->json([
            'status'    => 'ok',
            'message'   => 'Successfully updated this unit.'
        ],200);
    }
}
