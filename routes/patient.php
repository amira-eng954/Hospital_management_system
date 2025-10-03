<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard_patient\PatientController;
use  App\Livewire\Chat\CreateChat;
use App\Livewire\Chat\Main;

Route::get('/', function () {
    return view('welcome');
});
/////////////////////////////////////////pacients///////////////////////////////////
Route::get('/dashboard/patient', function () {
    return view('dashboard.dashboard_patient.dashboard');
})->middleware('auth:patient')->name('dashboard.patient');
//
///////////////////////////////////////////////////end  pacients//////////////////


   Route::middleware(['auth:patient'])->group(function(){
     
    //#############################  invoices.patient route ######################################
       Route::get('invoices22/patient',[PatientController::class,'invoices'])->name('invoices22.patient');
     //#############################  invoices.patient route ######################################

     //#############################  laboratories.patient route ######################################
       Route::get('laboratories/patient',[PatientController::class,'laboratories'],)->name('laboratories.patient');
       Route::get('laboratories/view/{id}',[PatientController::class,'view_laboratories'])->name('laboratories.view');
     //############################# laboratories.patient route ######################################

     //#############################  rays.patient route ######################################
       Route::get('rays/patient/details',[PatientController::class,'rays'])->name('rays22.patient');
       Route::get('rays22/view/{id}',[PatientController::class,'view_ray'])->name('rays22.view');
     //#############################  rays.patient route ######################################

       Route::get('payments', [PatientController::class,'payments'])->name('payments.patient');

      
         //############################# Chat route ##########################################
         Route::get('list/doctors',CreateChat::class)->name('list.doctors');
         Route::get('chat/doctors',Main::class)->name('chat.doctors');

        //############################# end Chat route ######################################

        
   });
?>