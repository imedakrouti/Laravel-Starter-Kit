<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Dahboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "auth" middleware group. Now create something great!
|
*/
route::prefix('dashboard')
->name('dashboard.')
->middleware(['auth','verified'])
->group(function(){
//home route
Route::get('/', 'HomeController@index')->name('home');
Route::resource('/roles','RoleController');
});

