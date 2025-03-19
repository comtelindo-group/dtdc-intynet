<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\VolunteerController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/test/hengki/asfjff", function() {
    dd(User::where('email', 'edengideonharefa@gmail.com')->first());
});

Route::middleware(['auth'])->group(function () {
    // Route::middleware(['role:relawan'])->group(function () {
        Route::controller(VolunteerController::class)->group(function () {
            Route::get('/', 'index')->name('volunteer.index');
            Route::get('/create', 'create')->name('volunteer.create');
            Route::post('/store', 'store')->name('volunteer.store');

            Route::get('/get/datatable', 'getDatatable')->name('volunteer.table');
        });
    // });

    Route::prefix('admin')->group(function () {
        Route::middleware(['role:admin'])->group(function () {
            Route::controller(Admin\VolunteerController::class)->group(function () {
                Route::get('/', 'index')->name('admin.volunteer.index');
                Route::get('/export', 'export')->name('admin.volunteer.export');
                Route::get('/map', 'map')->name('admin.volunteer.map');
                Route::post('/delete', 'delete')->name('admin.volunteer.delete');

                Route::get('/get/datatable', 'getDatatable')->name('admin.volunteer.table');
            });
        });
    });
});

require __DIR__ . '/auth.php';
