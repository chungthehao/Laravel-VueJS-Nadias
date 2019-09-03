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

Auth::routes(['verify' => true]); // Tạo ra 3 routes có tên: verification.resend/notice/verify

# Middleware 'verified' đá ng dùng qua http://dev.nadias/email/verify nếu email chưa đc verify
Route::get('/', 'HomeController@index')->name('home');//->middleware('verified');

Route::get('/categories', 'CategoryController@index');

Route::get('/menu-editor/{any?}', 'AdminController@menu')
    ->middleware('can:edit-menu')
    ->where('any', '.*');