<?php

use App\Http\Controllers\dashboard_Ray_Employee\InvoiceController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


/////////////////////////////////////////pacients///////////////////////////////////
Route::get('/dashboard/ray_employee', function () {
    return view('dashboard.dashboard_ray_employee.dashboard');
})->middleware('auth:ray_employee')->name('dashboard.ray_employee');

///////////////////////////////////////////////////end  pacients//////////////////

//Route::group(['middleware'=>['auth:ray_employee'],"prefix"=>"ray_employee"],function(){
Route::middleware(['auth:ray_employee'])->group(function(){
       
        //############################# RayEmployee route ##########################################

        Route::resource('invoice', InvoiceController::class);

        //############################# end RayEmployee route ######################################

        //############################# completed_invoices route ##########################################
        Route::get('completed_invoices',[InvoiceController::class,'completed_invoices'])->name('completed_invoices');
        //############################# end completed_invoices route ##########################################

        //############################# view_rays/{id} route ##########################################
         Route::get('view_rays/{id}', [InvoiceController::class,'viewRays'])->name('view_rays');
         //############################# view_rays/{id} route ##########################################

         Route::get('/404', function(){
             return view('dashboard.404');
              })->name('404');




});


?>
