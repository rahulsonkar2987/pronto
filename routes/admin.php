<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SocialLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\HelpController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\ManageBookController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SubCategoryController;

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



Route::group(['prefix'=>'admin','as'=>'admin.'], function(){

    /*
    |------------------------------------------ 
    |   admin auth routes start her
    */
        require __DIR__.'/admin/authWeb.php';
    //-----------admin auth end here------


    /*
    |------------------------------------------
    |admin auth start here 
    */
    Route::middleware('admin')->group(function(){


        /*
        |----------------------------------------------
        | coupon module start here 
        */
        Route::resource('coupon', CouponController::class);
        // coupon end here 

        /*
        |-----------------------------------------------
        | banner module start here 
        */
        Route::resource('banner', BannerController::class);
        // banner module end here 

        Route::resource('manage', AdminController::class);
        // Route::get('table',[AdminController::class,'loadData'])->name('table');


        /*
        |--------------------------------------
        |   Roles route start her
        */
        Route::resource('roles', RoleController::class);
        // Roles route  end here

        /*
        |--------------------------------------------
        | User section start here 
        */
        Route::resource('user', UserController::class);
        // User section end here


        /*
        |--------------------------------------------------
        |Manage website setting start here 
        */
        Route::prefix('setting')->name('setting.')->group(function(){
            /*
            |------------------------------------------------
            | website config section start her 
            */
            Route::prefix('general')->name('general.')->group(function(){
                Route::get('index/{action?}',[ConfigController::class,'index'])->name('index');
                Route::patch('update/{id?}',[ConfigController::class,'update'])->name('update');
            });
            // website config section end her
            /*
            |-----------------------------------------------
            |  social login api section start here
            */
            Route::prefix('social')->name('social.')->group(function(){
                Route::get('index',[SocialLoginController::class,'index'])->name('index');
                Route::patch('update',[SocialLoginController::class,'update'])->name('update');
            });
            // social login api end here

                
        });
        //Manage website setting end here



        /**
         * ---------------------------------------------------------------
         * provider ratting module start  here
        */    
        Route::prefix('rating')->name('rating.')->group(function(){
            Route::get('index',[ProviderRatingController::class,'index'])->name('index');
        });
        // provider ratting module end here
        Route::get('fetch_sub_category',[ManageBookController::class,'fetchSubCategory'])->name('fetchSubCategory');
           
        /*
        |------------------------------------------------------
        | fag module start here 
        */
        Route::resource('faq',FaqController::class);
        // fag module end here 

        /*
        |-------------------------------------------------------
        |main category module start here 
        */
        Route::resource('main_category', MainCategoryController::class);
        // main category module end here 

        /*
        |-------------------------------------------------------
        |sub category module start here 
        */
        Route::resource('sub_category', SubCategoryController::class);
        //sub module end here
        




        /**
        |-------------------------------------------------------------------------------------
        | Help module start here 
        */
        // Route::resource('help', HelpController::class);
        Route::prefix('help')->name('help.')->group(function(){
            Route::get('index',[HelpController::class,'index'])->name('index');
            Route::get('reply/{help}',[HelpController::class,'reply'])->name('reply');
            Route::post('update/{help}',[HelpController::class,'update'])->name('update');
            Route::post('type',[HelpController::class,'type'])->name('type');
            Route::post('destroy/{help}',[HelpController::class,'destroy/help'])->name('destroy');
        }); 
        // help module end here


        /**
         * -----------------------------------------------------------------------------------------
         * order module start here
         */
        Route::resource('order', OrderController::class);
        // order module end here 


        /**
         * manage book start here 
         */
        Route::resource('manage-book', ManageBookController::class);
        Route::get('load-author',[ManageBookController::class,'loadAuthorName'])->name('loadAuthorName');
        Route::get('get-book-data-from-isbn',[ManageBookController::class,'GetBookDataFromIsbn'])->name('getBookData');
        // manage book end here


        /**
         * author module start here 
         */
        Route::resource('author', AuthorController::class);
        // author module end here






    });
    // admin auth end here 
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

