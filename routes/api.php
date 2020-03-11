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

Route::group(['middleware' => 'auth:airlock'], function () {


    Route::get('user', 'UserController@index');
    Route::get('user/companies', 'UserController@companies');

    Route::patch('settings/profile', 'Settings\UpdateProfile');
    Route::patch('settings/password', 'Settings\UpdatePassword');

    Route::get('orders', 'OrderController@index');
    Route::post('orders', 'OrderController@store');
    Route::put('orders/{order}', 'OrderController@update');
    Route::get('orders/{order}', 'OrderController@show');

    Route::get('product/cost', 'ProductController@cost');

    Route::get('companies', 'CompanyController@index');
    Route::get('invoices', 'InvoiceController@index');

    Route::get('quotes', 'QuoteController@index');
    Route::post('quotes/price', 'QuoteController@price');
    Route::post('quotes/submit', 'QuoteController@bulkSubmit');
    Route::get('quotes/{quote}', 'QuoteController@show');
    Route::put('quotes/{quote}', 'QuoteController@update');
    Route::post('quotes', 'QuoteController@store');
    Route::delete('quotes/{quote}', 'QuoteController@delete');


    Route::post('quotes/{quote}/customer-quotes', 'CustomerQuoteController@store');

    Route::get('customer-quotes', 'CustomerQuoteController@index');
    Route::put('customer-quotes/{customerQuote}', 'CustomerQuoteController@update');
    Route::delete('customer-quotes/{customerQuote}', 'CustomerQuoteController@delete');


    Route::post('orders/{order}/invoices', 'InvoiceController@store');
    Route::put('invoices/{invoice}', 'InvoiceController@update');

});


