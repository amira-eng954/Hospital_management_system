<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\LaboratorieEmployeeController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\DoctorController;
use App\Http\Controllers\Auth\RayEmployeeController;
use Illuminate\Support\Facades\Route;

// Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    //     ->name('register');

          Route::get('login', [AuthenticatedSessionController::class, 'create'])
         ->name('login');


        /////////////////////////////////////////////patient////////////////////////////////////////////////
           Route::post('register', [RegisteredUserController::class, 'store'])->name('patient.register');
           Route::post('login/user', [AuthenticatedSessionController::class, 'store'])->name('login.patient');
           Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware(['auth:patient'])->name('logout.patient');
 
        //////////////////////////////////////////////////////////////////end patient////////////////////////
   
    //////////////////////////////admin//////////////////////////////////////////////////////////////////
     Route::post('admin/register',[AdminController::class, 'register'])->name('admin.register');
     Route::post('login/admin',[AdminController::class, 'store'])->name('login.admin');
      Route::post('admin/logout', [AdminController::class, 'destroy'])->middleware('auth:admin')->name('logout.admin');

     ////////////////////////////////////////////////////end admin/////////////////////////////////////////

     ////////////////////////////////////doctors////////////////////////////////////////////////////
      Route::post('doctor/register',[DoctorController::class, 'register'])->name('doctor.register');
      Route::post('login/doctor',[DoctorController::class, 'store'])->name('login.doctor');
      Route::post('doctor/logout', [DoctorController::class, 'destroy'])->middleware('auth:doctor')->name('logout.doctor');

     ///////////////////////////////////end doctor///////////////////////////////////////////////////

     ////////////////////////////////////////////////////////ray_employee/////////////////
      Route::post('ray_employee/register',[RayEmployeeController::class, 'register'])->name('ray_employee.register');
      Route::post('login/ray_employee',[RayEmployeeController::class, 'store'])->name('login.ray_employee');
      Route::post('ray_employee/logout', [RayEmployeeController::class, 'destroy'])->middleware(['auth:ray_employee'])->name('ray_employee.logout');

      ///////////////////////////////////////////////////////////end ray_employee//////////////

      //////////////////////////////////////////////////////////////login.laboratorie_employee///
       Route::post('laboratorie_employee/register',[LaboratorieEmployeeController::class, 'register'])->name('laboratorie_employee.register');
      Route::post('login/laboratorie_employee',[LaboratorieEmployeeController::class, 'store'])->name('login.laboratorie_employee');
      Route::post('laboratorie_employee/logout', [LaboratorieEmployeeController::class, 'destroy'])->middleware(['auth:laboratorie_employee'])->name('laboratorie_employee.logout');
      ///////////////////////////////////////////////////////////////end laboratorie_employee////


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
