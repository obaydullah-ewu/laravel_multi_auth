<?php

use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController as AdminForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController as AdminResetPasswordController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;

use App\Http\Controllers\Merchant\Auth\LoginController as MerchantLoginController;
use App\Http\Controllers\Merchant\Auth\RegisterController as MerchantRegisterController;
use App\Http\Controllers\Merchant\HomeController as MerchantHomeController;

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
Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->group(function () {
    // Login Routes...
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login',  [AdminLoginController::class, 'login']);

    // Logout Routes...
    Route::post('logout',  [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Registration Routes...
    Route::get('register',  [AdminRegisterController::class, 'showRegistrationForm'])->name('admin.register');
    Route::post('register',  [AdminRegisterController::class, 'register']);

    // Password Reset Routes...
    Route::get('password/reset', [AdminForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
    Route::post('password/email', [AdminForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');
    Route::get('password/reset/{token}', [AdminResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
    Route::post('password/reset', [AdminResetPasswordController::class, 'reset'])->name('admin.password.update');


    // Password Confirmation Routes...
    Route::get('password/confirm', 'Admin\Auth\ConfirmPasswordController@showConfirmForm')->name('admin.password.confirm');
    Route::post('password/confirm', 'Admin\Auth\ConfirmPasswordController@confirm');


    // Email Verification Routes...
    Route::get('email/verify', 'Admin\Auth\VerificationController@show')->name('admin.verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Admin\Auth\VerificationController@verify')->name('admin.verification.verify');
    Route::post('email/resend', 'Admin\Auth\VerificationController@resend')->name('admin.verification.resend');

    Route::get('/home', [AdminHomeController::class, 'index'])->name('admin.home');
//    ->middleware('verified')

});

Route::prefix('merchant')->group(function () {
    // Login Routes...
    Route::get('login', [MerchantLoginController::class, 'showLoginForm'])->name('merchant.login');
    Route::post('login', [MerchantLoginController::class, 'login']);

    // Logout Routes...
    Route::post('logout', [MerchantLoginController::class, 'logout'])->name('merchant.logout');


    // Registration Routes...
    Route::get('register', [MerchantRegisterController::class, 'showRegistrationForm'])->name('merchant.register');
    Route::post('register', [MerchantRegisterController::class, 'register']);


    // Password Reset Routes...
    Route::get('password/reset', 'Merchant\Auth\ForgotPasswordController@showLinkRequestForm')->name('merchant.password.request');
    Route::post('password/email', 'Merchant\Auth\ForgotPasswordController@sendResetLinkEmail')->name('merchant.password.email');
    Route::get('password/reset/{token}', 'Merchant\Auth\ResetPasswordController@showResetForm')->name('merchant.password.reset');
    Route::post('password/reset', 'Merchant\Auth\ResetPasswordController@reset')->name('merchant.password.update');


    // Password Confirmation Routes...
    Route::get('password/confirm', 'Merchant\Auth\ConfirmPasswordController@showConfirmForm')->name('merchant.password.confirm');
    Route::post('password/confirm', 'Merchant\Auth\ConfirmPasswordController@confirm');


    // Email Verification Routes...
    Route::get('email/verify', 'Merchant\Auth\VerificationController@show')->name('merchant.verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Merchant\Auth\VerificationController@verify')->name('merchant.verification.verify');
    Route::post('email/resend', 'Merchant\Auth\VerificationController@resend')->name('merchant.verification.resend');

    Route::get('/home', [MerchantHomeController::class, 'index'])->name('merchant.home');
});

