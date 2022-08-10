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
    Route::get('/countries', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home.countries');
    Route::get('/country', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home.country');
    Route::get('/faq', [\App\Http\Controllers\Frontend\FaqController::class, 'index'])->name('faq');

    Route::get('/generated', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('phone.generated');
    Route::post('/verification', [\App\Http\Controllers\User\VerificationController::class, 'process'])->name('verification.process');

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

    Route::get('/deposits', [\App\Http\Controllers\Admin\DepositController::class, 'index'])->name('admin.deposits');
    Route::get('/users', [\App\Http\Controllers\Admin\DepositController::class, 'index'])->name('admin.users');

    Route::prefix('websites')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\WebsitesController::class, 'index'])->name('admin.websites');
        Route::post('/add', [\App\Http\Controllers\Admin\WebsitesController::class, 'add'])->name('admin.website.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\WebsitesController::class, 'read'])->name('admin.website.edit');
    });
});

Route::middleware(['web', 'auth', 'user', 'revalidate'])->domain(env('USER_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/paystack', [\App\Http\Controllers\User\DashboardController::class, 'index']);

    Route::post('/deposit', [\App\Http\Controllers\User\DepositController::class, 'deposit'])->name('fund.deposit');
    Route::get('/deposits', [\App\Http\Controllers\User\DepositController::class, 'index'])->name('user.deposits');

    Route::get('/numbers', [\App\Http\Controllers\User\NumbersController::class, 'index'])->name('user.numbers');

    Route::prefix('sms')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\SmsController::class, 'index'])->name('user.sms');
        Route::post('/read', [\App\Http\Controllers\User\SmsController::class, 'read'])->name('user.sms.read');
    });
});