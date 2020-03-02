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
    return view('main');
});

Auth::routes(['register' => false]);

Route::post('/api/mpc', 'MainPageComponentController@api')->name('mpc_api');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/index', 'AdminController@index')->middleware('admin')->name('admin_index');
// Route::get('/admin/mpc/index', 'MainPageComponentController@index')->middleware(['admin','web'])->name('admin_mpc_index');
// Route::get('/admin/mpc/create', 'MainPageComponentController@create')->middleware(['admin','web'])->name('admin_mpc_create');
// Route::post('/admin/mpc/store', 'MainPageComponentController@store')->middleware(['admin','web'])->name('admin_mpc_store');
// Route::get('/admin/mpc/edit/{id}', 'MainPageComponentController@edit')->middleware(['admin','web'])->name('admin_mpc_edit');
Route::resource('MainPageComponent','MainPageComponentController')->middleware('admin');
