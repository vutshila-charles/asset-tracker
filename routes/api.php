<?php


use App\Http\Controllers\Api\AssetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InspectionController;





Route::middleware('throttle:60,1')->group(function () {

    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);

    Route::prefix('public/assets')->controller(AssetController::class)->group(function () {
        Route::post('/', 'store');
        Route::get('/{asset}', 'show');
        Route::post('/{asset}/inspections', [InspectionController::class,'store']);
    });


});



Route::middleware(['auth:sanctum','throttle:60,1'])
    ->prefix('assets')
    ->controller(AssetController::class)
    ->group(function () {

        Route::post('/', 'store');
        Route::get('/{asset}', 'show');

        Route::post('/{asset}/inspections', [InspectionController::class,'store']);

});