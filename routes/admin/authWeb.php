<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| admin auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can admin login web routes for your application. 
| prefix admin and route admin
|
*/

Route::get('/', [AuthenticatedSessionController::class,'create'])->name('create');
Route::post('/', [AuthenticatedSessionController::class,'store'])->name('login');

Route::middleware('admin')->group(function(){
    Route::get('destroy',[AuthenticatedSessionController::class,'destroy'])->name('destroy');
    Route::get('password',[AuthenticatedSessionController::class,'editPassword'])->name('edit.password');
    Route::post('password',[AuthenticatedSessionController::class,'updatePassword'])->name('password.update');
    Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');
});