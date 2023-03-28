<?php

use Illuminate\Support\Facades\Route;

use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('/force_logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('force_logout');

Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('login');

Route::get('/login', function(){
    return redirect()->route('login');
});

Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin_login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin_dashboard');
    
    Route::prefix('lab_result')->group(function() {
        Route::get('/', [App\Http\Controllers\LabResultController::class, 'index'])->name('admin_lab_result');
        Route::get('/show_file/{file}', [App\Http\Controllers\LabResultController::class, 'showFile'])->name('show_lab_result');
    });

    Route::prefix('recommendation')->group(function() {
        Route::post('/claim', [App\Http\Controllers\RecommendationController::class, 'claim'])->name('claim_recommendation');
        Route::post('/upload', [App\Http\Controllers\RecommendationController::class, 'upload'])->name('upload_recommendation');
        Route::get('/show_file/{file}', [App\Http\Controllers\RecommendationController::class, 'showFile'])->name('show_recommendation');
    });

    Route::prefix('user_management')->group(function() {
        Route::get('/', [App\Http\Controllers\UserManagementController::class, 'index'])->name('user_management');
        Route::post('/add_user', [App\Http\Controllers\UserManagementController::class, 'store'])->name('add_user');
        Route::post('/reset_password', [App\Http\Controllers\UserManagementController::class, 'reset_password'])->name('admin_reset_password');
        Route::post('/user_status', [App\Http\Controllers\UserManagementController::class, 'status'])->name('user_status');
    });

    Route::prefix('profile_management')->group(function() {
        Route::get('/', [App\Http\Controllers\ProfileManagementController::class, 'index'])->name('profile_management');
        Route::post('/edit', [App\Http\Controllers\ProfileManagementController::class, 'edit'])->name('edit_profile');
        Route::post('/change_password', [App\Http\Controllers\ProfileManagementController::class, 'change_password'])->name('change_password');
    });

    Route::prefix('log_management')->group(function() {
        Route::get('/', [App\Http\Controllers\LogManagementController::class, 'index'])->name('log_management');
        Route::get('/detail/{id}', [App\Http\Controllers\LogManagementController::class, 'detail'])->name('log_detail');
        Route::get('/export_pdf', [App\Http\Controllers\LogManagementController::class, 'export_pdf'])->name('export_pdf_log');
        Route::get('/export_excel', [App\Http\Controllers\LogManagementController::class, 'export_excel'])->name('export_excel_log');
        Route::get('/export_excel/{file}', [App\Http\Controllers\LogManagementController::class, 'log_management'])->name('show_lab_result');
    });
        
});
