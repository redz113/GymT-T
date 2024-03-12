<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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




Route::get('/list-user', function () {
    return view('screens.backend.user.list-user');
});
Route::get('', [\App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');

Route::prefix('package')->name('package_client.')->group(function () {
    Route::get('', [\App\Http\Controllers\Client\PackageController::class, 'index'])->name('index');
    Route::get('{id}', [\App\Http\Controllers\Client\PackageController::class, 'detail'])->name('detail');
});

Route::prefix('post')->name('post_client.')->group(function () {
    Route::get('', [\App\Http\Controllers\Client\PostController::class, 'index'])->name('index');
    Route::get('{id}', [\App\Http\Controllers\Client\PostController::class, 'detail'])->name('detail');
});

Route::prefix('coach')->name('training.')->group(function () {
    Route::get('', [\App\Http\Controllers\Client\CoachController::class, 'index'])->name('index');
    Route::get('{id}', [\App\Http\Controllers\Client\CoachController::class, 'detail'])->name('detail');
});
Route::prefix('contact')->name('contact_client.')->group(function () {
    Route::get('', [\App\Http\Controllers\Client\ContactController::class, 'view'])->name('view');
    // Route::post('', [\App\Http\Controllers\Client\ContactController::class, 'store'])->name('store');
});

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin'])->name('admin.')->group(function () {
    Route::get('', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');
    Route::prefix('subject')->name('subject.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\SubjectController::class, 'index'])->name('index');
        Route::get('create', [\App\Http\Controllers\Admin\SubjectController::class, 'create'])->name('create');
        Route::post('create', [\App\Http\Controllers\Admin\SubjectController::class, 'store'])->name('store');
        Route::get('edit/{id}', [\App\Http\Controllers\Admin\SubjectController::class, 'edit'])->name('edit');
        Route::patch('edit/{id}', [\App\Http\Controllers\Admin\SubjectController::class, 'update'])->name('update');
        Route::get('delete/{id}', [\App\Http\Controllers\Admin\SubjectController::class, 'delete'])->name('delete');
    });

    Route::prefix('package')->name('package.')->group(function () {
        Route::get('primary', [\App\Http\Controllers\Admin\PackageController::class, 'index_primary'])->name('index_primary');
        Route::get('pt', [\App\Http\Controllers\Admin\PackageController::class, 'index_pt'])->name('index_pt');
        Route::get('create', [\App\Http\Controllers\Admin\PackageController::class, 'create'])->name('create');
        Route::post('create', [\App\Http\Controllers\Admin\PackageController::class, 'store'])->name('store');
        Route::get('edit/{id}', [\App\Http\Controllers\Admin\PackageController::class, 'edit'])->name('edit');
        Route::patch('edit/{id}', [\App\Http\Controllers\Admin\PackageController::class, 'update'])->name('update');
        Route::get('change-status/{id}', [\App\Http\Controllers\Admin\PackageController::class, 'change_status'])->name('change_status');
        Route::get('evaluate/{id}', [\App\Http\Controllers\Admin\PackageController::class, 'evaluate'])->name('evaluate');
    });

    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('index');
        Route::get('change-status/{id}', [\App\Http\Controllers\Admin\ContactController::class, 'change_status'])->name('change_status');
    });

    Route::prefix('post')->name('post.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\PostController::class, 'index'])->name('index');
        Route::get('change-status/{id}', [\App\Http\Controllers\Admin\PostController::class, 'change_status'])->name('change_status');
        Route::get('delete/{id}', [\App\Http\Controllers\Admin\PostController::class, 'delete'])->name('delete');
        Route::get('create', [\App\Http\Controllers\Admin\PostController::class, 'create'])->name('create');
        Route::post('create', [\App\Http\Controllers\Admin\PostController::class, 'store'])->name('store');
        Route::get('edit/{id}', [\App\Http\Controllers\Admin\PostController::class, 'edit'])->name('edit');
        Route::patch('edit/{id}', [\App\Http\Controllers\Admin\PostController::class, 'update'])->name('update');
    });

    Route::prefix('time')->name('time.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\TimeController::class, 'index'])->name('list');
        Route::get('create', [\App\Http\Controllers\Admin\TimeController::class, 'create'])->name('create');
        Route::post('create', [\App\Http\Controllers\Admin\TimeController::class, 'store'])->name('store');
        Route::get('edit/{id}', [\App\Http\Controllers\Admin\TimeController::class, 'edit'])->name('edit');
        Route::patch('edit/{id}', [\App\Http\Controllers\Admin\TimeController::class, 'update'])->name('update');
        Route::get('delete/{id}', [\App\Http\Controllers\Admin\TimeController::class, 'delete'])->name('delete');
    });

    Route::prefix('wage')->name('wage.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\WageController::class, 'index'])->name('index');
    });

    Route::prefix('evaluate')->name('evaluate.')->group(function () {
        Route::get('delete/{id}', [\App\Http\Controllers\Client\RateController::class, 'delete'])->name('delete');
    });
});


Route::post('momoPayment', [\App\Http\Controllers\Client\OrderController::class, 'momoPayment'])->name('momoPayment');
Route::get('ipn', [\App\Http\Controllers\Client\OrderController::class, 'ipn'])->name('ipn');

Route::prefix('rate')->name('rate.')->group(function () {
    Route::get('evaluate/{id}', [\App\Http\Controllers\Client\ScheduleMemberController::class, 'evaluatePackage'])->name('index');
    Route::post('evaluate', [\App\Http\Controllers\Client\ScheduleMemberController::class, 'store_evaluate'])->name('store');
});