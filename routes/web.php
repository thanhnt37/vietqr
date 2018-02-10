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

Route::get('/', function () {
    return redirect()->route('guarantee.dashboard');
})->middleware('auth');

Route::get('view/{code}', 'AppViewController@view');
Route::post('guarantees/user-active', 'GuaranteeController@userActive')->name('guarantee.user-active');
Route::post('user-active-cg', 'CodeController@cgActive')->name('guarantee.user-active-cg');
Route::get('search', 'CodeController@searchCode')->name('guarantee.search-code');

Route::group(['middleware' => ['auth', 'notservice:guarantee']], function () {
    Route::get('businesses/register', 'RegisterBusinessController@showFormRegister')->name('business.register');
    Route::post('businesses', 'RegisterBusinessController@register')->name('business.store');
});

Route::group(['middleware' => ['auth', 'service:guarantee']], function () {
    Route::get('dashboard', 'DashboardController@dashboard')->name('guarantee.dashboard');
    Route::get('setting', 'SettingController@setting')->name('guarantee.setting');
    Route::put('setting', 'SettingController@update')->name('guarantee.update');
    Route::get('products', 'ProductController@showList')->name('guarantee.product.list');
    Route::post('products', 'ProductController@insert')->name('guarantee.product.insert');
    Route::delete('products/delete', 'ProductController@deleteAll')->name('guarantee.product.deleteall');
    Route::get('products/{product}/edit', 'ProductController@edit')->name('guarantee.product.edit');
    Route::put('products/{product}', 'ProductController@update')->name('guarantee.product.update');
    Route::delete('products/{product}', 'ProductController@delete')->name('guarantee.product.delete');
    Route::get('agencies', 'AgencyController@showList')->name('guarantee.agency.list');
    Route::post('agencies', 'AgencyController@insert')->name('guarantee.agency.insert');
    Route::delete('agencies/delete', 'AgencyController@deleteAll')->name('guarantee.agency.deleteall');
    Route::get('agencies/{agency}/edit', 'AgencyController@edit')->name('guarantee.agency.edit');
    Route::put('agencies/{agency}', 'AgencyController@update')->name('guarantee.agency.update');
    Route::delete('agencies/{agency}', 'AgencyController@delete')->name('guarantee.agency.delete');
    Route::get('codes', 'CodeController@showList')->name('guarantee.code.list');
    Route::post('codes', 'CodeController@insert')->name('guarantee.code.create');
    Route::get('codes/{code}', 'CodeController@show')->name('guarantee.code.show');
    Route::delete('codes/delete', 'CodeController@deleteAll')->name('guarantee.code.deleteall');
    Route::get('codes/{code}/edit', 'CodeController@edit')->name('guarantee.code.edit');
    Route::put('codes/{code}', 'CodeController@update')->name('guarantee.code.update');
    Route::delete('codes/{code}', 'CodeController@delete')->name('guarantee.code.delete');
    Route::post('codes/{code}/histories', 'CodeController@history')->name('guarantee.code.history');
    Route::get('batches', 'BatchController@showList')->name('guarantee.batch.list');
    Route::post('batches', 'BatchController@create')->name('guarantee.batch.create');
    Route::get('batches/{batch}', 'BatchController@show')->name('guarantee.batch.show');
    Route::put('batches/{batch}', 'BatchController@update')->name('guarantee.batch.update');
    Route::delete('batches/delete', 'BatchController@deleteAll')->name('guarantee.batch.deleteall');
    Route::get('exportcode', 'ExportCodeController@all')->name('guarantee.exportcode');
    Route::get('exportcode/{export}/download', 'ExportCodeController@download')->name('guarantee.exportcode.download');
    Route::any('exportcode/{export}/delete', 'ExportCodeController@delete')->name('guarantee.exportcode.delete');
    Route::get('guarantees', 'GuaranteeController@index')->name('guarantee.mamagement');
    Route::post('guarantees/active', 'GuaranteeController@active')->name('guarantee.active');
    Route::get('businesses', 'BusinessController@information')->name('business.information');
    Route::get('businesses/{business}/qrcode', 'BusinessController@qrcode')->name('business.qrcode');
    Route::get('businesses/{business}/download-qrcode', 'BusinessController@download')->name('business.qrcode.download');
    Route::get('customers', 'CustomerController@getList')->name('customer.list');
});

Auth::routes();

Route::group(['namespace' => 'Ajax', 'prefix' => 'ajax'], function () {
    Route::get('codes/{code}/active', 'CodeController@active')->name('ajax.code.active');
    Route::get('daily-active-log', 'StatisticsController@dailyActiveLog')->name('ajax.dailyactivelog');
    Route::get('daily-guarantee-count-log', 'StatisticsController@dailyGuaranteeCountLog')->name('ajax.dailyguaranteecountlog');
    Route::post('export', 'ExportController@export')->name('guarantee.export');
    Route::post('tutorial/update-business/remind', 'UserTutorialController@remindUpdateBusiness')->name('ajax.tutorial.remind-update-business');
});

Route::group(['domain' => 'sms.vietqr.vn'], function () {
    Route::get('guarantee', 'Api\SmsController@active');
});
