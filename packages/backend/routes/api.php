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

Route::post('login', 'ManageTokenController@login');

Route::middleware('auth:sanctum')->group(function () {
    // /**
    //  * Configurations
    //  */
    Route::get('years', 'YearController@index');
    Route::apiResource('concepts', 'ConceptController');
    Route::apiResource('items', 'ItemController');
    Route::apiResource('purposes', 'PurposeController');
    Route::apiResource('terrain-classifications', 'TerrainClassificationController');
    Route::apiResource('payment-methods', 'PaymentMethodController');
    Route::apiResource('payment-types', 'PaymentTypeController');
    Route::apiResource('representation-types', 'RepresentationTypeController');
    Route::apiResource('tax-units', 'TaxUnitController');
    Route::apiResource('brands', 'BrandController');
    Route::apiResource('models', 'VehicleModelController');
    Route::apiResource('colors', 'ColorController');
    Route::apiResource('users', 'UserController');
    Route::apiResource('vehicle-classification', 'VehicleClassificationController');
    Route::apiResource('vehicle-uses', 'VehicleUseController');
    Route::apiResource('liqueur-zones', 'LiqueurZoneController');
    Route::apiResource('liqueur-classifications', 'LiqueurClassificationController');
    Route::apiResource('liqueur-parametres', 'LiqueurParametreController');
    Route::apiResource('liqueurs', 'LiqueurController');
    Route::apiResource('ordinances', 'OrdinanceController');
    Route::apiResource('charging-methods', 'ChargingMethodController');
    Route::apiResource('economic-activities', 'EconomicActivityController');
    Route::post('economic-activities/upload', 'EconomicActivityController@upload');
    Route::get('economic-activities/{activity}/download', 'EconomicActivityController@download');

    /**
     * Consults
    */
    Route::apiResource('petro-prices', 'PetroPriceController')
        ->except('show');
    Route::get('taxpayer-types', 'TaxpayerTypeController@index');
    Route::get('taxpayer-classifications', 'TaxpayerClassificationController@index');
    Route::get('status', 'StatusController@index');
    Route::get('intervals', 'IntervalController@index');
    Route::get('movements', 'MovementController@index');
    Route::get('closures', 'ClosureController@index');

    // Controlled level permissions
    Route::apiResource('liquidation-types', 'LiquidationTypeController');
    Route::apiResource('states', 'StateController');
    Route::apiResource('municipalities', 'MunicipalityController');
    Route::apiResource('communities', 'CommunityController');
    Route::apiResource('parishes', 'ParishController');
    Route::apiResource('licenses', 'LicenseController');
    Route::apiResource('taxpayers', 'TaxpayerController')
        ->except('destroy');
    Route::apiResource('liquidations', 'LiquidationController');
    Route::apiResource('companies', 'CompanyController');
    Route::apiResource('accounts', 'AccountController');
    Route::apiResource('accounting-accounts', 'AccountingAccountController');
    Route::apiResource('account-types', 'AccountTypeController');
    Route::apiResource('payments', 'PaymentController');
    Route::get('payments/{payment}/download', 'PaymentController@download');
    Route::apiResource('cancellations', 'CancellationController');
    Route::apiResource('cancellation-types', 'CancellationTypeController');
    Route::apiResource('licenses', 'LicenseController');
    Route::apiResource('affidavits', 'AffidavitController');
    Route::apiResource('applications', 'ApplicationController');
    Route::apiResource('fines', 'FineController');
    Route::apiResource('deductions', 'DeductionController');
    Route::apiResource('permissions', 'PermissionController');
    Route::apiResource('properties', 'PropertyController');
    Route::apiResource('vehicles', 'VehicleController');
    Route::apiResource('signatures', 'SignatureController');
    Route::apiResource('roles', 'RoleController');

    /**
     * Consults
    */
    Route::apiResource('petro-prices', 'PetroPriceController')
        ->except('show');
    Route::get('taxpayer-types', 'TaxpayerTypeController@index');
    Route::get('taxpayer-classifications', 'TaxpayerClassificationController@index');
    Route::get('status', 'StatusController@index');
    Route::get('intervals', 'IntervalController@index');
    Route::get('closures', 'ClosureController@index');

     // Account
     Route::post('update-password', 'UpdatePasswordController');
     Route::get('logout', 'ManageTokenController@logout');
});
