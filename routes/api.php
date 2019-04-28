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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', 'Auth\LoginController@logout');

    Route::get('user', 'UserController@index');
    Route::get('user/companies', 'UserController@companies');

    Route::patch('settings/profile', 'Settings\UpdateProfile');
    Route::patch('settings/password', 'Settings\UpdatePassword');

    Route::get('orders', 'OrderController@index');
    Route::post('orders', 'OrderController@store');
    Route::put('orders/{order}', 'OrderController@update');

    Route::get('product/cost', 'ProductController@cost');

    Route::get('companies', 'CompanyController@index');
    Route::get('invoices', 'InvoiceController@index');

    Route::get('quotes', 'QuoteController@index');
    Route::post('quotes/price', 'QuoteController@price');
    Route::get('quotes/{quote}', 'QuoteController@show');
    Route::post('quotes', 'QuoteController@store');
   

    Route::post('quotes/{quote}/customer-quotes', 'CustomerQuoteController@store');

    Route::get('customer-quotes', 'CustomerQuoteController@index');
    Route::put('customer-quotes/{customerQuote}', 'CustomerQuoteController@update');
    Route::delete('customer-quotes/{customerQuote}', 'CustomerQuoteController@delete');

});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

});
