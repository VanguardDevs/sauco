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
    Route::get('about', 'ShowAbout')->name('about');

    /**
     * Only Admin routes
     */
    Route::group(['middleware' => ['has.role:admin']], function () {
        /** General Settings */
        Route::get('settings', 'ShowSettings')->name('settings');

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

        /**
         * Payment methods settings
         */
        Route::get('payment-methods/list', 'PaymentMethodController@list')->name('list-payment-methods');
        Route::resource('settings/payment-methods', 'PaymentMethodController');

        /*----------  Routes Settings > Economic sectors  ----------*/
        Route::get('economic-sectors/list', 'EconomicSectorController@list')->name('list-economic-sectors');
        Route::resource('settings/economic-sectors', 'EconomicSectorController');

        /*----------  Routes Settings > Economic sectors  ----------*/
        Route::get('reductions/list', 'ReductionController@list')->name('list-reductions');
        Route::resource('settings/reductions', 'ReductionController');

        /**
         *  Personal firm routes
         */
        Route::get('personal-firms/list', 'PersonalFirmController@list');
        Route::resource('settings/personal-firms', 'PersonalFirmController');

        /**
         * Finance Accounts
         */
        Route::get('accounts/list', 'AccountController@list');
        Route::resource('settings/accounts', 'AccountController');

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

    /**
     * Routes available for admin, chief of inspection, inspectors and superintendent
     */
    Route::group(['middleware' => 'has.role:admin|chief-liquidation|inspector|superintendent|analyst|chief-inspection'], function() {
        /*----------  Routes economic activities  ----------*/
        Route::get('economic-activities/list', 'EconomicActivityController@list')->name('list-economic-activities');
        Route::resource('economic-activities', 'EconomicActivityController');

       /*----------  Routes parishes  ----------*/
        Route::get('parishes/list', 'ParishController@list')->name('list-parishes');
        Route::resource('geographic-area/parishes', 'ParishController');

        /*----------  Routes communities  ----------*/
        Route::get('communities/list', 'CommunityController@list')->name('list-communities');
        Route::resource('geographic-area/communities', 'CommunityController');
    });

    /**
    * Cashbox's routes
     */
    Route::group(['middleware' => 'has.role:liquidator|superintendent|admin|auditor|collection-chief|liquidation-chief|collector'], function() {
        Route::get('cashbox', 'Cashbox')->name('cashbox');

        /**
         * Handle reports
         */
        Route::post('reports/payment-report', 'ReportController@printPaymentReport')
            ->name('print.payments.report');
        Route::get('reports/payments', 'ReportController@payments')->name('report.payments');
        Route::get('reports/taxpayers/print', 'ReportController@printTaxpayersReport');
        Route::get('reports', 'ReportController@index')->name('reports');

        /**
         * Licenses
         */
        Route::get('taxpayers/{taxpayer}/economic-activity-licenses', 'LicenseController@index')
            ->name('taxpayer.economic-activity-licenses');
        Route::get('taxpayers/{taxpayer}/economic-activity-licenses/list', 'LicenseController@list');
        Route::get('economic-activity-licenses/{license}/download', 'LicenseController@download');
        Route::post('taxpayers/{taxpayer}/economic-activity-licenses/create', 'LicenseController@store')
            ->name('economic-activity-license.create');

        /**
         * Settlements' routes module
         */
        Route::get('settlements/list', 'SettlementController@list');
        Route::get('settlements/list-null', 'SettlementController@onlyNull');
        Route::get('cashbox/null-settlements', 'SettlementController@showNullSettlements')->name('null.settlements');
        Route::get('affidavits/{settlement}/normal', 'AffidavitController@normalCalcForm')
            ->name('settlements.show');
        Route::get('affidavits/{settlement}/group', 'AffidavitController@groupActivityForm')
            ->name('affidavits.group');
        Route::resource('cashbox/settlements', 'SettlementController');

        /*
        * Payment's routes modules
         */
        Route::get('payments/list-null', 'PaymentController@onlyNull');
        Route::get('payments/list', 'PaymentController@list');
        Route::get('cashbox/payments/{payment}/download', 'PaymentController@download');
        Route::get('cashbox/null-payments', 'PaymentController@showNullPayments')->name('null.payments');
        Route::resource('cashbox/payments', 'PaymentController');
    });

    /**
     * Only available for certain permissions
     */
    Route::group(['middleware' => 'can:create.taxpayers'], function() {
        /**
         * List communities and municipalities
         */
        Route::get('parishes/{id}/communities', 'ParishController@getCommunities');
        Route::get('state/{id}/municipalities', 'StateController@getMunicipalities');
    });

    /**
     * Handle settlements and payments
     */
    Route::post('settlements/{taxpayer}/create', 'AffidavitController@create')->name('settlements.create');

    /*----------  Routes representations ----------*/
    Route::group(['middleware' => 'can:add.representations'], function () {
        Route::post('people/{taxpayer}', 'RepresentationController@storePerson')->name('person.store');
        Route::get('taxpayers/{taxpayer}/representation/add', 'RepresentationController@create')->name('representations.add');
        Route::post('taxpayers/{taxpayer}/representation/create', 'RepresentationController@store')->name('representation.store');
    });
    Route::resource('representations', 'RepresentationController')->except(['create', 'store']);

    /*----------  Routes taxpayers ----------*/
    Route::get('taxpayers/list', 'TaxpayerController@list')->name('list-taxpayers');
    Route::group(['middleware' => 'can:add.economic-activities'], function () {
        Route::get('taxpayer/{taxpayer}/economic-activities/add', 'TaxpayerController@activitiesForm')->name('add.activities');
        Route::post('taxpayer/{taxpayer}/add-economic-activities', 'TaxpayerController@addActivities')->name('taxpayer-activities.store');
    });

    /**
     * Taxpayer's routes
     */
    Route::get('taxpayers/{taxpayer}/affidavits/{settlement}/download', 'AffidavitController@download');
    Route::get('taxpayers/{taxpayer}/affidavits/download', 'TaxpayerController@downloadAffidavits');
    Route::get('taxpayers/{taxpayer}/affidavits/list', 'AffidavitController@listAffidavits');
    Route::get('affidavits/{settlement}', 'AffidavitController@show')->name('affidavits.show');
    Route::get('taxpayers/{taxpayer}/affidavits', 'AffidavitController@index')->name('affidavits.index');
    Route::resource('taxpayers', 'TaxpayerController');
});
