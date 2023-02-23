<?php

use App\Http\Controllers\AddToCardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



require __DIR__.'/admin.php';


// --------------------------------------------------frontend route start here -------------------------------------------------------------
require __DIR__.'/auth.php';

Route::get('/',[HomeController::class,'index'])->name('index');

Route::middleware(['userAuth','userVerified'])->prefix('user')->name('user.')->group(function(){
    Route::get('dashboard',[UserDashboardController::class,'dashboard'])->name('dashboard');
});

// buy add to card start here /
Route::prefix('add-to-card')->name('addToCard.')->group(function(){
    Route::get('index',[AddToCardController::class,'index'])->name('index');
    Route::get('store',[AddToCardController::class,'store','store'])->name('store');
    Route::get('update',[AddToCardController::class,'update'])->name('update');
    Route::get('destroy',[AddToCardController::class,'destroy'])->name('destroy');
});
// buy add to card end here /


Route::prefix('search')->name('search.')->group(function(){
    Route::get('buy-book',[SearchController::class,'buyBook'])->name('buyBook');
    Route::get('buy-book/details/{isbn?}',[SearchController::class,'buyBookDetails'])->name('buyBook.Details');
    Route::get('sell-book',[SearchController::class,'sellBook'])->name('sellBook');
    Route::get('amazon-price-history/{isbn?}',[SearchController::class,'amazonPriceHistory'])->name('price.history');
});


Route::get('test',function(){
    return view('test');
});


 /*
|------------------------------------------ 
| redirect page not found 404
*/
Route::fallback(function(){
    return view('errors.404');
});
//--------redirect end here------


// --------------------------------------------------frontend route end here -------------------------------------------------------------


