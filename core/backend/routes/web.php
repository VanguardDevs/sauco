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

    /**
     * Handle reports
     */
    Route::group(['middleware' => 'can:print.reports'], function() {
        Route::post('reports/affidavits', 'ReportController@printAffidavitsReport')
            ->name('print.affidavits.report');
        Route::post('reports/payment-report', 'ReportController@printPaymentReport')
            ->name('print.payments.report');
        Route::get('economic-activities/{activity}/download', 'ReportController@printActivityReport')
            ->name('print.activity-report');
        Route::get('reports/taxpayers/print', 'ReportController@printTaxpayersReport')
            ->name('print.taxpayers');
        Route::get('reports/activities/print', 'ReportController@printActivitiesReport')
            ->name('print.activities');
        Route::get('reports/taxpayers/up-to-date/print', 'ReportController@printUpToDate')
            ->name('print.uptodate.taxpayers');

        Route::get('reports/delinquent-companies', 'ReportController@delinquentCompanies')
            ->name('reports.delinquent-companies');
    });
    Route::get('payments/processed/list', 'PaymentController@listProcessed');
    Route::get('reports/payments', 'ReportController@payments')->name('report.payments');
    Route::get('reports/taxpayers/up-to-date/list', 'ReportController@listUpToDate');
    Route::get('reports/taxpayers/up-to-date', 'ReportController@showUpToDateTaxpayers')->name('taxpayers.uptodate');
    Route::get('reports', 'ReportController@index')->name('reports');

    /**
     * Licenses
     */
    Route::group(['middleware' => 'can:create.licenses'], function() {
        Route::get('licenses/{license}/download', 'LicenseController@download');
        Route::post('taxpayers/{taxpayer}/economic-activity-licenses/create', 'LicenseController@store')
            ->name('economic-activity-license.create');
    });
    Route::get('taxpayers/{taxpayer}/economic-activity-licenses', 'LicenseController@create')
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
     * Taxpayer's permits
     */
    Route::get('taxpayers/{taxpayer}/permits/list', 'PermitController@list');
    Route::resource('taxpayers/{taxpayer}/permits', 'PermitController');

    /**
     * Taxpayer's Deductions
     */
    Route::get('taxpayers/{taxpayer}/deductions', 'DeductionController@index')
        ->name('deductions.index');
    Route::get('taxpayers/{taxpayer}/deductions/list', 'DeductionController@list');
    Route::resource('deductions', 'DeductionController');

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
});
