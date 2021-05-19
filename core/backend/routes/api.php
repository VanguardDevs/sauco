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

// Route::middleware('auth:sanctum')->group(function () {
    // Only admin
    // Route::group(['middleware' => ['permission:access.settings']], function () {
        Route::apiResource('years', 'YearController');
        Route::apiResource('concepts', 'ConceptController');
        Route::apiResource('payment-methods', 'PaymentMethodController');
        Route::apiResource('payment-types', 'PaymentTypeController');
        Route::apiResource('representation-types', 'RepresentationTypeController');
        Route::apiResource('taxpayer-types', 'TaxpayerTypeController');
        Route::apiResource('taxpayer-classifications', 'TaxpayerClassificationController');
        Route::apiResource('tax-units', 'TaxUnitController');
        Route::apiResource('brands', 'BrandController');
        Route::apiResource('colors', 'ColorController');
        Route::apiResource('users', 'UserController');
        Route::apiResource('ordinances', 'OrdinanceController');
    // });

    Route::apiResource('economic-activities', 'EconomicActivityController');

    // Controlled level permissions
    Route::apiResource('liquidation-types', 'LiquidationTypeController');
    Route::apiResource('states', 'StateController');
    Route::apiResource('municipalities', 'MunicipalityController');
    Route::apiResource('communities', 'CommunityController');
    Route::apiResource('parishes', 'ParishController');
    Route::apiResource('license', 'LicenseController');
    Route::apiResource('taxpayers', 'TaxpayerController');
    Route::apiResource('liquidations', 'LiquidationController');
    Route::apiResource('companies', 'CompanyController');
    Route::apiResource('accounts', 'AccountController');
    Route::apiResource('accounting-accounts', 'AccountingAccountController');
    Route::apiResource('account-types', 'AccountTypeController');
    Route::apiResource('payments', 'PaymentController');
    Route::apiResource('movements', 'MovementController');
    Route::apiResource('cancellations', 'CancellationController');
    Route::apiResource('cancellation-types', 'CancellationTypeController')
        ->only(['index']);
    Route::apiResource('licenses', 'LicenseController');
    Route::apiResource('affidavits', 'AffidavitController');
    Route::apiResource('applications', 'ApplicationController');
    Route::apiResource('fines', 'FineController');
    Route::apiResource('deductions', 'DeductionController');
    Route::apiResource('petro-prices', 'PetroPriceController')
        ->except(['store', 'update', 'destroy', 'show']);
    Route::get('status', 'StatusController@index');
// });
