<?php

use App\Http\Controllers\Dashboard_Laboratorie_Employee\InvoiceController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


/////////////////////////////////////////pacients///////////////////////////////////
Route::get('/dashboard/laboratorie_employee', function () {
    return view('dashboard.dashboard_laboratorie_employee.dashboard');
})->middleware('auth:laboratorie_employee')->name('dashboard.laboratorie_employee');

///////////////////////////////////////////////////end  pacients//////////////////


Route::middleware(['auth:laboratorie_employee'])->group(function(){

    //############################# invoices_laboratorie_employee invoices_laboratorie_employee route ######################################
              Route::resource('invoices_laboratorie_employee', InvoiceController::class);

    //############################# end invoices_laboratorie_employee route ######################################

    //#############################  view_laboratories route ######################################
         Route::get('completed_invoices_laboratorie',[InvoiceController::class,'comboleted'])->name('laboratorie_employee_completed_invoices');

    //############################# end view_laboratories route ######################################

     //#############################  view_laboratories route ######################################
         Route::get('view_laboratories/{id}', [InvoiceController::class,'view_laboratories'])->name('view_laboratories');

    //############################# end view_laboratories route ######################################




});

    
  

















