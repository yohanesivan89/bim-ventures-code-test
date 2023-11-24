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
    return redirect(route('login'));
});

Route::get('login', 'AuthController@index')->name('login');
Route::post('login/check', 'AuthController@checkLogin')->name('login.check');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::get('member/dashboard', 'DashboardMemberController@index')->name('member.dashboard');

Route::get('admin/dashboard', 'DashboardAdminController@index')->name('admin.dashboard');

Route::get('admin/transaction/create', 'TransactionAdminController@createView')->name('admin.create.view');
Route::post('admin/transaction/post', 'TransactionAdminController@addTransaction')->name('admin.create.post');

Route::get('admin/payment/detail/{id}', 'PaymentAdminController@detailView')->name('admin.payment.detail');
Route::post('admin/payment/add', 'PaymentAdminController@createPayment')->name('admin.payment.create');
