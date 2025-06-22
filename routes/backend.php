<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Dashboard\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
/////////////////////////////////////////pacients/////////////////////////
Route::get('/dashboard/user', function () {
    return view('dashboard.user.dashboard');
})->middleware('auth')->name('dashboard.user');

///////////////////////////////////////////////////end  pacients//////////////////


/////////////////////////////////////////doctors/////////////////////////
// Route::get('/dashboard/doctor', function () {
//     return view('dashboard.doctors.dashboard');
// })->middleware('auth')->name('dashboard.doctor');



///////////////////////////////////////////////////end  doctors//////////////////


/////////////////////////////////////////////admin///////////////////////////
Route::group(["prefix"=>""],function(){
});
Route::get('/dashboard/admin', function () {
    return view('dashboard.admin.dashboard');
})->middleware('auth:admin')->name('dashboard.admin');
/////////////////////////////////////////end admin//////////////////////////////

   





 Route::middleware(['auth:admin'])->group(function(){
    /////////section///
    Route::resource("section",SectionController::class);

    ////end section//////

    ///doctor////////////
    route::resource('doctors',DoctorController::class);
    ////////end doctor/////////

 });
////////////////////////////////////////
require __DIR__.'/auth.php';