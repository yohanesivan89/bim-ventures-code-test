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

Route::get('', function(){
    return redirect(route('dashboard'));
});

Route::get('login', 'AuthController@index')->name('login');
Route::post('login/check', 'AuthController@checkLogin')->name('login.check');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::get('dashboard', 'DashboardController@index')->name('dashboard');
Route::post('dashboard/ajax', 'DashboardController@ajaxData')->name('dashboard.ajax');

Route::get('laporan', 'LaporanController@index')->name('laporan.view');
Route::get('ajax/modal', 'LaporanController@ajaxModalData')->name('laporan.modalchart');

Route::group(['middleware' => ['adminrole']], function () {
    Route::get('unknown', 'UnknownController@index')->name('unknown');
    Route::post('delete/unknown', 'UnknownController@ajaxDelete')->name('unknown.delete');

    Route::get('device', 'DeviceController@index')->name('device.view');
    Route::get('device/detail', 'DeviceController@getDetail')->name('device.detail');
    Route::post('device/update', 'DeviceController@updateDevice')->name('device.update');
    Route::post('device/create', 'DeviceController@create')->name('device.create');
    Route::post('device/delete', 'DeviceController@delete')->name('device.delete');

    Route::get('cabang', 'CabangController@index')->name('cabang.view');
    Route::post('cabang/create', 'CabangController@create')->name('cabang.create');

    Route::get('user', 'UserController@index')->name('user.view');
    Route::post('user/create', 'UserController@create')->name('user.create');

    Route::get('settings', 'SettingsController@index')->name('setting.view');
    Route::post('settings/save', 'SettingsController@save')->name('setting.create');
});
