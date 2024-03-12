<?php

use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\AttendanceMemberController;
use App\Http\Controllers\Admin\ContractController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\ExportController as AdminExportController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PtMyStudentController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SchedulePtController;
use App\Http\Controllers\Admin\TimeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\OrderController as ClientOrderController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\ResultContractController;
use App\Http\Controllers\Client\ScheduleCoachController;
use App\Http\Controllers\Client\ScheduleMemberController as ClientScheduleMemberController;
use App\Http\Controllers\Client\ScheduleUsserController;
use App\Http\Controllers\ExportController;
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

Route::prefix('admin/')->middleware(['auth', 'verified', 'role:admin'])->name('admin.')->group(function () {
    Route::prefix('user/')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('listUser');
        Route::get('/list-admin', [UserController::class, 'listAdmin'])->name('listAdmin');
        Route::get('/list-pt', [UserController::class, 'listPt'])->name('listPt');
        Route::get('/list-member', [UserController::class, 'listMember'])->name('listMember');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/post-user', [UserController::class, 'store'])->name('postUser');
        Route::get('/very-account/{user}', [UserController::class, 'veryAccount'])->name('veryAccount');
        Route::post('/postVeryAccount/{user}', [UserController::class, 'postVeryAccount'])->name('postVeryAccount');
        Route::get('/edit-status', [UserController::class, 'status'])->name('editStatus');
        Route::post('/edit-role', [UserController::class, 'editRole'])->name('editRole');
        Route::get('bmi/{id}', [UserController::class, 'bmi'])->name('bmi');
        Route::patch('bmi/{id}', [UserController::class, 'updateBMI'])->name('updateBMI');
        Route::get('evaluate/{id}', [UserController::class, 'evaluate'])->name('evaluate');
    });


    Route::prefix('discount/')->name('discount.')->group(function () {
        Route::get('/', [DiscountController::class, 'index'])->name('list');
        Route::get('/create', [DiscountController::class, 'create'])->name('create');
        Route::post('/post-discount', [DiscountController::class, 'store'])->name('postDiscount');
        Route::get('edit/{id}', [DiscountController::class, 'edit'])->name('edit');
        Route::patch('edit/{id}', [DiscountController::class, 'update'])->name('postEdit');
    });

    Route::prefix('order/')->name('order.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('list');
        // Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::get('/create-simple', [OrderController::class, 'createSimple'])->name('createSimple');
        Route::get('/create-complex', [OrderController::class, 'createComplex'])->name('createComplex');
        Route::post('/post-order', [OrderController::class, 'store'])->name('postOrder');

        Route::get('/mail-order', [OrderController::class, 'mailOrder'])->name('mailOrder');
        Route::post('/postMailOrder', [OrderController::class, 'postMailOrder'])->name('postMailOrder');
        Route::get('/send-mail/{order}', [OrderController::class, 'sendMail'])->name('sendMail');
        Route::post('/postSendMail/{order}', [OrderController::class, 'postSendMail'])->name('postSendMail');

        Route::get('/add', [OrderController::class, 'add'])->name('add');

        Route::get('/create-multi', [OrderController::class, 'createMulti'])->name('createMulti');
        Route::post('/post-orderMulti', [OrderController::class, 'postOrderMulti'])->name('postOrderMulti');

        Route::get('/set-member', [OrderController::class, 'setMember'])->name('setMember');
        Route::get('/set-package', [OrderController::class, 'setPackage'])->name('setPackage');
        Route::get('/total-money', [OrderController::class, 'setTotalMoney'])->name('setTotalMoney');
        Route::get('/set-coach', [OrderController::class, 'setCoach'])->name('setCoach');
        Route::get('pdf', [AdminExportController::class, 'list_order_pdf'])->name('pdf');

        Route::post('/momo_payment', [OrderController::class, 'momoPayment'])->name('momoPayment');
        Route::get('checkPayment', [OrderController::class, 'returnUrl'])->name('returnUrl');

        Route::get('contract-order/{id}', [AdminExportController::class, 'contract_order'])->name('contract_order');
    });

    Route::prefix('contract/')->name('contract.')->group(function () {
        Route::get('/', [ContractController::class, 'index'])->name('list');
        Route::get('/create/{id}', [ContractController::class, 'create'])->name('create');
        Route::post('/post-time', [ContractController::class, 'store'])->name('postTime');
    });

    // Route::prefix('schedule/')->name('schedule.')->group(function () {
    //     Route::get('', [SchedulePtController::class, 'index'])->name('list');
    // });
    Route::prefix('schedule')->name('schedule.')->group(function () {
        Route::get('list', [\App\Http\Controllers\Admin\ScheduleController::class, 'show'])->name('list');
    });

    Route::prefix('attendance/')->name('attendance.')->group(function () {
        Route::get('/{id}', [AttendanceMemberController::class, 'index'])->name('list');
        Route::get('/edit-status', [AttendanceMemberController::class, 'editStatus'])->name('editStatus');
    });
});

Route::prefix('coach/')->name('coach.')->group(function () {
    Route::prefix('my-student/')->name('my_student.')->group(function () {
        Route::get('/', [PtMyStudentController::class, 'index'])->name('list');
    });
});

// client 

Route::get('/total-money', [OrderController::class, 'setTotalMoney'])->name('order.setTotalMoneyClient');

Route::prefix('payment/')->name('payment.')->group(function () {
    Route::get('/{id}', [PaymentController::class, 'index'])->name('index');
    Route::post('create/{id}', [PaymentController::class, 'store'])->name('store');

    Route::get('checkPayment', [PaymentController::class, 'returnUrl'])->name('returnUrl');
});

// Route::prefix('account/')->name('account.')->group(function () {
//     Route::get('/', [ScheduleUserController::class, 'index'])->name('index');

// });

// 'checkBuyPackage'
Route::prefix('order/')->middleware('checkAdminBuyPackage','checkBuyPackage' ,'auth')->name('order.')->group(function () {
    Route::get('create/{id}', [ClientOrderController::class, 'index'])->name('index');
    Route::post('postOrder/{id}', [ClientOrderController::class, 'store'])->name('postOrder');
    Route::get('checkPayment/{idOrder}', [ClientOrderController::class, 'returnUrl'])->name('returnUrl');
    // Route::get('resultPayment/{returnData}', [ClientOrderController::class, 'resultPayment'])->name('resultPayment');
    Route::get('checkWeekdayPt', [ClientOrderController::class, 'checkWeekdayPt'])->name('checkWeekdayPt');
    Route::get('test', [ClientOrderController::class, 'test'])->name('test');
    Route::get('create/{orderId}', [ClientOrderController::class, 'create'])->name('create');
    Route::get('result-momo/{order_Id}', [ClientOrderController::class, 'resultMomo'])->name('resultMomo');
});
Route::get('resultPayment/{returnData}', [ClientOrderController::class, 'resultPayment'])->name('order.resultPayment');
Route::get('resultMomo/{dataOrder}', [ClientOrderController::class, 'returnMomo'])->name('order.returnMomo');

Route::prefix('account')->middleware('auth', 'role:member','checkRate')->name('account.')->group(function () {
    Route::get('profile', [ClientScheduleMemberController::class, 'profile'])->name('profile');
    Route::get('schedule', [ClientScheduleMemberController::class, 'scheduleMember'])->name('schedule');

    Route::get('reschedule/{attendanceId}', [ClientScheduleMemberController::class, 'reschedule'])->name('reschedule');
    Route::post('postReschedule/{attendanceId}', [ClientScheduleMemberController::class, 'postReschedule'])->name('postReschedule');
    Route::get('checkTimesCoach', [ClientScheduleMemberController::class, 'checkTimesCoach'])->name('checkTimesCoach');
    Route::get('history-package', [ClientScheduleMemberController::class, 'historyPackage'])->name('historyPackage');
    Route::get('result-package/{result}', [ResultContractController::class, 'resultPackage'])->name('resultPackage');
});
Route::prefix('account')->name('account.')->group(function () {
    Route::patch('save-profile', [ClientScheduleMemberController::class, 'saveProfile'])->name('saveProfile');
});
Route::prefix('account-pt/')->middleware('auth', 'role:coach|coachbx')->name('accountPt.')->group(function () {
    Route::get('/', [ScheduleCoachController::class, 'profile'])->name('index');
    Route::get('profile', [ScheduleCoachController::class, 'profile'])->name('profile');
    Route::get('schedule', [ScheduleCoachController::class, 'scheduleCoach'])->name('scheduleCoach');
    Route::get('attendance-member/{scheduleId}', [ScheduleCoachController::class, 'attendanceMember'])->name('attendanceMember');
    Route::post('attendance-member/{scheduleId}', [ScheduleCoachController::class, 'postAttendanceMember'])->name('postAttendanceMember');
    Route::get('list-member', [ScheduleCoachController::class, 'listMember'])->name('listMember');
    Route::get('evaluate-member/{result}', [ResultContractController::class, 'evaluateMember'])->name('evaluateMember');
    Route::post('postEvaluateMember/{result}', [ResultContractController::class, 'postEvaluateMember'])->name('postEvaluateMember');

    Route::get('contract-order/{id}', [ScheduleCoachController::class, 'contract_order'])->name('contractOrder');
});
