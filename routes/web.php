<?php

use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AppContoller;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AutheController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\OtpVerificationController;
use App\Models\LoginSession;
use Illuminate\Support\Facades\Artisan;

Route::get('cache', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return 'clear cache';
});




Route::redirect("/api-view", "public/swagger-ui");

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
require __DIR__.'/auth.php';

// 'middleware' => 'auth','session','otp']
    Route::middleware(['auth','session','otp'])->group(function () {

    Route::post('changePassword', [DashboardController::class,'changePassword'])->name('changePassword');

    Route::resource('apps', AppContoller::class);

    Route::get('users', [UserController::class,'index'])->name('users');
    Route::get('users/{id}/show', [UserController::class, 'show'])->name('users.show');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('users/contact/{id}', [UserController::class, 'contactdestroy'])->name('contactdestroy');
    Route::delete('deleteSelectedUsers', [UserController::class, 'deleteSelectedUsers'])->name('delete.selected.users');
    Route::delete('deleteAllSelectedContacts', [UserController::class, 'deleteAllSelectedContacts'])->name('delete.allselected.contacts');
    // Route::post('deleteSelectedContact', [UserController::class, 'deleteSelectedcontact'])->name('delete.selected.contacts');
    // Route::post('users/update/{id}', [UserController::class, 'update'])->name('users.update');

    // Route::get('withdrawal', [WithdrawalController::class,'index'])->name('withdrawal');
    // Route::delete('deleteSelectedWithdrawal', [WithdrawalController::class, 'deleteSelectedUsers'])->name('withdrawal.selected.users');


    // Route::get('dateFilterData', [PurchaseController::class,'dateFilterData'])->name('dateFilterData');

    Route::get('set-cookie/{app?}/{appname?}', [DashboardController::class, 'setCookie'])->name('set_cookie');
    // Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    // Route::get('/dashboard-chart-data', [DashboardController::class, 'dashboardChartData'])->name('dashboard.chart.data');
    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('settings/store', [SettingController::class, 'store'])->name('settings.store');
    Route::get('payment-setting', [SettingController::class, 'appSetting'])->name('app.settings');
    Route::post('payment-setting/store', [SettingController::class, 'appStore'])->name('payment.settings.store');


    Route::get('/permission', [RegisterController::class,'index'])->name('permission');
    Route::get('/permission/users/create', [RegisterController::class, 'create'])->name('users.create');
    Route::post('users/store', [RegisterController::class, 'store'])->name('users.store');
    Route::get('permission/{id}/edit', [RegisterController::class, 'edit'])->name('permission.edit');
    Route::post('permission/update/{id}', [RegisterController::class, 'update'])->name('permission.update');
    Route::delete('permission/{id}', [RegisterController::class, 'destroy'])->name('permission.destroy');


    Route::get('/role', [RoleController::class,'index'])->name('role');
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');


    Route::get('/authentication', [AutheController::class,'index'])->name('authe');
    Route::post('/authentication', [AutheController::class, 'store'])->name('authe.store');
    Route::post('logout_all', [LogoutController::class, 'logoutAll']);
    Route::get('sessions', [LogoutController::class, 'index'])->name('sessions.index');
    Route::post('logout-session/{sessionId}', [LogoutController::class, 'logoutSession'])->name('logout_session');


    // Route::get('/query', [QueryController::class,'index'])->name('get_query');
    // Route::get('query/{id}/show', [QueryController::class, 'edit'])->name('get_query.edit');
    // Route::get('query/{id}', [QueryController::class, 'destroy'])->name('get_query.destroy');
    // Route::post('query/store', [QueryController::class, 'store'])->name('get_query.store');


    // Route::get('/chat', [QueryController::class,'show'])->name('chat');


    Route::get('purchage', [PurchaseController::class,'index'])->name('purchage');
    Route::delete('/purchage/delete', [PurchaseController::class,'delete'])->name('purchage.delete');
    Route::delete('deleteall', [PurchaseController::class, 'deleteAll'])->name('deleteAll');

});

    Route::get('/verification/{session_id}',[AuthenticatedSessionController::class,'verification'])->name('verification');
    Route::post('/verified',[AuthenticatedSessionController::class,'verifiedOtp'])->name('verifiedOtp');
    Route::get('/resend-otp',[AuthenticatedSessionController::class,'resendOtp'])->name('resendOtp');



