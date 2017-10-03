<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/',function (){
        return view('welcome');
    })->name('default');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware' => 'auth'],function () {

    Route::get('/',[
        'uses'  => 'OrganizationController@getOrganization',
        'as'    => 'admin.departments'
    ]);
    Route::get('/organizations',[
        'uses'  => 'OrganizationController@getOrganization',
        'as'    => 'admin.organizations'
    ]);

    Route::post('/update-organization',[
        'uses'  => 'OrganizationController@update',
        'as'    => 'update-organization'
    ]);

    Route::get('departments', [
        'uses'  => 'OrganizationController@getDepartments',
        'as'    => 'admin.departments'
    ]);

    Route::get('sections', [
        'uses'  => 'OrganizationController@getSections',
        'as'    => 'admin.sections'
    ]);

    Route::get('employees', function () {
        return view('admin.employees');
    })->name('admin.employees');

    Route::get('locations',[
        'uses'  => 'OrganizationController@getLocations',
        'as'    => 'admin.locations'
    ]);

    Route::get('asset-types', function () {
        $assetTypes =  \App\AssetType::all();
        return view('admin.asset-types')->with(['assetTypes' => $assetTypes]);
    })->name('admin.asset-types');

    /*
     * Vendor
     */

    Route::get('vendors', function () {
        $vendor_types = \App\VendorType::all();
        return view('admin.vendors')->with([
            'vendor_types' => $vendor_types
        ]);
    })->name('admin.vendors');

    Route::get('services-type', function () {
        return view('admin.services-type');
    })->name('admin.services-type');

    Route::get('manufacturers', function () {
        return view('admin.manufacturers');
    })->name('admin.manufacturers');


    Route::post('/organization',[
        'uses'  => 'OrganizationController@create',
        'as'    => 'post.organization'
    ]);

    Route::post('/department', [
        'uses'  => 'OrganizationController@createDepartment',
        'as'    => 'post.department'
    ]);
    Route::post('/section', [
        'uses'  => 'OrganizationController@createSection',
        'as'    => 'post.section'
    ]);
    Route::post('/location', [
        'uses'  => 'OrganizationController@createLocation',
        'as'    => 'post.location'
    ]);

    Route::get('/enable-vendor/{id?}', [
        'uses'  => 'VendorController@enable',
        'as'    => 'enable-vendor'
    ]);

    Route::get('/disable-vendor/{id?}', [
        'uses'  => 'VendorController@disable',
        'as'    => 'disable-vendor'
    ]);


    /*
     * Vendor Type
     */

    Route::get('/vendor-type', [
        'uses'  => 'VendorTypeController@index',
        'as'    => 'vendor-type'
    ]);

    Route::post('/vendor-type', [
        'uses'  => 'VendorTypeController@create',
        'as'    => 'vendor-type'
    ]);

    Route::get('/get-vendor-types', [
        'uses'  => 'VendorTypeController@getVendorTypes',
        'as'    => 'get-vendor-types'
    ]);

    Route::get('/get-vendor-type/{id?}', [
        'uses'  => 'VendorTypeController@getVendorType',
        'as'    => 'get-vendor-type'
    ]);

    Route::post('/update-vendor-type/{id?}', [
        'uses'  => 'VendorTypeController@updateVendorType',
        'as'    => 'update-vendor-type'
    ]);

    Route::get('/delete-vendor-type/{id?}', [
        'uses'  => 'VendorTypeController@deleteVendorType',
        'as'    => 'delete-vendor-type'
    ]);

    /*
     * Vendor Contact
     */
    Route::get('/vendor-contacts/{id?}', [
        'uses'  => 'VendorContactController@index',
        'as'    => 'vendor-contacts'
    ]);

    Route::get('/vendor-contact/{id?}', [
        'uses'  => 'VendorContactController@getContact',
        'as'    => 'vendor-contact'
    ]);

    Route::get('/vendor-contacts-json/{id?}', [
        'uses'  => 'VendorContactController@getContacts',
        'as'    => 'vendor-contacts-json'
    ]);

    Route::post('/vendor-contact/{id?}', [
        'uses'  => 'VendorContactController@create',
        'as'    => 'vendor-contact'
    ]);

    Route::post('/update-vendor-contact/{id?}', [
        'uses'  => 'VendorContactController@update',
        'as'    => 'update-vendor-contact'
    ]);

    Route::get('/delete-vendor-contact/{id?}', [
        'uses'  => 'VendorContactController@delete',
        'as'    => 'delete-vendor-contact'
    ]);

    /*
     * Vendor Document
     */
    Route::get('/vendor-documents/{id?}', [
        'uses'  => 'VendorDocumentController@index',
        'as'    => 'vendor-documents'
    ]);


    Route::get('/vendor-documents-json/{id?}', [
        'uses'  => 'VendorDocumentController@getDocuments',
        'as'    => 'vendor-documents-json'
    ]);

    Route::post('/vendor-document/{id?}', [
        'uses'  => 'VendorDocumentController@create',
        'as'    => 'vendor-document'
    ]);


    Route::get('/delete-vendor-document/{id?}', [
        'uses'  => 'VendorDocumentController@delete',
        'as'    => 'delete-vendor-document'
    ]);

    /********************  All Ajax Request *****************/

    Route::get('/json/department',[
        'uses'  => 'OrganizationController@getDepartmentJson',
        'as'    => 'json-department'
    ]);
    Route::get('/json/section/{id?}',[
        'uses'  => 'OrganizationController@getSectionJson',
        'as'    => 'json-section'
    ]);
    Route::get('/json/location',[
        'uses'  => 'OrganizationController@getLocationJson',
        'as'    => 'json-location'
    ]);

    Route::get('/json/assets',[
        'uses'  => 'OrganizationController@getAssetsJson',
        'as'    => 'json-assets'
    ]);


    Route::get('/json/department/delete/{id?}',[
        'uses'  => 'OrganizationController@getDeleteDepartmentJson',
        'as'    => 'json-delete-department'
    ]);

    Route::post('/json/department/update/{id?}',[
        'uses'  => 'OrganizationController@updateDepartmentJson',
        'as'    => 'json-update-department'
    ]);

    Route::post('/json/section/update/{id?}',[
        'uses'  => 'OrganizationController@updateSectionJson',
        'as'    => 'json-update-section'
    ]);

    Route::get('/json/section/delete/{id?}',[
        'uses'  => 'OrganizationController@getDeleteSectionJson',
        'as'    => 'json-delete-section'
    ]);

    Route::post('/json/location/update/{id?}',[
        'uses'  => 'OrganizationController@updateLocationJson',
        'as'    => 'json-update-location'
    ]);

    Route::get('/json/location/delete/{id?}',[
        'uses'  => 'OrganizationController@getDeleteLocationJson',
        'as'    => 'json-delete-location'
    ]);

    Route::post('/json/assets',[
        'uses'  => 'OrganizationController@postAssetsJson',
        'as'    => 'post.assets'
    ]);

    Route::get('/json/assets/delete/{id?}',[
        'uses'  => 'OrganizationController@deleteAssetsJson',
        'as'    => 'json-delete-asset'
    ]);

    Route::post('/json/assets/update/{id?}',[
        'uses'  => 'OrganizationController@updateAssetsJson',
        'as'    => 'json-update-asset'
    ]);

    Route::get('/json/employees',[
        'uses'  => 'OrganizationController@getEmployees',
        'as'    => 'json-employees'
    ]);

    Route::post('/json/employee',[
        'uses'  => 'OrganizationController@postEmployeeJson',
        'as'    => 'post.employee'
    ]);

    Route::get('/json/employee/{id?}',[
        'uses'  => 'OrganizationController@getEmployeeJson',
        'as'    => 'json-employee'
    ]);

    Route::post('/json/update/employee/{id?}',[
        'uses'  => 'OrganizationController@updateEmployeeJson',
        'as'    => 'post.json-employee'
    ]);

    Route::get('/json/employee/delete/{id?}',[
        'uses'  => 'OrganizationController@deleteEmployeeJson',
        'as'    => 'json-delete-employee'
    ]);

    Route::get('/active-employee/{id?}',[
        'uses'  => 'EmployeeController@makeActive',
        'as'    => 'active-employee'
    ]);

    Route::get('/inactive-employee/{id?}',[
        'uses'  => 'EmployeeController@makeInActive',
        'as'    => 'inactive-employee'
    ]);

    Route::get('/location-tree',[
        'uses'  => 'OrganizationController@get_location_tree',
        'as'    => 'location-tree'
    ]);

    Route::get('/asset-tree',[
        'uses'  => 'OrganizationController@get_asset_tree',
        'as'    => 'asset-tree'
    ]);

/*
 * Manufacturer
 */
    Route::get('/json-Manufacturer',[
        'uses'  => 'OrganizationController@getManufacturers',
        'as'    => 'json-manufacturer'
    ]);

    Route::post('/json-manufacturer',[
        'uses'  => 'OrganizationController@postManufacturers',
        'as'    => 'post.json-manufacturer'
    ]);

    Route::post('/json-manufacturer/{id?}',[
        'uses'  => 'OrganizationController@updateManufacturers',
        'as'    => 'json-update-manufacturer'
    ]);

    Route::get('/json-delete-manufacturer/{id?}',[
        'uses'  => 'OrganizationController@deleteManufacturers',
        'as'    => 'json-delete-manufacturer'
    ]);

    Route::get('json-service-type',[
        'uses'  => 'OrganizationController@getServiceType',
        'as'    => 'json-service-type'
    ]);

    Route::post('/json-service-type/',[
        'uses'  => 'OrganizationController@createServiceType',
        'as'    => 'post.service-type'
    ]);

    Route::post('json-update-service-type/{id?}',[
        'uses'  => 'OrganizationController@updateServiceType',
        'as'    => 'json-update-service-type'
    ]);

    Route::get('json-delete-service-type/{id?}',[
        'uses'  => 'OrganizationController@deleteServiceType',
        'as'    => 'json-delete-service-type'
    ]);

    Route::get('/json-vendors',[
        'uses'  => 'OrganizationController@getVendors',
        'as'    => 'json-vendors'
    ]);

    Route::post('/vendor',[
        'uses'  => 'OrganizationController@createVendor',
        'as'    => 'post.vendor'
    ]);

    Route::get('/json-delete-vendors/{id?}',[
        'uses'  => 'OrganizationController@deleteVendor',
        'as'    =>'json-delete-vendors'
    ]);

    Route::get('/json-vendor/{id?}',[
        'uses'  => 'OrganizationController@getVendor',
        'as'    => 'json-vendor'
    ]);

    Route::post('/update-vendor/{id?}',[
        'uses'  => 'OrganizationController@updateVendor',
        'as'    => 'update-vendor'
    ]);

    Route::get('assets',[
        'uses'  => 'AssetController@index',
        'as'    => 'assets'
    ]);

    Route::get('assets-json',[
        'uses'  => 'AssetController@assetsJson',
        'as'    => 'assets-json'
    ]);

    Route::post('assets-json',[
        'uses'  => 'AssetController@createAssetJson',
        'as'    => 'post.assets-json'
    ]);

    Route::post('assets-update-json/{id?}',[
        'uses'  => 'AssetController@updateAssetJson',
        'as'    => 'post.assets-update-json'
    ]);
/*
    Route::get('json-assets',[
        'uses'  => 'AssetController@getAssets',
        'as'    => 'json-assets'
    ]);
*/

    Route::get('json-get-asset/{id?}',[
        'uses'  => 'AssetController@getSingleAsset',
        'as'    => 'json-get-asset'
    ]);

    Route::get('json-employee/{dept?}',[
        'uses'  => 'AssetController@employeeAssets',
        'as'    => 'json-assets-employee'
    ]);

    Route::get('json-delete-assets/{id?}',[
        'uses'  => 'AssetController@deleteAsset',
        'as'    => 'json-delete-assets'
    ]);

    Route::get('sub-assets',[
        'uses'  => 'SubAssetController@index',
        'as'    => 'sub-assets'
    ]);

    Route::post('sub-assets',[
        'uses'  => 'SubAssetController@create',
        'as'    => 'sub-asset'
    ]);

    Route::post('sub-asset-update-json/{id?}',[
        'uses'  => 'SubAssetController@update',
        'as'    => 'sub-asset-update-json'
    ]);

    Route::get('json-sub-assets',[
        'uses'  => 'SubAssetController@getSubAssets',
        'as'    => 'json-sub-assets'
    ]);

    Route::get('json-delete-sub-assets/{id?}',[
        'uses'  => 'SubAssetController@delete',
        'as'    => 'json-delete-sub-assets'
    ]);

    Route::get('json-get-sub-asset/{id?}',[
        'uses'  => 'SubAssetController@getSubAsset',
        'as'    => 'json-get-sub-asset'
    ]);

    /*
     * Budget Routes Section
     */

    Route::get('/budget-head',[
        'uses'  => 'BudgetHeadController@index',
        'as'    =>  'budget-head'
    ]);

    Route::get('/json-budget-heads',[
        'uses'  => 'BudgetHeadController@getBudgetHeades',
        'as'    =>  'json-budget-heads'
    ]);

    Route::get('/json-budget-heads-tree',[
        'uses'  => 'BudgetHeadController@get_budget_head_tree',
        'as'    =>  'json-budget-heads-tree'
    ]);

    Route::get('/json-get-budget-head/{id?}',[
        'uses'  => 'BudgetHeadController@getBudgetHead',
        'as'    =>  'json-get-budget-head'
    ]);

    Route::post('/budget-head',[
        'uses'  => 'BudgetHeadController@create',
        'as'    =>  'budget-head'
    ]);

    Route::post('/update-budget-head/{id?}',[
        'uses'  => 'BudgetHeadController@update',
        'as'    =>  'budget-head-update-json'
    ]);

    Route::get('/json-delete-budget-head/{id?}',[
        'uses'  => 'BudgetHeadController@delete',
        'as'    =>  'json-delete-budget-head'
    ]);

    /*
     * Budget Type
     */

    Route::get('/budget-type',[
        'uses'  => 'BudgetTypeController@index',
        'as'    =>  'budget-type'
    ]);

    Route::get('/json-budget-types',[
        'uses'  => 'BudgetTypeController@getBudgetTypes',
        'as'    =>  'json-budget-types'
    ]);

    Route::get('/json-get-budget-type/{id?}',[
        'uses'  => 'BudgetTypeController@getBudgetType',
        'as'    =>  'json-get-budget-type'
    ]);

    Route::post('/budget-type',[
        'uses'  => 'BudgetTypeController@create',
        'as'    =>  'budget-type'
    ]);

    Route::post('/update-budget-type/{id?}',[
        'uses'  => 'BudgetTypeController@update',
        'as'    =>  'budget-type-update-json'
    ]);

    Route::get('/json-delete-budget-type/{id?}',[
        'uses'  => 'BudgetTypeController@delete',
        'as'    =>  'json-delete-budget-type'
    ]);


    /*
     * Budget Declear
     */

    Route::get('/budget-declear',[
        'uses'  => 'YearlyBudgetController@index',
        'as'    =>  'budget-declear'
    ]);

    Route::post('/budget-declear',[
        'uses'  => 'YearlyBudgetController@createJson',
        'as'    =>  'budget-declear'
    ]);

    Route::get('/delete-budget-declear/{id?}',[
        'uses'  => 'YearlyBudgetController@deleteJson',
        'as'    =>  'delete-budget-declear'
    ]);

    Route::post('/update-budget-declear/{id?}',[
        'uses'  => 'YearlyBudgetController@updateJson',
        'as'    =>  'update-budget-declear'
    ]);

    Route::get('/budget-declears-json',[
        'uses'  => 'YearlyBudgetController@yearlyBudgetsJson',
        'as'    =>  'json-budget-declears'
    ]);

    Route::get('/budget-declear-json/{id?}',[
        'uses'  => 'YearlyBudgetController@yearlyBudgetJson',
        'as'    =>  'json-budget-declear'
    ]);

    /*
     * Budget Approval
     */

    Route::get('/budget-approval',[
        'uses'  => 'BudgetApprovalController@index',
        'as'    =>  'budget-approval'
    ]);

    Route::get('/budget-type-approval',[
        'uses'  => 'BudgetTypeApprovalController@index',
        'as'    =>  'budget-type-approval'
    ]);

    Route::get('/delete-budget-type-approval/{id?}',[
        'uses'  => 'BudgetTypeApprovalController@removeEmployee',
        'as'    =>  'delete-budget-type-approval'
    ]);

    Route::get('/json-budget-type-approval-employee/{id?}',[
        'uses'  => 'BudgetTypeApprovalController@getBudgetTypeApproval',
        'as'    =>  'json-budget-type-approval-employee'
    ]);

    Route::post('/budget-type-approval/{id?}',[
        'uses'  => 'BudgetTypeApprovalController@createBudgetTypeApproval',
        'as'    =>  'budget-type-approval'
    ]);

    Route::post('/update-budget-type-employee-approval/{id?}',[
        'uses'  => 'BudgetTypeApprovalController@updateBudgetTypeApproval',
        'as'    =>  'update-budget-type-employee-approval'
    ]);

    Route::get('/json-budget-types-employee/{id?}',[
        'uses'  => 'BudgetTypeApprovalController@approvalEmployee',
        'as'    =>  'json-budget-types-employee'
    ]);

    /*
     * Purchase
     */

    Route::get('/purchase-requisition',[
        'uses'  => 'PurchaseRequisitionController@index',
        'as'    => 'purchase-requisition'
    ]);

    Route::get('/delete/purchase-requisition/{id}',[
        'uses'  => 'PurchaseRequisitionController@deletePurchaseRequisition',
        'as'    => 'delete-purchase-requisition'
    ]);

    Route::get('/force-approve/purchase-requisition/{id}',[
        'uses'  => 'PurchaseRequisitionController@forceApprovePurchaseRequisition',
        'as'    => 'force-approve-purchase-requisition'
    ]);

    Route::get('/new-purchase-requisition',[
        'uses'  => 'PurchaseRequisitionController@newPurchaseRequisition',
        'as'    => 'new-purchase-requisition'
    ]);


    Route::get('/purchase-requisitions',[
        'uses'  => 'PurchaseRequisitionController@getPurchaseRequisitions',
        'as'    => 'purchase-requisitions'
    ]);

    Route::get('/delete/purchase-requisitions/{id?}',[
        'uses'  => 'PurchaseRequisitionController@delete',
        'as'    => 'delete-purchase-requisitions'
    ]);

    Route::get('/single-purchase-requisition/{id?}',[
        'uses'  => 'PurchaseRequisitionController@getPurchaseRequisition',
        'as'    => 'single-purchase-requisition'
    ]);

    Route::post('/update-purchase-requisition/{id?}',[
        'uses'  => 'PurchaseRequisitionController@update',
        'as'    => 'update-purchase-requisition'
    ]);



    Route::post('/purchase-requisition',[
        'uses'  => 'PurchaseRequisitionController@create',
        'as'    => 'purchase-requisition'
    ]);

    /*
     * Purchase Requisition Details
     */

    Route::get('/purchase-requisition-details',[
        'uses'  => 'PurchaseRequisitionDetailsController@index',
        'as'    => 'purchase-requisition-details'
    ]);

    Route::get('/pr-details/{id}',[
        'uses'  => 'PurchaseRequisitionDetailsController@getPurchaseRequisitionDetails',
        'as'    => 'pr-details'
    ]);


    Route::get('/json-purchase-requisition-details/{id?}',[
        'uses'  => 'PurchaseRequisitionDetailsController@getPurchaseRequisitionDetailsJson',
        'as'    => 'json-purchase-requisition-details'
    ]);

    Route::post('/purchase-requisition-details',[
        'uses'  => 'PurchaseRequisitionDetailsController@create',
        'as'    => 'purchase-requisition-details'
    ]);

    Route::post('/pr-requisition-details/{id}',[
        'uses'  => 'PurchaseRequisitionDetailsController@create',
        'as'    => 'pr-requisition-details'
    ]);

    Route::get('/json-purchase-requisition-detail/{id?}',[
        'uses'  => 'PurchaseRequisitionDetailsController@getPurchaseRequisitionDetail',
        'as'    => 'json-purchase-requisition-detail'
    ]);

    Route::post('/update-purchase-requisition-detail/{id?}',[
        'uses'  => 'PurchaseRequisitionDetailsController@update',
        'as'    => 'update-purchase-requisition-detail'
    ]);

    Route::get('/delete-purchase-requisition-detail/{id?}',[
        'uses'  => 'PurchaseRequisitionDetailsController@delete',
        'as'    => 'delete-purchase-requisition-detail'
    ]);

    Route::get('register/{id}',[
        'uses'  => 'UserController@createUser',
        'as'    => 'create-user'
    ]);


    Route::get('logout',function (){
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');


    Route::get('register-employee-user/{id?}',[
        'uses'  => 'UserController@createUser',
        'as'    => 'register-employee-user'
    ]);

    Route::get('resend-register-employee-user/{id?}',[
        'uses'  => 'UserController@resendEmail',
        'as'    => 'resend-register-employee-user'
    ]);


    Route::get('users',[
        'uses'  => 'UserController@getUsers',
        'as'    => 'users'
    ]);

    Route::get('/budget-approval',[
        'uses'  => 'UserController@getMyBudgetApproval',
        'as'    => 'budget-approval'
    ]);

    Route::get('/purchase-requisition-approval',[
        'uses'  => 'UserController@getMyPurchaseReqApproval',
        'as'    => 'purchase-requisition-approval'
    ]);

    Route::get('/my-purchase-req-approval-details/{id}',[
        'uses'  => 'UserController@getMyBudgetReqApprovalDetails',
        'as'    => 'my-purchase-req-approval-details'
    ]);

    Route::get('/my-budget-approval-details/{id}',[
        'uses'  => 'UserController@getMyBudgetApprovalDetails',
        'as'    => 'my-budget-approval-details'
    ]);

    Route::get('/approve-budget/{id}',[
        'uses'  => 'UserController@getMyBudgetApproved',
        'as'    => 'approve-budget'
    ]);

    Route::get('/approve-pr/{id}',[
        'uses'  => 'UserController@getMyPrApproved',
        'as'    => 'approve-pr'
    ]);

    Route::get('/cancel-approved-budget/{id}',[
        'uses'  => 'UserController@cancelMyBudgetApproval',
        'as'    => 'cancel-approved-budget'
    ]);

    Route::get('/cancel-approved-pr/{id}',[
        'uses'  => 'UserController@cancelMyPrApproval',
        'as'    => 'cancel-approved-pr'
    ]);

    Route::post('/budget-modification/{id}/{yearly_budget?}',[
        'uses'  => 'UserController@budgetModification',
        'as'    => 'budget-modification'
    ]);

    Route::get('/re-approve-budget/{id}',[
        'uses'  => 'UserController@reApproveModification',
        'as'    => 're-approve-budget'
    ]);

    /*
     * Send Approval
     */

    Route::get('send-approval',[
        'uses'  => 'UserController@sendApprovalRequest',
        'as'    => 'send-approval'
    ]);

    Route::get('send-approval/{id}',[
        'uses'  => 'UserController@sendToApprove',
        'as'    => 'send-to-approve'
    ]);

    Route::get('send-pr-approval/{id}',[
        'uses'  => 'UserController@sendPrToApprove',
        'as'    => 'send-pr-to-approve'
    ]);


    Route::get('get-asset-list-html',[
        'uses'  => 'PurchaseRequisitionController@remainingAsset',
        'as'    => 'get-asset-list-html'
    ]);



    /*
     * Purchase Receive & Receive Details
     */

    Route::get('/purchase-receive',[
        'uses'  => 'PurchaseReceiveController@index',
        'as'    => 'purchase-receive'
    ]);

    Route::get('/purchase-receive/{id}',[
        'uses'  => 'PurchaseReceiveController@receiveAsset',
        'as'    => 'asset-receive'
    ]);

    Route::get('/purchase-receive/{pur_req_id}/{asset_id}',function($pur_req_id,$asset_id){
        $asset = \App\Asset::find($asset_id);
        $budget_types = \App\BudgetType::where('type_info','budget')->get();
        $pur_req_detail = \App\PurchaseRequisitionDetail::with('asset')
            ->where('purchase_req_id',$pur_req_id)
            ->where('asset_id',$asset_id)->first();
        $vw_receive_detail = \App\VwReceiveDetail::where('PUR_REQ_ID',$pur_req_id)
                                                ->where('asset_id',$asset_id)->first();
        $vendors = \App\Vendor::all();
        return view('admin.asset-receive-form')->with([
            'asset'         => $asset,
            'pur_req_id'    => $pur_req_id,
            'asset_id'      => $asset_id,
            'vendors'      => $vendors,
            'vw_receive_detail'      => $vw_receive_detail,
            'pur_req_detail'      => $pur_req_detail,
            'budget_types'      => $budget_types,
        ]);

    })->name('get-receive-asset');

    Route::post('/purchase-receive-details/{per_req_id}/{assset_id}',[
        'uses'  => 'PurchaseReceiveDetailsController@saveReceive',
        'as'    => 'post-purchase-receive-details'
    ]);

    Route::get('/purchase-receive-details',[
        'uses'  => 'PurchaseReceiveDetailsController@index',
        'as'    => 'purchase-receive-details'
    ]);

    /*
     * Issue Received Asset
     */
    Route::get('/issue-received-asset',[
        'uses'  => 'IssueController@index',
        'as'    => 'issue-received-asset'
    ]);

    Route::get('/get-rem-balance/{bgt?}/{bhd?}',[
        'uses'  => 'PurchaseReceiveController@getRemBalance',
        'as'    => 'get-rem-balance'
    ]);

    Route::post('/issue-received-asset',[
        'uses'  => 'IssueController@create',
        'as'    => 'issue-received-asset'
    ]);

    /*
     * Budget Head
     */

    Route::get('/get-budget-head/{id?}',[
        'uses'  => 'BudgetHeadController@getBudgetHeadList',
        'as'    => 'get-budget-head'
    ]);

    /*
     * User List
     */

    Route::get('/users',[
        'uses'  => 'UserController@getUsersList',
        'as'    => 'user-list'
    ]);

    Route::get('/user-roles/{id}',[
        'uses'  => 'UserController@getUsersRole',
        'as'    => 'user-roles'
    ]);

    Route::post('/user-roles/{id}',[
        'uses'  => 'UserController@updateUsersRole',
        'as'    => 'update-user-roles'
    ]);

    Route::get('/create-roles/',[
        'uses'  => 'RoleController@index',
        'as'    => 'create-roles'
    ]);

    Route::get('/delete-role/{id}',[
        'uses'  => 'RoleController@delete',
        'as'    => 'delete-role'
    ]);

    /*
     * Support Ticket
     */

    Route::get('/support-departments',[
        'uses'  => 'SupportController@index',
        'as'    => 'support-departments'
    ]);

    Route::get('/delete-support-dept/{id}',[
        'uses'  => 'SupportController@delete',
        'as'    => 'delete-support-dept'
    ]);

    Route::post('/create-support-dept',[
        'uses'  => 'SupportController@create',
        'as'    => 'create-support-dept'
    ]);

    Route::post('/update-support-dept/{id?}',[
        'uses'  => 'SupportController@update',
        'as'    => 'update-support-dept'
    ]);

    Route::get('/support-department-employee',[
        'uses'  => 'SupportDeptEmployeeController@index',
        'as'    => 'support-department-employee'
    ]);

    Route::post('/support-department-employee',[
        'uses'  => 'SupportDeptEmployeeController@create',
        'as'    => 'support-department-employee'
    ]);

    Route::get('/remove-support-dept-employee/{id}/{user_id}',[
        'uses'  => 'SupportDeptEmployeeController@remove',
        'as'    => 'remove-support-dept-employee'
    ]);

    Route::get('/get-support-dept-assignable-user/{id?}',[
        'uses'  => 'SupportDeptEmployeeController@getRemainingUser',
        'as'    => 'get-support-dept-assignable-user'
    ]);

    Route::get('/create-support-ticket',[
        'uses'  => 'SupportQuestionController@index',
        'as'    => 'create-support-ticket'
    ]);

    Route::get('/support-question',[
        'uses'  => 'SupportQuestionController@getSupportQuestion',
        'as'    => 'support-question'
    ]);

    Route::get('/support-ticket/{id}',[
        'uses'  => 'SupportQuestionController@getSupportTecket',
        'as'    => 'support-ticket'
    ]);

    Route::post('/support-ticket/answare/{id}',[
        'uses'  => 'SupportQuestionController@postAnswer',
        'as'    => 'support-ticket-answare'
    ]);

    Route::post('/create-support-ticket',[
        'uses'  => 'SupportQuestionController@create',
        'as'    => 'create-support-ticket'
    ]);

    Route::get('/create-support-ticket/{id}/{status}',[
        'uses'  => 'SupportQuestionController@changeStatus',
        'as'    => 'change-support-ticket-status'
    ]);

    /*
     * Issued Item Docs
     */

    Route::get('issued-item-list',[
        'uses'  => 'IssueController@issuedItems',
        'as'    => 'issued-item-list'
    ]);

    Route::get('view-issued-item-doc/{id}',[
        'uses'  => 'IssuedItemDocsController@viewDoc',
        'as'    => 'view-issued-item-doc'
    ]);

    Route::get('create-issued-item-docs',[
        'uses'  => 'IssuedItemDocsController@index',
        'as'    => 'create-issued-item-docs'
    ]);

    Route::post('create-issued-item-docs',[
        'uses'  => 'IssuedItemDocsController@create',
        'as'    => 'create-issued-item-docs'
    ]);

    /*
     * Service
     */
    Route::get('in-service',[
        'uses'  => 'ServiceController@index',
        'as'    => 'in-service'
    ]);

    Route::get('send-for-service',[
        'uses'  => 'ServiceController@getCreateService',
        'as'    => 'send-for-service'
    ]);

    Route::post('send-for-service',[
        'uses'  => 'ServiceController@create',
        'as'    => 'send-for-service'
    ]);

    Route::get('asset-in-service/{id}',[
        'uses'  => 'ServiceController@serviceDetails',
        'as'    => 'asset-in-service'
    ]);

    Route::get('receive-from-service/{id}',[
        'uses'  => 'ServiceController@receiveFromService',
        'as'    => 'receive-from-service'
    ]);

    Route::get('receive-all-from-service/{id}',[
        'uses'  => 'ServiceController@receiveAllAsset',
        'as'    => 'receive-all-from-service'
    ]);

    Route::post('receive-selected-from-service',[
        'uses'  => 'ServiceController@receiveSelectedAsset',
        'as'    => 'receive-selected-from-service'
    ]);

    Route::get('received-service',[
        'uses'  => 'ServiceController@receivedAssets',
        'as'    => 'received-service'
    ]);



    /*
     * Asset Log
     */

    Route::get('asset-log',[
        'uses'  => 'AssetLogController@index',
        'as'    => 'asset-logs'
    ]);

    Route::get('asset-log/{id}',[
        'uses'  => 'AssetLogController@assetLog',
        'as'    => 'asset-log'
    ]);

    Route::get('delete-log/{id}',[
        'uses'  => 'AssetLogController@delete',
        'as'    => 'delete-log'
    ]);



});



Route::get('confirm-registration/{id}/{token}',function($id,$token){
    $user = \App\User::where('id', $id)->where('email_token',$token);
    if(!$user){
        return redirect()->route('login');
    }
    return view('confirm-registration')->with([
        'id'    => $id,
        'token' => $token
    ]);
})->name('confirm-registration');

Route::post('confirm-registration/{id}/{token}',[
    'uses'  => 'UserController@confirmUserRegistration',
    'as'    => 'confirm-registration'
]);


Route::group(['middleware' => 'guest'],function(){
    Route::post('/password-reset-link',[
        'uses'  => 'UserController@resetPassword',
        'as'    => 'reset-pass-link'
    ]);
});



