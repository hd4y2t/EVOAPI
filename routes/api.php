<?php

use App\Http\Controllers\V1\Master\TestingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\V1\Master\CoaBankKasController;
use App\Http\Controllers\V1\Master\COAController;
use App\Http\Controllers\V1\Master\DetailJurnalController;
use App\Http\Controllers\V1\Master\DetailJurnalTempController;
use App\Http\Controllers\V1\Master\JurnalController;
use App\Http\Controllers\V1\Master\JurnalTempController;
use App\Http\Controllers\V1\Master\LokasiController;
use App\Http\Controllers\V1\Master\KategoriCOAController;
use App\Http\Controllers\V1\Master\MenuController;
use App\Http\Controllers\V1\Master\RoleMenuController;
use App\Models\V1\Master\DetailJurnal;
use App\Models\V1\Master\DetailJurnalTemp;

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
                      Route::post('/{nama}', 'show_by_name');
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
                      Route::get('/getJenis/{id}', 'getBankKas');
                            
                  });
               });     

                Route::controller(JurnalController::class)->group(function () {
                    Route::prefix('jurnal')->group(function () {
                                    
                        Route::get('/get_last_id', 'get_last_id');
                        Route::get('/', 'show_all');
                        Route::post('/create', 'store');
                        Route::delete('/delete/{id}', 'delete_by_id');
                        Route::get('/{id}', 'show_by_id');
                        Route::put('/update/{id}', 'update_by_id');

                        Route::controller(DetailJurnalController::class)->group(function () {
                            Route::prefix('detail')->group(function () {
                                            
                                Route::get('/', 'show_all');
                                Route::post('/create', 'store');
                                Route::delete('/delete/{id}', 'delete_by_id');
                                Route::get('/{id}', 'show_by_id');
                                Route::put('/update/{id}', 'update_by_id');
                            });    
                        });
                        Route::controller(DetailJurnalTempController::class)->group(function () {
                            Route::prefix('detailtemp')->group(function () {
                                            
                                Route::get('/show', 'show_all');
                                Route::post('/move', 'move_data');
                                Route::post('/create', 'store');
                                Route::delete('/delete/{id}', 'delete_by_id');
                                Route::get('/{id}', 'show_by_id');
                                Route::put('/update/{id}', 'update_by_id');
                            });    
                        });
                    });    
                });
                
                Route::controller(JurnalTempController::class)->group(function () {
                    Route::prefix('jurnal_temp')->group(function () {
                                    
                        Route::get('/', 'show_all');
                        Route::post('/create', 'store');
                        Route::delete('/delete/{id}', 'delete');
                        Route::get('/{id}', 'show_by_id');
                        Route::put('/update/{id}', 'update');
        
                    });  
                 });     
    
        Route::controller(UserController::class)->group(function () {
        
            Route::post('/logout', 'logout');
        });
        Route::controller(TestingController::class)->group(function () {
        
            Route::get('/test', 'cobainsert');
        });
    });  