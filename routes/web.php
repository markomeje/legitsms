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
    Route::get('/faq', [\App\Http\Controllers\Frontend\FaqController::class, 'index'])->name('faq');
    Route::get('/logout', [\App\Http\Controllers\Frontend\LoginController::class, 'logout'])->name('logout');
    
    Route::group(['middleware' => 'guest'], function () {
        Route::prefix('login')->group(function () {
            Route::get('/', [\App\Http\Controllers\Frontend\LoginController::class, 'index'])->name('login');
            Route::post('/auth', [\App\Http\Controllers\Frontend\LoginController::class, 'login'])->name('login.auth');
            Route::get('/verify', [\App\Http\Controllers\Frontend\LoginController::class, 'index'])->name('verify');
        });

        Route::prefix('signup')->group(function () {
            Route::get('/', [\App\Http\Controllers\Frontend\SignupController::class, 'index'])->name('signup');
            Route::post('/auth', [\App\Http\Controllers\Frontend\SignupController::class, 'signup'])->name('signup.auth');
            Route::get('/success', [\App\Http\Controllers\Frontend\SignupController::class, 'success'])->name('signup.success');
            Route::get('/verify', [\App\Http\Controllers\Frontend\SignupController::class, 'verify'])->name('signup.verify');
            Route::post('/resend', [\App\Http\Controllers\Frontend\SignupController::class, 'resend'])->name('signup.link.resend');
        });
    });  
});

Route::middleware(['web', 'auth', 'admin', 'revalidate'])->domain(env('ADMIN_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['web', 'auth', 'user', 'revalidate'])->domain(env('USER_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/paystack', [\App\Http\Controllers\User\DashboardController::class, 'index']);

    Route::post('/deposit', [\App\Http\Controllers\User\DepositController::class, 'deposit'])->name('fund.deposit');
    Route::get('/deposits', [\App\Http\Controllers\User\DepositController::class, 'index'])->name('deposits');
});