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

Auth::routes();

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('dashboard');
    } else {
        return redirect('login');
    }
});

Route::get('login', 'Auth\LoginController@index')->name('login');
Route::get('logout', 'Auth\LoginController@logout');

Route::prefix('/')->middleware('auth')->group(function()
{
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::group(['middleware' => ['has.role:admin']], function () {
        /** General Settings */
        Route::get('settings', 'ShowSettings');
        
        /**
        * Settings > Open new year
        */
        Route::post('settings/new-year', 'OpenNewYear');

       /**
        *  Settings > Property types
        */ 
        Route::get('property-types/list', 'PropertyTypeController@list')->name('list-property-types');
        Route::resource('settings/property-types', 'PropertyTypeController');      
        
        /**
         * Ordinance settings
         */
        Route::get('ordinances/list', 'OrdinanceController@list')->name('list-ordinances');
        Route::resource('settings/ordinances', 'OrdinanceController');

        /*----------  Routes Settings > Economic sectors  ----------*/
        Route::get('economic-sectors/list', 'EconomicSectorController@list')->name('list-economic-sectors');
        Route::resource('settings/economic-sectors', 'EconomicSectorController');

        /**
         *  Personal firm routes
         */
        Route::get('personal-firms/list', 'PersonalFirmController@list');
        Route::resource('settings/personal-firms', 'PersonalFirmController');

        /**
         * Routes Settings > Concepts
         */
        Route::get('concepts/list', 'ConceptController@list')->name('list-concepts');
        Route::resource('settings/concepts', 'ConceptController');

        /*----------  Routes Settings > Tax Units ----------*/
        Route::get('tax-units/list', 'TaxUnitController@list')->name('list-tax-units');
        Route::resource('settings/tax-units', 'TaxUnitController');
        
        /*----------  Routes permissions  ----------*/
        Route::get('permissions/list', 'PermissionController@list');
        Route::resource('administration/permissions', 'PermissionController');

        /*----------  Routes roles  ----------*/
        Route::get('roles/list', 'RoleController@list');
        Route::resource('administration/roles', 'RoleController');

        /*----------  Routes users  ----------*/
        Route::get('users/list', 'UserController@list');
        Route::resource('administration/users', 'UserController');
   });

    /*----------  Routes economic activities  ----------*/
    Route::get('economic-activities/list', 'EconomicActivityController@list')->name('list-economic-activities');
    Route::resource('economic-activities', 'EconomicActivityController');

    
    /*----------  Routes parishes  ----------*/
    Route::get('parishes/list', 'ParishController@list')->name('list-parishes');
    Route::resource('geographic-area/parishes', 'ParishController');

    /*----------  Routes communities  ----------*/
    Route::get('communities/list', 'CommunityController@list')->name('list-communities');
    Route::resource('geographic-area/communities', 'CommunityController');


    Route::group(['middleware' => 'has.role:admin,operator,suboperator'], function() {
        /**---------- Routes Payments ----------*/
        Route::get('cashbox/list', 'PaymentController@list');
        Route::resource('payments', 'PaymentController');
    });

    Route::group(['middleware' => 'has.role:admin,analyst'], function () {
        Route::resource('about', 'AboutController');
    });

    /*----------  Routes representations ----------*/
    Route::get('representations/list', 'RepresentationController@list')->name('list-representations');
    Route::group(['middleware' => 'has.role:analyst'], function () {
        Route::post('people/{taxpayer}', 'RepresentationController@storePerson')->name('person.store');
        Route::get('taxpayers/{taxpayer}/representation/create', 'RepresentationController@create');
        Route::post('taxpayers/{taxpayer}/representation/add', 'RepresentationController@store')->name('representation.store');
    });
    Route::resource('representations', 'RepresentationController')->except(['create', 'store']);

    /*----------  Routes taxpayers ----------*/
    Route::get('taxpayers/list', 'TaxpayerController@list')->name('list-taxpayers');
    Route::group(['middleware' => 'has.role:analyst'], function () {
        Route::get('taxpayer/{taxpayer}/economic-activities/add', 'TaxpayerController@activitiesForm')->name('activities');
        Route::post('taxpayer/{taxpayer}/add-economic-activities', 'TaxpayerController@addActivities')->name('add-activities');
    });
    Route::resource('taxpayers', 'TaxpayerController');

    /*----------  Routes ordinance types ----------*/
    Route::get('ordinances/list-all', 'OrdinanceController@listAll')->name('list-ordinances');

    /*----------  Routes applications ----------*/
    Route::get('applications/list', 'ApplicationController@list')->name('list-applications');
    Route::post('applications/taxpayer', 'ApplicationController@store')->name('add-application-taxpayer');
    Route::post('applications/{application}/approve', 'ApplicationController@approve')->name('approveApplication');
    Route::resource('applications', 'ApplicationController');

    /*----------  Routes Ordinances ----------*/
    Route::get('ordinances/{id}/concepts', 'ConceptController@byOrdinance')->name('list-concepts');
    
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

    /*----------  Routes properties ----------*/
    Route::get('taxpayer/{id}/property/create', 'PropertyController@create')->name('create-property');
    Route::post('taxpayer/{id}/add-property', 'PropertyController@store')->name('add-property');
    Route::get('properties/list', 'PropertyController@list')->name('list-properties');
    Route::resource('properties', 'PropertyController');

    /*----------  Routes parishes ----------*/
    Route::get('parishes/{id}/communities', 'ParishController@getCommunities');
    Route::get('state/{id}/municipalities', 'StateController@getMunicipalities');

    /*----------  Routes commercial registers ----------*/
    Route::get('taxpayer/{taxpayer}/commercial-register/create', 'CommercialRegisterController@create')->name('create-commercial-regster');
    Route::post('taxpayer/{taxpayer}/add-commercial-register', 'CommercialRegisterController@store')->name('add-commercial-register');
    Route::get('commercial-registers/list', 'CommercialRegisterController@list')->name('list-commercial-registers');
    Route::resource('commercial-registers', 'CommercialRegisterController');

    Route::group(['middleware' => 'has.role:admin|liquidator'], function () {
        /**---------- Routes Payments ----------*/
        Route::get('cashbox/list', 'PaymentController@list');
        Route::get('payments/{payment}/download', 'PaymentController@download');
        Route::resource('payments', 'PaymentController');
    });
    
    /**---------- Routes Requisites ----------*/
    Route::get('requisites/list', 'RequisiteController@list');
    Route::resource('settings/requisites', 'RequisiteController');
    
    /**
     * Licenses routes
     */
    Route::get('licenses/{license}/download', 'LicenseController@download');
    Route::resource('licenses', 'LicenseController');
    
    /**
     * Economic activity settlements
     */
    Route::post('economic-activity-settlements/{taxpayer}/', 'PaymentController@settlements');
});
