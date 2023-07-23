<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', 'AuthController@createUser');
Route::post('/login', 'AuthController@loginUser');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/change-password', 'Auth\ResetPasswordController@reset');
Route::post('email/verification-notification', 'Auth\EmailVerificationController@sendVerificationEmail')->middleware('auth:sanctum');
Route::get('email/verify/{id}/{hash}', 'Auth\EmailVerificationController@verify')->name('verification')->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum','role:admin|super_admin',])
->group(function(){
//home route
//Route::get('/', 'HomeController@index')->name('home');
Route::get('/roles','RoleController@index');
});
