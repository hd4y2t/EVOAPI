<?php

use App\Http\Controllers\V1\Master\COAController;
use App\Http\Controllers\V1\Master\LokasiController;
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

Route::controller(COAController::class)->group(function () {
    Route::prefix('coa')->group(function () {

        Route::get('/', 'index');
        Route::post('/create', 'store');
        Route::delete('/delete/{id}', 'destroy');
        Route::post('/{id}', 'show');
        Route::patch('/update/{id}', 'update');

    });
});
  


Route::controller(LokasiController::class)->group(function () {
    Route::prefix('lokasi')->group(function () {
        
        Route::get('/', 'index');
        Route::post('/create', 'store');
        Route::delete('/delete/{id}', 'destroy');
        Route::post('/{id}', 'show');
        Route::patch('/update/{id}', 'update');

    });
});
