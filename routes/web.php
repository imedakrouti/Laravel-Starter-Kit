<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyMobileController;

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
    return view('welcome');
});
Route::middleware('auth')->group(function () {


    Route::view('verify-mobile','auth.verify-mobile')->name('verification-mobile.notice');

    Route::post('verify-mobile', [VerifyMobileController::class, '__invoke'])
                ->middleware(['throttle:6,1'])
                ->name('verification.verify-mobile');


});

Auth::routes(['verify' => true]);



