<?php

use App\Customer;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/dashboard/getReport', 'HomeController@getReport')->name('getReport');
Route::get('/dashboard', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/report/getReport', 'ReportController@getReport')->name('getReport');
Route::resource('report', 'ReportController');

Route::get('/customer/getCustomer', 'CustomerController@getCustomer')->name('getCustomer');
Route::resource('customer', 'CustomerController');
