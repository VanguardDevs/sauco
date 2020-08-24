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
/**
Route::middleware('auth:api')->group(function () {
    //
});
**/

Route::resource('fiscal-years', 'YearController');
Route::resource('invoice-models', 'InvoiceModelController');
Route::resource('organization', 'OrganizationController');
Route::resource('companies', 'CompanyController');
Route::resource('people', 'PersonController');
Route::resource('licenses', 'LicenseController');

Route::resource('taxpayers/{taxpayer}/withholdings', 'WithholdingController');
Route::get('withholdings-months', 'WithholdingController@months');

