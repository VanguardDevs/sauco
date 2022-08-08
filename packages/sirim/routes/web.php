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
    Route::get('api/taxpayers/{taxpayer}/representations', 'TaxpayerController@getRepresentations');
    Route::get('api/affidavits/{affidavit}', 'AffidavitController@show')->name('affidavitApi');
    Route::get('api/taxpayers/{taxpayer}/economic-activities', 'TaxpayerController@economicActivities');
    Route::get('api/taxpayers/{taxpayer}', 'TaxpayerController@show')->name('taxpayer.profile');

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
        Route::post('taxpayers/{taxpayer}/economic-activity-licenses/create', 'LicenseController@store')
            ->name('economic-activity-license.create');

        Route::post('taxpayers/{taxpayer}/liqueur-licenses/create', 'LicenseController@storeLiqueurLicense')
            ->name('liqueur-license.create');
        Route::post('taxpayers/{taxpayer}/liqueur-licenses/renovate', 'LicenseController@renovateLiqueurLicense')
            ->name('liqueur-license.renovate');

        Route::get('liqueur-licenses/{license}/download', 'LicenseController@downloadLiqueurLicense')->name('liqueur-license.download');

        Route::post('licenses/{license}/dismiss', 'LicenseController@dismiss');
    });
    Route::get('taxpayers/{taxpayer}/economic-activity-licenses', 'LicenseController@create')
        ->name('taxpayer.economic-activity-licenses');
    Route::resource('licenses', 'LicenseController')->except(['create', 'store']);

    Route::get('taxpayers/{taxpayer}/liqueur-licenses', 'LicenseController@createLicenceLiqueur')
        ->name('taxpayer.liqueur-licenses');

    Route::get('liqueur-licenses', 'LicenseController@listLicenseLiqueur')
        ->name('liqueur-licenses.index');

    Route::get('liqueur-licenses/{license}', 'LicenseController@showLicenseLiqueur')
        ->name('liqueur-licenses.show');

     /*
    * Payment's routes modules
     */
    Route::get('payments/{payment}/download', 'PaymentController@download')
        ->name('payments.download');
    Route::get('payments/{payment}/ticket', 'PaymentController@ticket')
        ->name('payments.ticket');
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

    Route::get('affidavits/{affidavit}/download', 'AffidavitController@download')
    ->name('affidavits.download');
    Route::get('affidavits/{affidavit}/ticket', 'AffidavitController@ticket')
    ->name('affidavits.ticket');

    /**
     * Taxpayer's Fines
     */
    Route::get('taxpayers/{taxpayer}/fines/list', 'FineController@list');
    Route::get('taxpayers/{taxpayer}/fines', 'FineController@index')
        ->name('taxpayer.fines');
    Route::post('taxpayers/{taxpayer}/fines/create', 'FineController@store')
        ->name('fines.new');
    Route::get('fines/{fine}/payment/new', 'FineController@makePayment')
        ->middleware('can:process.payments');
    Route::resource('fines', 'FineController');

    /**
     * Taxpayer's application
     */
    Route::get('taxpayers/{taxpayer}/applications/list', 'ApplicationController@list');
    Route::get('applications/{application}/payment/new', 'ApplicationController@makePayment');
    Route::resource('taxpayers/{taxpayer}/applications', 'ApplicationController');

    /**
     * Taxpayer's Withholdings
     */
    Route::get('taxpayers/{taxpayer}/withholdings', 'WithholdingController@index')
        ->name('withholdings.index');
    Route::get('taxpayers/{taxpayer}/withholdings/list', 'WithholdingController@list');
    Route::resource('withholdings', 'WithholdingController');

    /**
     * Handle settlements and payments
     */
    Route::post('settlements/{taxpayer}/create', 'AffidavitController@create')->name('settlements.create');

    /*----------  Routes representations ----------*/
    Route::group(['middleware' => 'can:edit.taxpayers'], function () {
        Route::post('people/{taxpayer}', 'RepresentationController@storePerson')->name('person.store');
        Route::get('taxpayers/{taxpayer}/representation/add', 'RepresentationController@create')->name('representations.add');
        Route::post('taxpayers/{taxpayer}/representation/create', 'RepresentationController@store')->name('representation.store');
    });
    Route::resource('people', 'PersonController');
    Route::resource('taxpayers/representations', 'RepresentationController')->except(['create', 'store']);

    /**
     * Taxpayer's routes
     */
    Route::group(['middleware' => 'can:edit.taxpayers'], function () {
        Route::patch('taxpayer/{taxpayer}/update-economic-activities', 'EconomicActivityController@editActivities')->name('taxpayer-activities.update');
        Route::get('taxpayers/{taxpayer}/economic-activities', 'EconomicActivityController@editActivitiesForm')->name('taxpayer.economic-activities');
    });
    Route::get('taxpayers/{taxpayer}/affidavits/{affidavit}/download', 'AffidavitController@download');
    Route::get('taxpayers/{taxpayer}/affidavits', 'AffidavitController@byTaxpayer')->name('taxpayer.affidavits');
    Route::get('taxpayers/{taxpayer}/payments', 'PaymentController@listByTaxpayer');
    Route::get('taxpayers/{taxpayer}/payments/{payment}', 'PaymentController@showTaxpayerPayment');
    Route::get('taxpayers/list', 'TaxpayerController@list')->name('list-taxpayers');
    Route::resource('taxpayers', 'TaxpayerController');

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
    Route::get('taxpayer/{taxpayer}/liquidations', 'LiquidationController@index')
        ->name('liquidations.index');
    Route::get('liquidations/{liquidation}/show', 'LiquidationController@show')
        ->name('liquidations.show');

   	Route::get('liquidations/{liquidation}/download', 'LiquidationController@download')
        ->name('liquidations.download');
    Route::get('liquidations/{liquidation}/ticket', 'LiquidationController@ticket')
        ->name('liquidations.ticket');

    /**
     * Dismissal's routes modules
     */
    Route::get('dismissals/{dismissal}/download', 'DismissalController@download')
        ->name('dismissals.download');
    Route::resource('dismissals', 'DismissalController')
        ->only(['index']);

     /**
     * Liqueur Parameter's routes modules
     */

    Route::resource('liqueur-parameters', 'LiqueurParameterController')->except(['show']);;
    //Route::get('liqueur-parameters', 'LiqueurParameterController@index')->name('liqueur-parameters.index');
    Route::get('liqueur-parameters/list', 'LiqueurParameterController@list');

      /**
     * Taxpayer's Credits
     */
    Route::get('taxpayers/{taxpayer}/credits', 'CreditController@index')
        ->name('credits.index');
    Route::get('taxpayers/{taxpayer}/credits/list', 'CreditController@list');
});
