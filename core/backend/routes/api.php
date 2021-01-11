<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    // Only admin
    Route::group(['middleware' => ['permission:access.settings']], function () {
        Route::resource('charging-methods', 'ChargingMethodController');
        Route::resource('years', 'YearController');
        Route::resource('concepts', 'ConceptController');
        Route::resource('payment-methods', 'PaymentMethodController');
        Route::resource('payment-types', 'PaymentTypeController');
        Route::resource('representation-types', 'RepresentationTypeController');
        Route::resource('taxpayer-types', 'TaxpayerTypeController');
        Route::resource('taxpayer-classifications', 'TaxpayerClassificationController');
        Route::resource('status', 'StatusController');
        Route::resource('tax-units', 'TaxUnitController');
        Route::resource('brands', 'BrandController');
        Route::resource('colors', 'ColorController');
        Route::resource('users', 'UserController');
        Route::resource('ordinances', 'OrdinanceController');
    });

    Route::resource('economic-activities', 'EconomicActivityController')
        ->middleware('permission:access.economic-activities');

    // Controlled level permissions
    Route::resource('liquidation-types', 'LiquidationTypeController');
    Route::resource('states', 'StateController');
    Route::resource('municipalities', 'MunicipalityController');
    Route::resource('communities', 'CommunityController');
    Route::resource('parishes', 'ParishController');
    Route::resource('license', 'LicenseController');
    Route::resource('taxpayers', 'TaxpayerController');
    Route::resource('companies', 'CompanyController');
    Route::resource('accounts', 'AccountController');
    Route::resource('accounting-accounts', 'AccountingAccountController');
    Route::resource('account-types', 'AccountTypeController');
});
