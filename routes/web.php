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

Route::prefix('admin')->group(function () {

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
        return view('admin.asset-types');
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
    Route::get('/json/section',[
        'uses'  => 'OrganizationController@getSectionJson',
        'as'    => 'json-section'
    ]);
    Route::get('/json/location',[
        'uses'  => 'OrganizationController@getLocationJson',
        'as'    => 'json-location'
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


});
