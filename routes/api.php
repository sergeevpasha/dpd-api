<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DPDController;

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

Route::get('cities', [DPDController::class, 'queryCities'])
    ->name('cities.query');

Route::post('calculate', [DPDController::class, 'calculateDeliveryPrice'])
    ->name('calculate');

Route::get('track', [DPDController::class, 'findByTrackNumber'])
    ->name('track');