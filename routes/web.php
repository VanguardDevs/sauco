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

Route::view('/{route?}', 'app')->where('route', '.*');

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
    
    // API ROUTES
    Route::get('api/taxpayers/{taxpayer}/representations', 'TaxpayerController@getRepresentations');
    Route::get('api/affidavits/{affidavit}', 'AffidavitController@show')->name('affidavitApi');
    Route::get('api/taxpayers/{taxpayer}/economic-activities', 'TaxpayerController@economicActivities');
    Route::get('api/taxpayers/{taxpayer}', 'TaxpayerController@show')->name('taxpayer.profile');

    /**
     * Only Admin routes
     */
    Route::group(['middleware' => ['has.role:admin']], function () {
        /** General Settings */
        Route::get('settings', 'ShowSettings')->name('settings');

        Route::get('reports/null-payments', 'ReportController@showNullPayments')->name('null.payments');
        /**
        * Settings > Years
        */
        Route::resource('settings/years', 'YearController');

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

        /**
         * Routes Settings > Concepts
         */
        Route::get('concepts/list', 'ConceptController@list')->name('list-concepts');
        Route::resource('settings/concepts', 'ConceptController');

        /**
         * Routes Settings > Concepts
         */
        Route::get('categories/list', 'CategoryController@list')->name('list-concepts');
        Route::resource('settings/categories', 'CategoryController');

        /*----------  Routes Settings > Tax Units ----------*/
        Route::get('tax-units/list', 'TaxUnitController@list')->name('list-tax-units');
        Route::resource('settings/tax-units', 'TaxUnitController');

        /*----------  Routes permissions  ----------*/
        Route::get('permissions/list', 'Settings\PermissionController@list');
        Route::resource('settings/administration/permissions', 'Settings\PermissionController');

        /*----------  Routes roles  ----------*/
        Route::get('roles/list', 'Settings\RoleController@list');
        Route::resource('settings/administration/roles', 'Settings\RoleController');

        /*----------  Routes users  ----------*/
        Route::get('users/list', 'Settings\UserController@list');
        Route::resource('settings/administration/users', 'Settings\UserController');

        /*---------- Accounting accounts --------*/
        Route::resource('settings/accounting-accounts', 'AccountingAccountController');
 
        Route::get('settings/invoice-models', 'InvoiceModelController@index')
            ->name('invoice-models.index');
    });
 
    /**
     * Routes available for admin, chief of inspection, inspectors and superintendent
     */
    /*----------  Routes economic activities  ----------*/
    Route::get('economic-activities/list', 'EconomicActivityController@list')->name('list-economic-activities');
    Route::get('economic-activities/{activity}/taxpayers/list', 'EconomicActivityController@listTaxpayers');
    Route::resource('economic-activities', 'EconomicActivityController');

    /*----------  Routes communities  ----------*/
    Route::get('communities/list', 'CommunityController@list')->name('list-communities');
    Route::get('geographic-area/communities/{community}/taxpayers/list', 'CommunityController@listTaxpayers');
    Route::resource('geographic-area/communities', 'CommunityController');

    // Organization routes
    Route::get('organization', 'OrganizationController@index')->name('organization.index');
    Route::get('organization/withholdings', 'OrganizationController@withholdings')->name('organization.withholdings');

    /**
     * Handle reports
     */
    Route::group(['middleware' => 'can:print.reports'], function() {
        Route::post('reports/payment-report', 'ReportController@printPaymentReport')
            ->name('print.payments.report');
        Route::get('economic-activities/{activity}/download', 'ReportController@printActivityReport')
            ->name('print.activity-report');
        Route::get('reports/taxpayers/print', 'ReportController@printTaxpayersReport')
            ->name('print.taxpayers');
        Route::get('reports/activities/print', 'ReportController@printActivitiesReport')
            ->name('print.activities');
        Route::get('reports/economic-activity-licenses/print-list', 'ReportController@printLicensesList')
            ->name('economic-activity-licenses.print-list');
        Route::get('reports/taxpayers/up-to-date/print', 'ReportController@printUpToDate')
            ->name('print.uptodate.taxpayers');
    });
    Route::get('payments/list-null', 'PaymentController@onlyNull');
    Route::get('payments/processed/list', 'PaymentController@listProcessed');
    Route::get('reports/payments', 'ReportController@payments')->name('report.payments');
    Route::get('reports/taxpayers/up-to-date/list', 'ReportController@listUpToDate');
    Route::get('reports/taxpayers/up-to-date', 'ReportController@showUpToDateTaxpayers')->name('taxpayers.uptodate');
    Route::get('reports', 'ReportController@index')->name('reports');

    /**
     * Licenses
     */
    Route::group(['middleware' => 'can:create.licenses'], function() {
        Route::get('economic-activity-licenses/{license}/download', 'LicenseController@download');
        Route::post('taxpayers/{taxpayer}/economic-activity-licenses/create', 'LicenseController@store')
            ->name('economic-activity-license.create');
    });
    Route::get('taxpayers/{taxpayer}/economic-activity-licenses', 'LicenseController@show')
        ->name('taxpayer.economic-activity-licenses');
    Route::get('taxpayers/{taxpayer}/economic-activity-licenses/list', 'LicenseController@listByTaxpayer');
    Route::resource('licenses', 'LicenseController');

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
    Route::get('applications/{application}/payment/new', 'ApplicationController@makePayment')
        ->middleware('can:process.payments');
    Route::resource('taxpayers/{taxpayer}/applications', 'ApplicationController');

    /**
     * Taxpayer's old payments
     */
    Route::get('taxpayers/{taxpayer}/old-payments', 'OldPaymentController@index')
        ->name('taxpayer.old-payments');

    /**
     * Taxpayer's permits
     */
    Route::get('taxpayers/{taxpayer}/permits/list', 'PermitController@list');
    Route::resource('taxpayers/{taxpayer}/permits', 'PermitController');
    
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
    Route::get('taxpayers/{taxpayer}/affidavits/list', 'AffidavitController@listAffidavits');
    Route::get('taxpayers/{taxpayer}/payments', 'PaymentController@listByTaxpayer');
    Route::get('taxpayers/{taxpayer}/payments/{payment}', 'PaymentController@showTaxpayerPayment');
    Route::get('taxpayers/{taxpayer}/affidavits', 'AffidavitController@index')->name('affidavits.index');
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
});
