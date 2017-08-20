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

Route::get('/', function () {
    return view('welcome');
})->name('default');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin','middleware' => 'auth'],function () {

    Route::get('/',[
        'uses'  => 'OrganizationController@getDepartments',
        'as'    => 'admin.departments'
    ]);
    Route::get('/organizations',function(){
        return view('admin.organization');
    })->name('admin.organizations');

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

    Route::get('vendors', function () {
        return view('admin.vendors');
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

    Route::post('json-delete-service-type/{id?}',[
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

    Route::get('json-assets',[
        'uses'  => 'AssetController@getAssets',
        'as'    => 'json-assets'
    ]);

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

    Route::get('/json-purchase-requisition-details',[
        'uses'  => 'PurchaseRequisitionDetailsController@getPurchaseRequisitionDetails',
        'as'    => 'json-purchase-requisition-details'
    ]);

    Route::post('/purchase-requisition-details',[
        'uses'  => 'PurchaseRequisitionDetailsController@create',
        'as'    => 'purchase-requisition-details'
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


    Route::get('logout',function (){
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');


});

