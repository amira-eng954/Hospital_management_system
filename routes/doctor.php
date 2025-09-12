<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Doctor\InvoiceController;
use App\Http\Controllers\Dashboard_doctor\DiagnosticController;
Route::get('/', function () {
    return view('welcome');
});

/////////////////////////////////////////doctors/////////////////////////
Route::get('/dashboard/doctor', function () {
    return view('dashboard.Doctor.dashboard');
})->middleware(['auth:doctor'])->name('dashboard.doctor');



///////////////////////////////////////////////////end  doctors//////////////////

 

    //Route::middleware(['auth:doctor'])->prefix('doctor')->group(function(){
    Route::group(["middleware"=>["auth:doctor"],"prefix"=>"doctor"],function(){


 /////////////////////////////////////////////////////////invoice//////////////////////////////
       Route::resource("invoices",InvoiceController::class);
///////////////////////////////////////////////////////////////////end invoce/////////////////

//////////////////////////////////////////////////////////Diagnostics////////////////////////
         Route::resource("Diagnostics",DiagnosticController::class);
////////////////////////////////////////////////////////end Diagnostics/////////////////////

 });



////////////////////////////////////////
