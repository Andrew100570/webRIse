<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsProxyController;

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

Route::middleware(['check.proxy.token'])->group(function () {
    Route::post('/getNumber', [SmsProxyController::class, 'getNumber']);
    Route::post('/getSms', [SmsProxyController::class, 'getSms']);
    Route::post('/cancelNumber', [SmsProxyController::class, 'cancelNumber']);
    Route::post('/getStatus', [SmsProxyController::class, 'getStatus']);
});
