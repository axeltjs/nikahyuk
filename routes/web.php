<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'Admin\HomeController@index')->name('home');

    Route::group(['middleware' => 'role:Customer'], function () {
        Route::get('customer/survey', 'Admin\SurveyController@index')->name('customer.survey');
        Route::post('customer/survey/update', 'Admin\SurveyController@updateSurvey')->name('customer.survey.update');
    });

    Route::group(['middleware' => 'role:Vendor'], function () {
        Route::get('vendor/setup', 'Admin\SetupController@index')->name('vendor.setup');
        Route::post('vendor/setup/update', 'Admin\SetupController@updateSetup')->name('vendor.setup.update');
        Route::resource('vendor/quotation', 'Admin\QuotationController');
        Route::get('vendor/get/client/budget','Admin\QuotationController@getClientBudget')->name('vendor.get.client.budget');
    });
});
