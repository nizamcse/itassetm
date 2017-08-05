<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Location;
use App\Organization;
use App\Section;
use Validator;

use Illuminate\Http\Request;
use Auth;

class OrganizationController extends Controller
{
    public function create(Request $request){

        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'address_line_1'  => 'required',
            'city'  => 'required',
            'postal_code'  => 'required|max:4',
            'country'  => 'required',
            'phone'  => 'required',
        ]);

        if($validator->fails()){
            $errors = $validator->errors();
            return view('admin.organization')->with([
                'errors'    => $errors
            ]);
        }

        $organization = Organization::create([
            'name' => $request->input('name'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'address_line_3' => $request->input('address_line_3'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postal_code'),
            'state' => $request->input('state'),
            'country' => $request->input('country'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'fax' => $request->input('fax'),
            'web' => $request->input('web'),
            'photo' => $request->input('photo'),
            'key' => $request->input('key'),
            'created_by' => Auth::user()->id,
        ]);

        return view('admin.organization')->withOrganization($organization);

    }

    public function createDepartment(Request $request){

        //return response()->json($request->input('department'),200);

        $org = Organization::first();

        foreach ($request->input('department') as $department){
            $department = Department::firstOrNew([
                'name' => $department['name']
            ]);

            $department->created_by = Auth::user()->id;
            $department->org =$org->id;
            $department->reporting_to = $department['reporting_to'];
            $department->save();
        }



        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created'
        ],200);
    }

    public function getDepartments(){
        $departments = Department::all();
        return view('admin.department')->with([
            'departments' => $departments
        ]);

    }

    public function getSections(){
        $sections = Section::all();
        $employees = Employee::all();
        return view('admin.sections')->with([
            'sections' => $sections,
            'employees' => $employees
        ]);
    }

    public function createSection(Request $request){
        $org = Organization::first();

        foreach ($request->input('section') as $section){
            $section = Section::firstOrNew([
                'name' => $section['name']
            ]);

            $section->created_by = Auth::user()->id;
            $section->sec_org =$org->id;
            $section->save();
        }



        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created'
        ],200);
    }

    public function getLocations(){
        $locations = Location::all();
        return view('admin.locations')->with([
            'locations' => $locations
        ]);
    }

    public function createLocation(Request $request){
        $location = Location::firstOrNew([
            'name'  => $request->input('name'),
            'parent_id' => $request->input('parent_id')
        ]);

        $location->save();

        return redirect()->back();
    }

    /************************* Ajax Request Json Format ************************/

    public function getDepartmentJson(){
        $departments['departments'] = Department::all();

        //$locations['locations'] = Location::with(['parent'])->get();

        return response()->json($departments,200);

        //return response()->json($locations,200);

    }
    public function getSectionJson(){
        $sections['sections'] = Section::all();
        return response()->json($sections,200);

    }

    public function getDeleteDepartmentJson($id){
        $department = Department::findOrFail($id);
        $department->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this department'
        ],200);
    }

    public function updateDepartmentJson(Request $request, $id){
        $department = Department::findOrFail($id);
        $org = Organization::first();
        $department->update([
            'name'          => $request->input('name'),
            'created_by'    => Auth::user()->id,
            'org'           => $org->id,
            'reporting_to'  => $request->input('reporting_to')
        ]);
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this department'
        ],200);
    }

    public function updateSectionJson(Request $request, $id){
        $section = Section::findOrFail($id);
        $org = Organization::first();
        $section->update([
            'name'          => $request->input('name'),
            'created_by'    => Auth::user()->id,
            'sec_org'           => $org->id
        ]);
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this section'
        ],200);
    }

    public function getDeleteSectionJson($id){
        $section = Section::findOrFail($id);
        $section->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this Section'
        ],200);
    }

    public function getLocationJson(){
        $locations['locations'] = Location::with(['parent'])->get();
        return response()->json($locations,200);
    }
}
