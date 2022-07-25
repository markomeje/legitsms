<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['web'])->domain(env('APP_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
    Route::get('/about', [\App\Http\Controllers\Frontend\AboutController::class, 'index'])->name('about');
    
    Route::group(['middleware' => 'guest'], function () {
        Route::prefix('login')->group(function () {
            Route::get('/', [\App\Http\Controllers\Frontend\LoginController::class, 'index'])->name('login');
            Route::get('/auth', [\App\Http\Controllers\Frontend\LoginController::class, 'index'])->name('login.auth');
            Route::get('/verify', [\App\Http\Controllers\Frontend\LoginController::class, 'index'])->name('verify');
        });

        Route::prefix('signup')->group(function () {
            Route::get('/', [\App\Http\Controllers\Frontend\SignupController::class, 'index'])->name('signup');
            Route::post('/auth', [\App\Http\Controllers\Frontend\SignupController::class, 'signup'])->name('signup.auth');
            Route::get('/success', [\App\Http\Controllers\Frontend\SignupController::class, 'success'])->name('signup.success');
        });
    });  
});

Route::middleware(['web', 'auth', 'admin', 'revalidate'])->domain(env('ADMIN_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['web', 'auth', 'user', 'revalidate', 'profile.setup'])->domain(env('USER_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
});