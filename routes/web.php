<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MRtController;
use App\Http\Controllers\MRwController;
use App\Http\Controllers\MStaffCategoryController;
use App\Http\Controllers\StaffRtController;
use App\Http\Controllers\StaffRwController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FacilityRtController;
use App\Http\Controllers\FacilityRwController;
use Illuminate\Support\Facades\Route;

// Route Auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'getRegister'])->name('register.get');
    Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login.get');
    Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
    Route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('forgot-password.get');
    Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('forgot-password.post');
});

Route::get('/logout', function (){
    return redirect()->route('login.get');
})->middleware('auth');
Route::post('/logout', [AuthController::class, 'postLogout'])->name('logout.post')->middleware('auth');
// END Route Auth

// Route Dashboard
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
// END Route Dashboard

// Middleware Group untuk Rute yang Memerlukan Auth
Route::middleware('auth')->group(function () {
    // Route RW
    Route::prefix('rw')->group(function () {
        Route::get('/', [MRwController::class, 'index'])->name('rw.index');
        Route::get('/add', [MRwController::class, 'create'])->name('rw.add');
        Route::post('/store', [MRwController::class, 'store'])->name('rw.store');
        Route::get('/edit/{id}', [MRwController::class, 'edit'])->name('rw.edit'); // Tambah {id} untuk konsistensi
        Route::post('/update/{id}', [MRwController::class, 'update'])->name('rw.update');
        Route::delete('/delete/{id}', [MRwController::class, 'destroy'])->name('rw.delete');
    });

    // Route RT
    Route::prefix('rt')->group(function () {
        Route::get('/', [MRtController::class, 'index'])->name('rt.index');
        Route::get('/add', [MRtController::class, 'create'])->name('rt.add');
        Route::post('/store', [MRtController::class, 'store'])->name('rt.store');
        Route::get('/edit/{id}', [MRtController::class, 'edit'])->name('rt.edit'); // Tambah {id} untuk konsistensi
        Route::post('/update/{id}', [MRtController::class, 'update'])->name('rt.update');
        Route::delete('/delete/{id}', [MRtController::class, 'destroy'])->name('rt.delete');
    });

    // Route Staff Category
    Route::prefix('staff-category')->group(function () {
        Route::get('/', [MStaffCategoryController::class, 'index'])->name('staff-category.index');
        Route::get('/add', [MStaffCategoryController::class, 'create'])->name('staff-category.add');
        Route::post('/store', [MStaffCategoryController::class, 'store'])->name('staff-category.store');
        Route::get('/edit/{id}', [MStaffCategoryController::class, 'edit'])->name('staff-category.edit');
        Route::post('/update/{id}', [MStaffCategoryController::class, 'update'])->name('staff-category.update');
        Route::post('/update-order', [MStaffCategoryController::class, 'updateOrder'])->name('staff-category.update-order');

        Route::delete('/delete/{id}', [MStaffCategoryController::class, 'destroy'])->name('staff-category.delete');
    });

    // Route Staff RW
    Route::prefix('staff-rw')->group(function () {
        Route::get('/', [StaffRwController::class, 'index'])->name('staff-rw.index');
        Route::get('/add', [StaffRwController::class, 'create'])->name('staff-rw.add');
        Route::post('/store', [StaffRwController::class, 'store'])->name('staff-rw.store');
        Route::get('/edit/{id}', [StaffRwController::class, 'edit'])->name('staff-rw.edit');
        Route::post('/update/{id}', [StaffRwController::class, 'update'])->name('staff-rw.update');
        Route::delete('/delete/{id}', [StaffRwController::class, 'destroy'])->name('staff-rw.delete');
    });

    // Route Staff RT
    Route::prefix('staff-rt')->group(function () {
        Route::get('/', [StaffRtController::class, 'index'])->name('staff-rt.index');
        Route::get('/add', [StaffRtController::class, 'create'])->name('staff-rt.add');
        Route::post('/store', [StaffRtController::class, 'store'])->name('staff-rt.store');
        Route::get('/edit/{id}', [StaffRtController::class, 'edit'])->name('staff-rt.edit');
        Route::post('/update/{id}', [StaffRtController::class, 'update'])->name('staff-rt.update');
        Route::delete('/delete/{id}', [StaffRtController::class, 'destroy'])->name('staff-rt.delete');
    });

    // Route Event
    Route::prefix('event')->group(function () {
        Route::get('/', [EventController::class, 'index'])->name('event.index');
        Route::get('/add', [EventController::class, 'create'])->name('event.add');
        Route::post('/store', [EventController::class, 'store'])->name('event.store');
        Route::get('/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
        Route::post('/update/{id}', [EventController::class, 'update'])->name('event.update');
        Route::delete('/delete/{id}', [EventController::class, 'destroy'])->name('event.delete');
    });

    // Route UMKM
    Route::prefix('umkm')->group(function () {
        Route::get('/', [UmkmController::class, 'index'])->name('umkm.index');
        Route::get('/add', [UmkmController::class, 'create'])->name('umkm.add');
        Route::post('/store', [UmkmController::class, 'store'])->name('umkm.store');
        Route::get('/edit/{id}', [UmkmController::class, 'edit'])->name('umkm.edit');
        Route::post('/update/{id}', [UmkmController::class, 'update'])->name('umkm.update');
        Route::delete('/delete/{id}', [UmkmController::class, 'destroy'])->name('umkm.delete');
    });

    // Route Facility RW
    Route::prefix('facility-rw')->group(function () {
        Route::get('/', [FacilityRwController::class, 'index'])->name('facility-rw.index');
        Route::get('/add', [FacilityRwController::class, 'create'])->name('facility-rw.add');
        Route::post('/store', [FacilityRwController::class, 'store'])->name('facility-rw.store');
        Route::get('/edit/{id}', [FacilityRwController::class, 'edit'])->name('facility-rw.edit');
        Route::post('/update/{id}', [FacilityRwController::class, 'update'])->name('facility-rw.update');
        Route::delete('/delete/{id}', [FacilityRwController::class, 'destroy'])->name('facility-rw.delete');
    });

    // Route Facility RT
    Route::prefix('facility-rt')->group(function () {
        Route::get('/', [FacilityRtController::class, 'index'])->name('facility-rt.index');
        Route::get('/add', [FacilityRtController::class, 'create'])->name('facility-rt.add');
        Route::post('/store', [FacilityRtController::class, 'store'])->name('facility-rt.store');
        Route::get('/edit/{id}', [FacilityRtController::class, 'edit'])->name('facility-rt.edit');
        Route::post('/update/{id}', [FacilityRtController::class, 'update'])->name('facility-rt.update');
        Route::delete('/delete/{id}', [FacilityRtController::class, 'destroy'])->name('facility-rt.delete');
    });
});
