<?php

use App\Http\Controllers\Api\V1\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware([
    'role:admin',
])->group(function () {
    Route::post('travels', [Admin\TravelController::class, 'store']);
    Route::post('travels/{travel:slug}/tours', [Admin\TourController::class, 'store']);
});

Route::middleware([
    'role:admin,editor',
])->group(function () {
    Route::put('travels/{travel}', [Admin\TravelController::class, 'update']);
});
