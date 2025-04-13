<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\TpsReportController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VolunteerController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('logout', 'logout');
        Route::get('me', 'me');
    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout');
    });

    Route::middleware('role:surveyor')->group(function () {
        Route::prefix('report')->group(function () {
            Route::controller(TpsReportController::class)->group(function () {
                Route::get('get', 'get');
                Route::post('create', 'create');
                Route::post('create-attachment', 'createAttachment');
                Route::post('delete-attachment', 'deleteAttachment');
            });
        });
    });

    Route::middleware('role:relawan')->group(function () {
        Route::prefix('volunteer')->group(function () {
            Route::controller(VolunteerController::class)->group(function () {
                Route::get('get', 'get');
                Route::post('create', 'create');
            });
        });
    });

    Route::middleware('role:admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('tps')->group(function () {
                Route::controller(Admin\TpsController::class)->group(function () {
                    Route::get('get', 'get');
                    Route::post('create', 'create');
                    Route::post('update', 'update');
                    Route::post('delete', 'delete');
                });
            });

            Route::prefix('volunteer')->group(function () {
                Route::controller(Admin\VolunteerController::class)->group(function () {
                    //
                });
            });
        });

        Route::prefix('user')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::get('get', 'get');
                Route::post('create', 'create');
                Route::post('update', 'update');
            });
        });
    });
});
