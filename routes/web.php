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

Route::get('/error',function() {
    return view('error');
})->name('403');

//NewsController
Route::get('/', 'news@index')->name('home');
Route::get('category/{id}', 'news@show')->name('category');
Route::get('news/{id}', 'news@newsDetail')->name('newsdetail');

//AdminController
// Route::get('admin', 'admin@index')->name('admin');
Route::get('admin', 'admin@managementNews')->name('admin');
Route::get('admin/management', 'admin@managementNews')->name('management');
Route::get('admin/createnews', 'admin@createNews')->name('createNews');
Route::post('admin/createnews', 'admin@createNewsPost')->name('createNews');
Route::get('admin/createadmin', 'admin@createAdmin')->name('createAdmin');
Route::post('admin/createadmin', 'admin@createAdminPost')->name('createAdmin');
Route::get('admin/approvedNews/{id}', 'admin@approveNews')->name('approveNews');
Route::post('admin/approveNews', 'admin@approveNewsPost')->name('approveNewsPost');

//LoginController
Route::get('admin/login', 'login@signin')->name('login');
Route::post('admin/login', 'login@signinPost')->name('loginPost');
Route::get('admin/logout', 'login@logout')->name('logout');