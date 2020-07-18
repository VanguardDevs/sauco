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
 * Auth routes
 */
Route::post('/login', 'Auth\LoginController@login');

Route::resource('old-payments', 'OldPaymentController');
Route::resource('invoice-models', 'InvoiceModelController');
Route::resource('organization', 'OrganizationController');
Route::resource('taxpayers/{taxpayer}/withholdings', 'WithholdingController');
Route::get('withholdings-months', 'WithholdingController@months');
