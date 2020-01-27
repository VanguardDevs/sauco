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
    return view('auth.login');
});

Auth::routes();

Route::prefix('/')->middleware('auth')->group(function()
{
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

    Route::group(['middleware' => ['has.role:admin']], function () {
        /*----------  Routes permissions  ----------*/
        Route::resource('administration/permissions', 'PermissionController');

        /*----------  Routes roles  ----------*/
        Route::resource('administration/roles', 'RoleController');

        /*----------  Routes users  ----------*/
        Route::get('administration/list-users', 'UserController@listUsers');
        Route::resource('administration/users', 'UserController');

    });

    /*----------  Routes parishes  ----------*/
    Route::get('parishes/list', 'ParishController@list')->name('list-parishes');
    Route::resource('geographic-area/parishes', 'ParishController');

    /*----------  Routes communities  ----------*/
    Route::get('communities/list', 'CommunityController@list')->name('list-communities');
    Route::resource('geographic-area/communities', 'CommunityController');

    /*----------  Routes Settings > Economic sectors  ----------*/
    Route::get('economic-sectors/list', 'EconomicSectorController@list')->name('list-economic-sectors');
    Route::resource('settings/economic-sectors', 'EconomicSectorController');

    /*----------  Routes Settings > Tax Units ----------*/
    Route::get('tax-units/list', 'TaxUnitController@list')->name('list-tax-units');
    Route::resource('settings/tax-units', 'TaxUnitController');

    /*----------  Routes economic activities  ----------*/
    Route::get('economic-activities/list', 'EconomicActivityController@list')->name('list-economic-activities');
    Route::resource('economic-activities', 'EconomicActivityController');

    /*----------  Routes representations ----------*/
    Route::get('representations/list', 'RepresentationController@list')->name('list-representations');
    Route::resource('representations', 'RepresentationController');

    /*----------  Routes taxpayers ----------*/
    Route::get('taxpayers/list', 'TaxpayerController@list')->name('list-taxpayers');
    Route::resource('taxpayers', 'TaxpayerController');

    /*----------  Routes application types ----------*/
    Route::get('application-types/list-all', 'ApplicationTypeController@listAll')->name('list-application-types');
    Route::get('application-types/list', 'ApplicationTypeController@list')->name('list-application-types');
    Route::resource('settings/application-types', 'ApplicationTypeController');

    /*----------  Routes applications ----------*/
    Route::get('applications/list', 'ApplicationController@list')->name('list-applications');
    Route::post('applications/taxpayer', 'ApplicationController@addApplicationTaxpayer')->name('add-application-taxpayer');
    Route::post('applications/{id}/approve', 'ApplicationController@approve')->name('approveApplication');
    Route::resource('applications', 'ApplicationController');

    /*----------  Routes applications ----------*/
    Route::get('charging-methods/list', 'ChargingMethodController@list')->name('list-charging-methods');
    Route::resource('settings/charging-methods', 'ChargingMethodController');

    /*----------  Routes applications ----------*/
    Route::get('fine-types/list-all', 'FineTypeController@listAll')->name('list-fine-types');
    Route::get('fine-types/list', 'FineTypeController@list')->name('list-fine-types');
    Route::resource('settings/fine-types', 'FineTypeController');

    /*----------  Routes fines ----------*/
    Route::get('fines/list', 'FineController@list')->name('list-fines');
    Route::post('fines/taxpayer', 'FineController@addFineTaxpayer')->name('add-fine-taxpayer');
    Route::post('fines/{id}/approve', 'FineController@approve')->name('approveFine');
    Route::resource('fines', 'FineController');

    /*----------  Routes bank-accounts ----------*/
    Route::get('bank-accounts/list', 'BankAccountController@list')->name('list-bank-accounts');
    Route::resource('settings/bank-accounts', 'BankAccountController');

    /*----------  Routes property types ----------*/
    Route::get('property-types/list-all', 'PropertyTypeController@listAll')->name('list-property-types');
    Route::get('property-types/list', 'PropertyTypeController@list')->name('list-property-types');
    Route::resource('settings/property-types', 'PropertyTypeController');

    /*----------  Routes properties ----------*/
    Route::get('taxpayer/{id}/property/create', 'PropertyController@create')->name('create-property');
    Route::post('taxpayer/{id}/add-property', 'PropertyController@store')->name('add-property');
    Route::get('properties/list', 'PropertyController@list')->name('list-properties');
    Route::resource('properties', 'PropertyController');

    /*----------  Routes parishes ----------*/
    Route::get('parishes/{id}/communities', 'ParishController@getCommunities');
});
