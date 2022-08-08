<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\V1\Master\CoaBankKasController;
use App\Http\Controllers\V1\Master\COAController;
use App\Http\Controllers\V1\Master\LokasiController;
use App\Http\Controllers\V1\Master\KategoriCOAController;
use App\Http\Controllers\V1\Master\MenuController;
use App\Http\Controllers\V1\Master\RoleMenuController;

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
                    // Route::post('/register', 'store');
            // Route::delete('/delete/{id}', 'delete_by_id');
            // Route::post('/{id}', 'show_by_id');
            // Route::put('/update/{id}', 'update_by_id');
 });
   Route::group(['middleware' => ['auth:sanctum','verified']],function () 
   {
               Route::controller(UserController::class)->group(function () {
                    Route::prefix('user')->group(function () {                 

                        Route::get('/','show_all');
                        Route::delete('/delete/{id}', 'delete_by_id');
                        Route::post('/register', 'store');
                        Route::post('/{id}', 'show_by_id');
                        Route::put('/update/{id}', 'update_by_id');
                        Route::put('/cp/{id}', 'changePassword');

                    });

                });

                Route::controller(COAController::class)->group(function () {
                  Route::prefix('coa')->group(function () {
                                  
                      Route::get('/', 'show_all');
                      Route::post('/create', 'store');
                      Route::delete('/delete/{id}', 'delete_by_id');
                      Route::post('/{id}', 'show_by_id');
                      Route::put('/update/{id}', 'update_by_id');
      
                  });
               });
               
                Route::controller(KategoriCOAController::class)->group(function () {
                  Route::prefix('kategori_coa')->group(function () {
                                  
                      Route::get('/', 'show_all');
                      Route::post('/create', 'store');
                      Route::delete('/delete/{id}', 'delete_by_id');
                      Route::post('/{id}', 'show_by_id');
                      Route::put('/update/{id}', 'update_by_id');
      
                  });
               });
               
                Route::controller(LokasiController::class)->group(function () {
                  Route::prefix('lokasi')->group(function () {
                                  
                      Route::get('/', 'show_all');
                      Route::post('/create', 'store');
                      Route::delete('/delete/{id}', 'delete_by_id');
                      Route::get('/{id}', 'show_by_id');
                      Route::put('/update/{id}', 'update_by_id');
      
                  });
               });     
                Route::controller(MenuController::class)->group(function () {
                  Route::prefix('menu')->group(function () {
                                  
                      Route::get('/', 'show_all');
                      Route::post('/create', 'store');
                      Route::delete('/delete/{id}', 'delete_by_id');
                      Route::post('/{id}', 'show_by_id');
                      Route::put('/update/{id}', 'update_by_id');
      
                  });
               });     
                Route::controller(RoleMenuController::class)->group(function () {
                  Route::prefix('role_menu')->group(function () {
                                  
                      Route::get('/', 'show_all');
                      Route::post('/create', 'store');
                      Route::delete('/delete/{id}', 'delete_by_id');
                      Route::post('/{id}', 'show_by_id');
                      Route::put('/update/{id}', 'update_by_id');
      
                  });
               });     
                Route::controller(CoaBankKasController::class)->group(function () {
                  Route::prefix('coa_bank')->group(function () {
                                  
                      Route::get('/', 'show_all');
                      Route::post('/create', 'store');
                      Route::delete('/delete/{id}', 'delete_by_id');
                      Route::post('/{id}', 'show_by_id');
                      Route::put('/update/{id}', 'update_by_id');
      
                  });
               });     

        Route::controller(UserController::class)->group(function () {
        
            Route::post('/logout', 'logout');
        });
    });  