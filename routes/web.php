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
});
