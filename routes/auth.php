<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\DoctorController;
use Illuminate\Support\Facades\Route;

// Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

         Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');


        /////////////////////////////////////////////user////////////////////////////////////////////////
           Route::post('register', [RegisteredUserController::class, 'store'])->name('user.register');
           Route::post('login/user', [AuthenticatedSessionController::class, 'store'])->name('login.user');
           Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout.user');
 
        //////////////////////////////////////////////////////////////////end user////////////////////////
   
    //////////////////////////////admin//////////////////////////////////////////////////////////////////
     Route::post('admin/register',[AdminController::class, 'register'])->name('admin.register');
     Route::post('login/admin',[AdminController::class, 'store'])->name('login.admin');
      Route::post('admin/logout', [AdminController::class, 'destroy'])->middleware('auth:admin')->name('admin.logout');

     ////////////////////////////////////////////////////end admin/////////////////////////////////////////

     ////////////////////////////////////doctors////////////////////////////////////////////////////
      Route::post('doctor/register',[DoctorController::class, 'register'])->name('doctor.register');
      Route::post('login/doctor',[DoctorController::class, 'store'])->name('login.doctor');
      Route::post('doctor/logout', [DoctorController::class, 'destroy'])->middleware('auth:doctor')->name('doctor.logout');

     ///////////////////////////////////end doctor///////////////////////////////////////////////////

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
// });

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    
   
});
