<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
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

    Route::get('/', [UserController::class, 'loginPage'])->name('login.page');
    Route::get('/register', [UserController::class, 'registerPage'])->name('register.page');
    Route::get('/referral/register', [UserController::class, 'referralRegisterPage'])->name('referral.register.page');
    Route::post('/register', [UserController::class, 'registerNewUser'])->name('register');
    Route::post('/login', [UserController::class, 'login'])->name('login');

    Route::get('/logout', [UserController::class, 'userLogout'])->name('logout');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/myreferral', [UserController::class, 'MyReferral'])->name('myreferral');
    Route::get('/mytree', [UserController::class, 'MyTree'])->name('mytree');
    Route::get('/earn_history', [UserController::class, 'EarnHistory'])->name('earn_history');
    Route::get('/edituser/{id}', [UserController::class, 'editUser'])->name('edituser');
    Route::post('/updateuser', [UserController::class, 'updateUser'])->name('updateuser');

    Route::get('/subscription', [SubscriptionController::class, 'subscriptionPage'])->name('subscription');
    // Route::get('/subscription/{id}', [SubscriptionController::class, 'subscriptionPage'])->name('subscription');
    Route::post('/subscriptions', [SubscriptionController::class, 'subscription'])->name('subscriptions');