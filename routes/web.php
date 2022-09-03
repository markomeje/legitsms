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

    Route::get('/contact', [\App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('contact');
    Route::post('/contact/send', [\App\Http\Controllers\Frontend\ContactController::class, 'send'])->name('contact.send');

    Route::get('/generated', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('phone.generated');
    Route::get('/verifications', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home.verifications');

    Route::post('/verification', [\App\Http\Controllers\User\VerificationController::class, 'process'])->name('verification.process');
    Route::post('/read/sms', [\App\Http\Controllers\User\VerificationController::class, 'read'])->name('verification.read.sms');
    Route::post('/blacklist', [\App\Http\Controllers\User\VerificationController::class, 'blacklist'])->name('verification.blacklist');

    Route::get('/logout', [\App\Http\Controllers\Frontend\LoginController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'password', 'middleware' => 'guest'], function () {
        Route::get('/', [\App\Http\Controllers\Frontend\PasswordController::class, 'index'])->name('forgot.password');
        Route::post('/reset/process', [\App\Http\Controllers\Frontend\PasswordController::class, 'process'])->name('password.reset.process');
        Route::get('/reset/{token}', [\App\Http\Controllers\Frontend\PasswordController::class, 'verify'])->name('reset.verify');
        Route::post('/reset', [\App\Http\Controllers\Frontend\PasswordController::class, 'reset'])->name('password.reset');
    });
    
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
    Route::get('/users', [\App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users');

    Route::prefix('websites')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\WebsitesController::class, 'index'])->name('admin.websites');
        Route::post('/add', [\App\Http\Controllers\Admin\WebsitesController::class, 'add'])->name('admin.website.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\WebsitesController::class, 'edit'])->name('admin.website.edit');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\WebsitesController::class, 'delete'])->name('admin.website.delete');
    });

    Route::prefix('faqs')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\FaqsController::class, 'index'])->name('admin.faqs');
        Route::post('/add', [\App\Http\Controllers\Admin\FaqsController::class, 'add'])->name('admin.faq.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\FaqsController::class, 'edit'])->name('admin.faq.edit');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\FaqsController::class, 'delete'])->name('admin.faq.delete');
    });

    Route::prefix('countries')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CountriesController::class, 'index'])->name('admin.countries');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\CountriesController::class, 'delete'])->name('admin.country.delete');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\CountriesController::class, 'edit'])->name('admin.country.edit');
        Route::post('/add', [\App\Http\Controllers\Admin\CountriesController::class, 'add'])->name('admin.country.add');
    });

    Route::prefix('social')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Admin\SocialController::class, 'add'])->name('admin.social.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\SocialController::class, 'edit'])->name('admin.social.edit');
        Route::post('/delete/{id}', [\App\Http\Controllers\Admin\SocialController::class, 'delete'])->name('admin.social.delete');
    });

    Route::prefix('verifications')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CountriesController::class, 'index'])->name('admin.verifications');
    });

    Route::prefix('legal')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Admin\LegalController::class, 'add'])->name('admin.legal.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\LegalController::class, 'edit'])->name('admin.legal.edit');
    });
});

Route::middleware(['web', 'auth', 'user', 'revalidate'])->domain(env('USER_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/paystack', [\App\Http\Controllers\User\DashboardController::class, 'index']);

    Route::post('/read/sms', [\App\Http\Controllers\User\VerificationController::class, 'read'])->name('client.verification.read.sms');

    Route::post('/personal', [\App\Http\Controllers\User\DashboardController::class, 'update'])->name('user.update.personal');

    Route::post('/deposit', [\App\Http\Controllers\User\DepositController::class, 'deposit'])->name('fund.deposit');
    Route::get('/deposits', [\App\Http\Controllers\User\DepositController::class, 'index'])->name('user.deposits');

    Route::get('/numbers', [\App\Http\Controllers\User\NumbersController::class, 'index'])->name('user.numbers');

    Route::prefix('sms')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\SmsController::class, 'index'])->name('user.sms');
        Route::post('/read', [\App\Http\Controllers\User\SmsController::class, 'read'])->name('user.sms.read');
    });
});