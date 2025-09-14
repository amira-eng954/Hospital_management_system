<?php


use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


/////////////////////////////////////////pacients///////////////////////////////////
Route::get('/dashboard/ray_employee', function () {
    return view('dashboard.user.dashboard');
})->middleware('auth:ray_employee')->name('dashboard.ray_employee');

///////////////////////////////////////////////////end  pacients//////////////////



?>
