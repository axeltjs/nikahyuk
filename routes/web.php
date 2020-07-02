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

Route::get('/', 'HomePageController@index');
Route::get('promo/{id}', 'HomePageController@promo');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'Admin\HomeController@index')->name('home');
    Route::get('/profile', 'Admin\UserController@profileView')->name('profile');
    Route::post('/profile/update', 'Admin\UserController@profilePost')->name('profile.update');

    Route::get('chat/unread-notification', 'Admin\ChatController@getUnreadNotification')->name('chat.unread-notification');
    Route::resource('transaction', 'Admin\TransactionController');
    Route::get('quotation/{id}', 'Admin\QuotationController@show');
    Route::get('invoice/{id}', 'Admin\InvoiceController@show');
    Route::get('invoice/cetak/{id}', 'Admin\InvoiceController@cetakInvoice');
    Route::get('customer/survey/{id}', 'Admin\SurveyController@show');

    Route::get('customer/quotation/{id}', 'Admin\QuotationController@show');
    
    Route::group(['middleware' => 'role:Customer'], function () {
        Route::get('customer/survey', 'Admin\SurveyController@index')->name('customer.survey');
        Route::post('customer/survey/update', 'Admin\SurveyController@updateSurvey')->name('customer.survey.update');
        Route::get('customer/survey/search-vendor', 'Admin\SurveyController@searchVendor')->name('customer.survey.search-vendor');

        Route::get('customer/chat', 'Admin\ChatController@index')->name('customer.chat.index');
        Route::get('customer/chat/get-all-message', 'Admin\ChatController@getAllMessage')->name('customer.chat.get-all-message');
        Route::post('customer/chat/send-message', 'Admin\ChatController@sendMessage')->name('customer.chat.send-message');
       
        Route::post('invoice/upload-pembayaran', 'Admin\InvoiceController@uploadPembayaran');
        Route::post('customer/rate/vendor', 'Admin\RatingController@postReview')->name('customer.rate.vendor');
        Route::post('customer/deal','Admin\TransactionController@dealTransaction')->name('customer.deal');
    });

    Route::group(['middleware' => 'role:Vendor'], function () {
        Route::get('vendor/setup', 'Admin\SetupController@index')->name('vendor.setup');
        Route::post('vendor/setup/update', 'Admin\SetupController@updateSetup')->name('vendor.setup.update');
        Route::resource('vendor/quotation', 'Admin\QuotationController');
        Route::get('vendor/get/client/budget','Admin\QuotationController@getClientBudget')->name('vendor.get.client.budget');

        Route::get('vendor/chat', 'Admin\ChatVendorController@index')->name('vendor.chat.index');
        Route::get('vendor/chat/get-all-message', 'Admin\ChatVendorController@getAllMessage')->name('vendor.chat.get-all-message');
        Route::post('vendor/chat/send-message', 'Admin\ChatVendorController@sendMessage')->name('vendor.chat.send-message');
        Route::post('vendor/transaction/deal', 'Admin\TransactionController@dealFromVendor')->name('vendor.transaction.deal');

        Route::resource('vendor/promotion', 'Admin\PromotionController');
    });

    Route::group(['middleware' => 'role:Admin'], function () {
        Route::resource('admin/user', 'Admin\UserController');
        Route::resource('admin/vendor/validation', 'Admin\VendorValidationController')->only(['index', 'show', 'update']);
        Route::resource('admin/payment/validation', 'Admin\PaymentValidationController')->only(['index']);
        Route::resource('admin/banner', 'Admin\BannerController');
        
        Route::post('admin/payment/validation/confirmation', 'Admin\PaymentValidationController@confirm')->name('admin.payment.validation.confirmation');
        
        Route::post('admin/promotion/approval', 'Admin\PromotionController@approval')->name('admin.promotion.approval');
        Route::get('admin/promotion', 'Admin\PromotionController@approvalList')->name('admin.promotion');

        // Laporan

        Route::get('/admin/laporan/user', 'Admin\LaporanController@user')->name('admin.laporan.user');
        Route::get('/admin/laporan/vendor', 'Admin\LaporanController@vendor')->name('admin.laporan.vendor');
        
        Route::get('/admin/laporan/user/cetak/{id}', 'Admin\LaporanController@userCetak')->name('admin.laporan.user.cetak');
        Route::get('/admin/laporan/vendor/cetak/{id}', 'Admin\LaporanController@vendorCetak')->name('admin.laporan.vendor.cetak');
        Route::get('admin/laporan/item-acara','Admin\LaporanController@itemAcara')->name('admin.laporan.item-acara');
        Route::get('admin/laporan/item-acara/cetak','Admin\LaporanController@itemAcaraCetak');
    });

    Route::group(['middleware' => 'role:Admin|Vendor'], function () {
        Route::get('laporan/transaksi','Admin\LaporanController@transaksi')->name('laporan.transaksi');
        Route::get('laporan/transaksi/cetak','Admin\LaporanController@cetakTransaksi')->name('laporan.transaksi.cetak');
        Route::get('laporan/transaksi/{id}', 'Admin\LaporanController@cetakTransaksiTunggal')->name('laporan.transaksi.tunggal');
    });
});
