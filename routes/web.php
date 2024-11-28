<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MRtController;
use App\Http\Controllers\MRwController;
use App\Http\Controllers\MStaffCategoryController;
use App\Http\Controllers\StaffRwController;
use App\Http\Controllers\StaffRtController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\FacilityController;
use App\Models\MStaffCategory;

// Route Dashboard (Main)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// END Route Dashboard (Main)

// Route Auth
Route::get('/register', [AuthController::class, 'getRegister'])->name('register.get');
Route::post('/register', [AuthController::class, 'postRegister'])->name('register.post');
Route::get('/login', [AuthController::class, 'getLogin'])->name('login.get');
Route::post('/login', [AuthController::class, 'postLogin'])->name('login.post');
Route::post('/logout', [AuthController::class, 'postLogout'])->name('logout.post');
Route::get('/forgot-password', [AuthController::class, 'getForgotPassword'])->name('forgot-password.get');
Route::post('/forgot-password', [AuthController::class, 'postForgotPassword'])->name('forgot-password.post');
// END Route Auth

// Route RT
Route::prefix('rt')->group(function () {
    Route::get('/', [MRtController::class, 'index'])->name('rt.index');
    Route::get('/add', [MRtController::class, 'create'])->name('rt.add');
    Route::post('/store', [MRtController::class, 'store'])->name('rt.store');
    Route::get('/edit', [MRtController::class, 'edit'])->name('rt.edit');
    Route::post('/update', [MRtController::class, 'update'])->name('rt.update');
    Route::delete('/delete', [MRtController::class, 'destroy'])->name('rt.delete');
});
// END Route RT

// Route RW
Route::prefix('rw')->group(function () {
    Route::get('/', [MRwController::class, 'index'])->name('rw.index');
    Route::get('/add', [MRwController::class, 'create'])->name('rw.add');
    Route::post('/store', [MRwController::class, 'store'])->name('rw.store');
    Route::get('/edit', [MRwController::class, 'edit'])->name('rw.edit');
    Route::post('/update', [MRwController::class, 'update'])->name('rw.update');
    Route::delete('/delete', [MRwController::class, 'destroy'])->name('rw.delete');
});
// END Route RW

// Route Staff Category
Route::prefix('staff-category')->group(function () {
    Route::get('/', [MStaffCategoryController::class, 'index'])->name('staff-category.index');
    Route::get('/add', [MStaffCategoryController::class, 'create'])->name('staff-category.add');
    Route::post('/store', [MStaffCategoryController::class, 'store'])->name('staff-category.store');
    Route::get('/edit', [MStaffCategoryController::class, 'edit'])->name('staff-category.edit');
    Route::post('/update', [MStaffCategoryController::class, 'update'])->name('staff-category.update');
    Route::delete('/delete', [MStaffCategoryController::class, 'destroy'])->name('staff-category.delete');
});
// END Route Staff Category

// Route Staff RW
Route::prefix('staff-rw')->group(function () {
    Route::get('/', [StaffRwController::class, 'index'])->name('staff-rw.index');
    Route::get('/add', [StaffRwController::class, 'create'])->name('staff-rw.add');
    Route::post('/store', [StaffRwController::class, 'store'])->name('staff-rw.store');
    Route::get('/edit', [StaffRwController::class, 'edit'])->name('staff-rw.edit');
    Route::post('/update', [StaffRwController::class, 'update'])->name('staff-rw.update');
    Route::delete('/rw-{rw_id}/{id}', [StaffRwController::class, 'destroy'])->name('staff-rw.delete');

});
// END Route Staff RW

// Route Staff RT
Route::prefix('staff-rt')->group(function () {
    Route::get('/', [StaffRtController::class, 'index'])->name('staff-rt.index');
    Route::get('/add', [StaffRtController::class, 'create'])->name('staff-rt.add');
    Route::post('/store', [StaffRtController::class, 'store'])->name('staff-rt.store');
    Route::get('/edit', [StaffRtController::class, 'edit'])->name('staff-rt.edit');
    Route::post('/update', [StaffRtController::class, 'update'])->name('staff-rt.update');
    Route::delete('/rt-{rt_id}/{id}', [StaffRtController::class, 'destroy'])->name('staff-rt.delete');

});
// END Route Staff RT

// Route Event
Route::prefix('event')->group(function () {
    Route::get('/', [EventController::class, 'index'])->name('event.index');
    Route::get('/add', [EventController::class, 'add'])->name('event.add');
    Route::post('/store', [EventController::class, 'store'])->name('event.store');
    Route::get('/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::post('/update', [EventController::class, 'update'])->name('event.update');
});
// END Route Event

// Route UMKM
Route::prefix('umkm')->group(function () {
    Route::get('/', [UmkmController::class, 'index'])->name('umkm.index');
    Route::get('/add', [UmkmController::class, 'add'])->name('umkm.add');
    Route::post('/store', [UmkmController::class, 'store'])->name('umkm.store');
    Route::get('/edit', [UmkmController::class, 'edit'])->name('umkm.edit');
    Route::post('/update', [UmkmController::class, 'update'])->name('umkm.update');
});
// END Route UMKM

// Route Facility
Route::prefix('facility')->group(function () {
    Route::get('/', [FacilityController::class, 'index'])->name('facility.index');
    Route::get('/add', [FacilityController::class, 'add'])->name('facility.add');
    Route::post('/store', [FacilityController::class, 'store'])->name('facility.store');
    Route::get('/edit', [FacilityController::class, 'edit'])->name('facility.edit');
    Route::post('/update', [FacilityController::class, 'update'])->name('facility.update');
});
// END Route Facility
