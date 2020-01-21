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

    /*----------  Routes economic activities  ----------*/
    Route::get('economic-activities/list', 'EconomicActivityController@list')->name('list-economic-activities');
    Route::resource('economic-activities', 'EconomicActivityController');

    /*----------  Routes representations ----------*/
    Route::get('representations/list', 'RepresentationController@list')->name('list-representations');
    Route::resource('representations', 'RepresentationController');

    /*----------  Routes representations ----------*/
    Route::get('taxpayers/list', 'TaxpayerController@list')->name('list-taxpayers');
    Route::resource('taxpayers', 'TaxpayerController');

    /*----------  Routes persons ----------*/
    // Route::get('/states/{id}/municipalities', 'PersonController@byStates');
    // Route::get('list-persons', 'PersonController@listPersons');
    // Route::resource('persons', 'PersonController');
    // Route::get('persons/vehicles/{id}', 'PersonController@listVehicles');
    // Route::get('register-persons/{identityCard}/{licensePlate}', 'PersonController@registerPerson')->name('register-persons');

    // # -----------  Routes type vehicles  -----------
    // Route::get('vehicles/list', 'TypeVehicleController@list');
    // Route::resource('vehicles/type-vehicles', 'TypeVehicleController');

    // # -----------  Routes type vehicles  -----------
    // Route::get('list-novelties', 'NoveltyController@list');
    // Route::resource('novelties', 'NoveltyController');

    // # -----------  Routes vehicles -----------
    // Route::get('list-vehicles', 'VehicleController@list')->name('list-vehicles');
    // Route::resource('vehicles/vehicles', 'VehicleController');

    // #------------- Routes various ------------
    // Route::post('validate-refuelling', 'RefuellingController@validateRefuelling')->name('validate-refuelling');
    // Route::get('register-vehicles/{id}/{lisencePLate}', 'VehicleController@registerVehicle')->name('register-vehicles');
    // Route::get('refueling/{id}', 'RefuellingController@refuelling')->name('refueling');
    // Route::post('register-refueling', 'RefuellingController@registerRefueling');
});
