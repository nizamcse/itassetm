<?php

namespace App\Http\Controllers;

use App\AssetType;
use App\Department;
use App\Employee;
use App\Location;
use App\Manufacturer;
use App\Organization;
use App\Section;
use App\ServiceType;
use App\User;
use App\Vendor;
use Faker\Provider\DateTime;
use Validator;

use Illuminate\Http\Request;
use Auth;

class OrganizationController extends Controller
{
    private $assetType;

    public function __construct()
    {
        $this->assetType = "";
    }

    public function getOrganization(){
        $organization = Organization::first();
        return view('admin.organization')->with([
            'organization'  => $organization
        ]);
    }

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
    public function update(Request $request){

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
        $organization = Organization::first();
        $organization->update([
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
        $rows = array();
        foreach ($request->input('department') as $department){
            $rows = new Department([
                'name'         => $department['name'],
                'created_by'   => Auth::user()->id,
                'org'          => $org->id,
                'reporting_to' => $department['reporting_to'],
            ]);
            $rows->save();

        }
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created'
        ],200);
    }

    public function getDepartments(){
        $departments = Department::with('reporting')->get();
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
            $row = new Section ([
                'name' => $section['name'],
                'created_by' => Auth::user()->id,
                'sec_org' => $org->id,
                'sec_sv' => $section['employee_id'],
            ]);
            $row->save();
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

        foreach ($request->input('location') as $location){
            $location = Location::firstOrNew([
                'name'  => $location['name']
            ]);

            $location->fill(['parent_id' => $location['parent_id']])->save();
        }
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this location'
        ],200);
    }

    /************************* Ajax Request Json Format ************************/

    public function getDepartmentJson(){
        $departments['departments'] = Department::with('reporting')->get();

        //$locations['locations'] = Location::with(['parent'])->get();

        return response()->json($departments,200);

        //return response()->json($locations,200);

    }
    public function getSectionJson($id = null){
        $sections['sections'] = Section::with('superVisor')->get();
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
            'sec_org'           => $org->id,
            'sec_sv'           => $request->input('employee_id'),
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

    public function get_location_tree($parent_id = null,$level = 0)
    {
        $menu = "";
        $location = Location::where('parent_id',$parent_id)->get();
        foreach ($location as $row)
        {

            $menu .= '<option value="'.$row->id.'">';
            for($i=1; $i<=$level; $i++){
                $menu.="-- ";
            }
            $menu.=$row->name.'</option>';

            $child = Location::where('parent_id',$row->id)->get();
            if(count($child) >0){
                $menu .= $this->get_location_tree($row->id,$level+1);
            }

        }

        return $menu;
    }
    public function get_asset_tree($parent_id = null,$level = 0)
    {
        $options = "";
        $assets = AssetType::where('parent_id',$parent_id)->get();
        foreach ($assets as $row)
        {

            $options .= '<option value="'.$row->id.'">';
            for($i=1; $i<=$level; $i++){
                $options.="-- ";
            }
            $options.=$row->name.'</option>';

            $child = AssetType::where('parent_id',$row->id)->get();
            if(count($child) >0){
                $options .= $this->get_asset_tree($row->id,$level+1);
            }

        }

        return $options;
    }

    public function updateLocationJson(Request $request, $id){
        $location = Location::findOrFail($id);
        $location->update([
            'name'  => $request->input('name'),
            'parent_id' => $request->input('parent_id')
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this location'
        ],200);
    }

    public function getDeleteLocationJson($id){
        $location = Location::findOrFail($id);
        $location->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this Section'
        ],200);
    }

    public function getAssetsJson(){
        $assets['assets'] = AssetType::with('parent')->get();
        return response()->json($assets,200);
    }

    public function postAssetsJson(Request $request){

        foreach ($request->input('assets') as $assets){

            AssetType::firstOrCreate([
                'name'  => $assets['name'],
                'parent_id'  => $assets['parent_id']
            ]);
        }
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this asset'
        ],200);

    }

    public function deleteAssetsJson($id){
        AssetType::findOrFail($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this asset'
        ],200);
    }

    public function updateAssetsJson(Request $request, $id){
        $asset = AssetType::findOrFail($id);
        $asset->update([
            'name'          => $request->input('name'),
            'parent_id'     => $request->input('parent_id')
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this asset'
        ],200);
    }


    public function getEmployees(){
        $employees['employees'] = Employee::with('user')->get();
        return response()->json($employees,200);
    }

    public function postEmployeeJson(Request $request){
        $org = Organization::first();
        $time = strtotime($request->input('joining_date'));

        $newformat = date('Y-m-d',$time);
        $employee = Employee::create([
            'employee_code'     => $request->input('employee_code'),
            'dept_id'           => $request->input('employee_dept'),
            'joined_at'         => $newformat,
            'name'              => $request->input('name'),
            'phone'             => $request->input('phone'),
            'email'             => $request->input('email'),
            'designation'       => $request->input('designation'),
            'location'          => $request->input('employee_location'),
            'org'               => $org->id,
            'location_id'        => $request->input('employee_location'),
            'created_by'        => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this employee'
        ],200);
    }

    public function getEmployeeJson($id){
        $employee['employee'] = Employee::find($id);
        return response()->json($employee,200);
    }

    public function deleteEmployeeJson($id){
        Employee::findOrFail($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this employee'
        ],200);
    }

    public function updateEmployeeJson(Request $request, $id){
        $employee = Employee::find($id);

        $time = strtotime($request->input('joining_date'));

        $newformat = date('Y-m-d',$time);
        $employee->update([
            'employee_code'     => $request->input('employee_code'),
            'dept_id'           => $request->input('employee_dept'),
            'joined_at'         => $newformat,
            'name'              => $request->input('name'),
            'phone'             => $request->input('phone'),
            'email'             => $request->input('email'),
            'designation'       => $request->input('designation'),
            'location'          => $request->input('employee_location'),
            'location_id'        => $request->input('employee_location'),
            'created_by'        => Auth::user()->id,
        ]);

        $user = User::where('employee_id',$employee->id)->first();
        $user->update([
            'email' => $employee->email
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this employee'
        ],200);
    }
/*
 * Manufacturer
 */
    public function getManufacturers(){
        $manufacturers['manufacturers'] = Manufacturer::all();
        return response()->json($manufacturers,200);
    }

    public function postManufacturers(Request $request){
        $org = Organization::first();
        foreach ($request->input('manufacturer') as $manufacturer){

            $row = Manufacturer::firstOrNew([
                'name'  => $manufacturer['name']
            ]);

            $row->fill([
                'org'          => $org->id,
                'created_by'   => Auth::user()->id,
            ])->save();
        }
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this manufacturers'
        ],200);
    }

    public function updateManufacturers(Request $request,$id){

        $manufacturer = Manufacturer::findOrFail($id);

        $org = Organization::first();

        $manufacturer->update([
            'name'  => $request->input('name'),
            'org'          => $org->id,
            'created_by'   => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this manufacturers'
        ],200);
    }

    public function deleteManufacturers($id){
        Manufacturer::destroy($id);
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this manufacturers'
        ],200);
    }

    public function getServiceType(){
        $serviceType ['service_type'] = ServiceType::all();

        return response()->json($serviceType,200);
    }

    public function createServiceType(Request $request){
        $org = Organization::first();
        foreach ($request->input('service_type') as $serviceType){

            $row = ServiceType::firstOrNew([
                'name'          => $serviceType['name'],
                'service_type'  => $serviceType['type']
            ]);

            $row->fill([
                'service_org'          => $org->id,
                'created_by'   => Auth::user()->id,
            ])->save();
        }
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created this manufacturers'
        ],200);
    }

    public function deleteServiceType($id){
        ServiceType::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this service'
        ],200);
    }

    public function updateServiceType(Request $request, $id){
        $serviceTYpe = ServiceType::find($id);
        $serviceTYpe->update([
            'name'          => $request->input('name'),
            'service_type'  => $request->input('service_type')
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this service'
        ],200);
    }

    public function createVendor(Request $request){
        $org = Organization::first();

        Vendor::create([
            'name'  => $request->input('name'),
            'address'  => $request->input('address'),
            'contact_person'  => $request->input('contact_person'),
            'contact_no'  => $request->input('contact_no'),
            'web'  => $request->input('web'),
            'trade_no'  => $request->input('trade_no'),
            'vat_no'  => $request->input('vat_no'),
            'company'  => $request->input('company'),
            'email'  => $request->input('email'),
            'comment'  => $request->input('comment'),
            'vendor_type_id'  => $request->input('vendor_type'),
            'org'  => $org->id,
            'created_by'  => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully created vendors'
        ],200);
    }

    public function getVendors(){
        $vendors ['vendors'] = Vendor::all();

        return response()->json($vendors,200);
    }

    public function deleteVendor($id){
        Vendor::find($id)->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully deleted this vendors'
        ],200);
    }

    public function getVendor($id){
        $vendor['vendor'] = Vendor::find($id);
        return response()->json($vendor,200);
    }

    public function updateVendor(Request $request, $id){
        $vendor = Vendor::find($id);
        $org = Organization::first();
        $vendor->update([
            'name'  => $request->input('name'),
            'address'  => $request->input('address'),
            'contact_person'  => $request->input('contact_person'),
            'contact_no'  => $request->input('contact_no'),
            'web'  => $request->input('web'),
            'trade_no'  => $request->input('trade_no'),
            'vat_no'  => $request->input('vat_no'),
            'company'  =>$request->input('company'),
            'email'  =>$request->input('email'),
            'comment'  =>$request->input('comment'),
            'vendor_type_id'  =>$request->input('vendor_type'),
            'org'  => $org->id,
            'created_by'  => Auth::user()->id,
        ]);

        return response()->json([
            'status' => 'ok',
            'message' => 'Successfully updated this vendors'
        ],200);
    }

}
