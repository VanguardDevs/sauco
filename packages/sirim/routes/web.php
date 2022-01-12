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
    /**
     * Available for all users logged in
     */
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // API ROUTES
    Route::get('api/companies/{company}/representations', 'CompanyController@getRepresentations');
    Route::get('api/affidavits/{affidavit}', 'AffidavitController@show')->name('affidavitApi');
    Route::get('api/companies/{company}/economic-activities', 'CompanyController@economicActivities');
    Route::get('api/companies/{company}', 'CompanyController@show')->name('taxpayer.profile');

    /**
     * Only Admin routes
     */
    Route::group(['middleware' => ['has.role:admin']], function () {
        /*----------  Routes permissions  ----------*/
        Route::get('permissions/list', 'Settings\PermissionController@list');
        Route::resource('settings/administration/permissions', 'Settings\PermissionController');

        /*----------  Routes roles  ----------*/
        Route::get('roles/list', 'Settings\RoleController@list');
        Route::resource('settings/administration/roles', 'Settings\RoleController');

        /*----------  Routes users  ----------*/
        Route::get('users/list', 'Settings\UserController@list');
        Route::resource('settings/administration/users', 'Settings\UserController');
    });

    /**
     * Routes available for admin, chief of inspection, inspectors and superintendent
     */

    /**
     * Licenses
     */
    Route::group(['middleware' => 'can:create.licenses'], function() {
        Route::get('licenses/{license}/download', 'LicenseController@download');
        Route::post('licenses/{license}/renovate', 'LicenseController@renovate');
        Route::post('companies/{company}/economic-activity-licenses/create', 'LicenseController@store')
            ->name('economic-activity-license.create');
    });
    Route::get('companies/{company}/economic-activity-licenses', 'LicenseController@create')
        ->name('taxpayer.economic-activity-licenses');
    Route::resource('licenses', 'LicenseController')->except(['create', 'store']);

     /*
    * Payment's routes modules
     */
    Route::get('payments/{payment}/download', 'PaymentController@download')
        ->name('payments.download');
    Route::resource('payments', 'PaymentController');

    /**
    * Taxpayer's affidavits
     */
    Route::get('affidavits/{affidavit}/normal', 'AffidavitController@normalCalcForm')
        ->name('affidavits.show');
    Route::get('affidavits/{affidavit}/group', 'AffidavitController@groupActivityForm')
        ->name('affidavits.group');
    Route::get('affidavits/{affidavit}/payment/new', 'AffidavitController@makePayment')
        ->middleware('can:process.payments')
        ->name('affidavits.payment');
    Route::resource('affidavits', 'AffidavitController');

    /**
     * Taxpayer's Fines
     */
    Route::get('companies/{company}/fines/list', 'FineController@list');
    Route::get('companies/{company}/fines', 'FineController@index')
        ->name('taxpayer.fines');
    Route::post('companies/{company}/fines/create', 'FineController@store')
        ->name('fines.new');
    Route::get('fines/{fine}/payment/new', 'FineController@makePayment')
        ->middleware('can:process.payments');
    Route::resource('fines', 'FineController');

    /**
     * Taxpayer's application
     */
    Route::get('companies/{company}/applications/list', 'ApplicationController@list');
    Route::get('applications/{application}/payment/new', 'ApplicationController@makePayment')
        ->middleware('can:process.payments');
    Route::resource('companies/{company}/applications', 'ApplicationController');

    /**
     * Taxpayer's Withholdings
     */
    Route::get('companies/{company}/withholdings', 'WithholdingController@index')
        ->name('withholdings.index');
    Route::get('companies/{company}/withholdings/list', 'WithholdingController@list');
    Route::resource('withholdings', 'WithholdingController');

    /**
     * Handle settlements and payments
     */
    Route::post('settlements/{company}/create', 'AffidavitController@create')->name('settlements.create');

    /*----------  Routes representations ----------*/
    Route::group(['middleware' => 'can:edit.companies'], function () {
        Route::post('people/{company}', 'RepresentationController@storePerson')->name('person.store');
        Route::get('companies/{company}/representation/add', 'RepresentationController@create')->name('representations.add');
        Route::post('companies/{company}/representation/create', 'RepresentationController@store')->name('representation.store');
    });
    Route::resource('people', 'PersonController');
    Route::resource('companies/representations', 'RepresentationController')->except(['create', 'store']);

    /**
     * Taxpayer's routes
     */
    Route::group(['middleware' => 'can:edit.companies'], function () {
        Route::patch('taxpayer/{company}/update-economic-activities', 'EconomicActivityController@editActivities')->name('taxpayer-activities.update');
        Route::get('companies/{company}/economic-activities', 'EconomicActivityController@editActivitiesForm')->name('taxpayer.economic-activities');
    });
    Route::get('companies/{company}/affidavits/{affidavit}/download', 'AffidavitController@download');
    Route::get('companies/{company}/affidavits', 'AffidavitController@byTaxpayer')->name('taxpayer.affidavits');
    Route::get('companies/{company}/payments', 'PaymentController@listByTaxpayer');
    Route::get('companies/{company}/payments/{payment}', 'PaymentController@showTaxpayerPayment');
    Route::get('companies/list', 'CompanyController@list')->name('list-companies');
    Route::resource('companies', 'CompanyController')->only(['index', 'show']);

    /**
     * Listing routes
     */
    Route::get('representations/list', 'RepresentationController@list');
    Route::get('applications/{ordinance}/concepts', 'ApplicationController@listConcepts');
    Route::get('fines/{ordinance}/concepts', 'FineController@listConcepts');
    Route::get('years/{year}/months', 'YearController@listMonths');

    /**
     * Update passwords
     */
    Route::get('change-password', 'Settings\UserController@showChangePassword')
        ->name('change-password.show');
    Route::post('update-password', 'Settings\UserController@updatePassword')
        ->name('change-password.update');

    Route::resource('affidavits', 'AffidavitController');

    Route::resource('liquidations', 'LiquidationController')
        ->except(['index', 'show']);
    Route::get('taxpayer/{company}/liquidations', 'LiquidationController@index')
        ->name('liquidations.index');
    Route::get('liquidations/{liquidation}/show', 'LiquidationController@show')
        ->name('liquidations.show');
});
