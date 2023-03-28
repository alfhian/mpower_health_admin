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

Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Route::get('/login', function(){
    return redirect()->route('admin');
});

Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin_login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
])->group(function () {
    
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::get('/lab_result', [App\Http\Controllers\LabResultController::class, 'index'])->name('admin_lab_result');
    Route::post('/recommendation/claim', [App\Http\Controllers\RecommendationController::class, 'claim'])->name('claim_recommendation');
    Route::post('/recommendation/upload', [App\Http\Controllers\RecommendationController::class, 'upload'])->name('upload_recommendation');
    Route::prefix('user_management')->group(function() {
        Route::get('/', [App\Http\Controllers\UserManagementController::class, 'index'])->name('user_management');
        Route::post('/add_user', [App\Http\Controllers\UserManagementController::class, 'store'])->name('add_user');
        Route::post('/reset_password', [App\Http\Controllers\UserManagementController::class, 'reset_password'])->name('admin_reset_password');
        Route::post('/user_status', [App\Http\Controllers\UserManagementController::class, 'status'])->name('user_status');
    });
        
});
