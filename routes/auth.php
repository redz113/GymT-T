<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Http\Request;
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

Route::get('signup', [AuthController::class, 'signup'])->middleware('guest')->name('signup');
Route::post('/postSignup', [AuthController::class, 'postSignup'])->middleware('guest')->name('postSignup');
Route::get('login', [\App\Http\Controllers\Auth\AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/postLogin', [AuthController::class, 'postLogin'])->middleware('guest')->name('postLogin');
Route::get('very_email/{email}', [AuthController::class, 'very_email'])->middleware('guest')->name('very_email');
Route::post('post_very_email/{email}', [AuthController::class, 'post_very_email'])->middleware('guest')->name('post_very_email');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('reset-password/{email}', [AuthController::class, 'resetPassword'])->middleware('guest')->name('resetPassword');
Route::post('reset-password/{email}', [AuthController::class, 'postResetPassword'])->middleware('guest')->name('postResetPassword');
Route::get('forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest')->name('forgotPassword');
Route::post('forgot-password', [AuthController::class, 'postForgot'])->middleware('guest')->name('postForgot');
/**
 * Users verify email Route
 */    
/* Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed'])->name('verification.verify');

Route::post('/email/verification-notification',  [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send'); */
