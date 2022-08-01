<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\V1\Master\COAController;
use App\Http\Controllers\V1\Master\LokasiController;
use App\Http\Controllers\V1\Master\KategoriCOAController;

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

 Route::controller(UserController::class)->group(function () {
 
    Route::post('/login', 'login');
    Route::post('/register', 'store');
            // Route::delete('/delete/{id}', 'destroy');
            // Route::post('/{id}', 'show');
            // Route::put('/update/{id}', 'update');

   Route::group(['middleware' => ['auth:sanctum','verified']],function () {
     
               
          
                Route::controller(COAController::class)->group(function () {
                  Route::prefix('coa')->group(function () {
                                  
                      Route::get('/', 'index');
                      Route::post('/create', 'store');
                      Route::delete('/delete/{id}', 'destroy');
                      Route::post('/{id}', 'show');
                      Route::put('/update/{id}', 'update');
      
                  });
               });
               
                Route::controller(KategoriCOAController::class)->group(function () {
                  Route::prefix('kategori_coa')->group(function () {
                                  
                      Route::get('/', 'index');
                      Route::post('/create', 'store');
                      Route::delete('/delete/{id}', 'destroy');
                      Route::post('/{id}', 'show');
                      Route::put('/update/{id}', 'update');
      
                  });
               });
               
                Route::controller(LokasiController::class)->group(function () {
                  Route::prefix('lokasi')->group(function () {
                                  
                      Route::get('/', 'index');
                      Route::post('/create', 'store');
                      Route::delete('/delete/{id}', 'destroy');
                      Route::post('/{id}', 'show');
                      Route::put('/update/{id}', 'update');
      
                  });
               });     

        Route::controller(UserController::class)->group(function () {
        
            Route::post('/logout', 'logout');
        });
    });  
    
});