<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('login');
Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register'])->name('register'); */
Route::post('verify/{userId}', [\App\Http\Controllers\Api\AuthController::class, 'verify'])->name('verify');

Route::prefix('package')->name('package.')->group(function () {
    Route::get('', [\App\Http\Controllers\Api\PackageController::class, 'index'])->name('index');
    Route::get('show/{id}', [\App\Http\Controllers\Api\PackageController::class, 'show'])->name('show');
});

Route::prefix('contact')->name('contact.')->group(function () {
    Route::post('store', [\App\Http\Controllers\Api\ContactController::class, 'store'])->name('store');
});

Route::prefix('subject')->name('subject.')->group(function () {
    Route::get('', [\App\Http\Controllers\Api\SubjectController::class, 'index'])->name('index');
    Route::get('show/{id}', [\App\Http\Controllers\Api\SubjectController::class, 'show'])->name('show');
});

Route::prefix('post')->name('post.')->group(function () {
    Route::get('', [\App\Http\Controllers\Api\PostController::class, 'index'])->name('index');
    Route::get('show/{id}', [\App\Http\Controllers\Api\PostController::class, 'show'])->name('show');
});

Route::fallback(function() {
    return response()->json([
        'data' => [],
        'success' => false,
        'status' => 404,
        'message' => 'Invalid Route'
    ]);
});
