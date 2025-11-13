<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MiningController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\WithdrawalController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\PurchaseController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::namespace('Api')->group(
    function () {
        Route::post('add_plan', [PurchaseController::class, 'index']);
        //setting
        Route::post('app_setting', [SettingController::class, 'index']);
        // User
        Route::post('user_details', [ContactController::class, 'index']);
        Route::post('contact_us', [ContactController::class, 'contactUs']);


    }
);
