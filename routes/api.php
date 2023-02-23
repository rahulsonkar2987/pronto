<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\MainCategoryController;
use App\Http\Controllers\Admin\PetCategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Api\HelpApi;
use App\Http\Controllers\Api\OrderMessageApi;
use App\Http\Controllers\Api\PetManageApi;
use App\Http\Controllers\Api\ProviderServiceApi;
use App\Http\Controllers\Api\RatingApi;
use App\Http\Controllers\Api\SearchApi;
use App\Http\Controllers\Api\UserApi;
use App\Models\Provider;
use App\Models\ProviderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
// });

/*
|----------------------------------------------
| user api section start here 
*/
Route::prefix('user')->group(function(){
    Route::post('sign_up',[UserApi::class,'signUp']); 
    Route::post('sign_in',[UserApi::class,'signIn']);
    Route::post('password_reset',[UserApi::class,'passwordReset']);

    // SocialLogin api 
    Route::post('socialite',[UserApi::class,'SocialLogin']);
});
/**
 * middleware auth sanctum start here
 */
Route::group(['middleware'=>"auth:sanctum",'prefix'=>'user'],function(){
    route::post('sign_out',[UserApi::class,'signOut']);
    route::post('update',[UserApi::class,'update']);
    Route::post('update',[UserApi::class,'providerUpdate']);
    route::post('change_password',[UserApi::class,'changePassword']);

    /*
    |----------------------------------------------
    | banner api section start here 
    */
    Route::prefix('pet-manage')->name('petManage.')->group(function(){
        Route::get('index',[PetManageApi::class,'index'])->name('index');
        Route::post('store',[PetManageApi::class,'store'])->name('store');
        Route::get('show/{id}',[PetManageApi::class,'show'])->name('show');
        Route::post('update/{id}',[PetManageApi::class,'update'])->name('update');
        Route::get('destroy/{id}',[PetManageApi::class,'destroy'])->name('destroy');
    });
    // pet manage api end here


    /**
     * provider Service api start here
     */
    Route::prefix('provider/service')->group(function(){
        Route::get('index',[ProviderServiceApi::class,'index']);
        Route::post('store',[ProviderServiceApi::class,'store']);
        Route::post('update',[ProviderServiceApi::class,'update']);
        Route::post('destroy',[ProviderServiceApi::class,'destroy']);
    });
    // provider service api end here

    /*---------------------------------------------
    | help message module start here
    */
    Route::prefix('help')->name('help.')->group(function(){
        route::post('message-send',[HelpApi::class,'messageSend']);
    });
    // help message module end here


    /**
     * order message module start here 
     */  
    Route::prefix('order/message')->group(function(){
        Route::get('index/{order_id}',[OrderMessageApi::class,'index']);
        Route::post('store',[OrderMessageApi::class,'store']);
    });
    // order message module end here

    /**
     * rating api start here 
     */
    Route::prefix('rating')->group(function(){
        Route::get('index',[RatingApi::class,'index']);
        Route::post('store',[RatingApi::class,'store']);
    });
    // user api section start here 

});
// * middleware auth sanctum end here


// provider Auth start here 
// Route::prefix('provider')->group(function(){
//     Route::post('sign_in',[ProviderAuthApi::class,'signIn']);
// });
// Route::group(['middleware'=>"auth:sanctum",'prefix'=>'provider'],function(){
//     Route::post('update',[ProviderAuthApi::class,'providerUpdate']);
// });
// provider Auth end here 



 


/*
|----------------------------------------------
| banner api section start here 
*/
Route::get('banner/view/{id?}',[BannerController::class,'index']);
// banner api end here

/* 
|-----------------------------------------------------
| Service Categories start here 
*/
    Route::prefix('service')->name('service.')->group(function(){
        Route::post('main-categories/{id?}',[MainCategoryController::class,'index'])->name('mainCategories');
        Route::post('sub-categories/{id?}',[SubCategoryController::class,'index'])->name('subCategories');
    });
//Service categories end here

/**
 |----------------------------------------------------------
 | pet Category api start here
 */
Route::prefix('pet-category')->name('petCategory.')->group(function(){
    Route::get('index',[PetCategoryController::class,'index'])->name('index');
});
// pet category api end here



/*
|----------------------------------------------
| setting api section start here 
*/
Route::prefix('setting')->name('api.setting.')->group(function(){
    Route::get('config/{action?}',[ConfigController::class,'index'])->name('config');
    Route::get('social-login/{action?}/{api_key?}',[ConfigController::class,'index'])->name('api')->middleware('api_guard');
    Route::get('page-seo',[ConfigController::class,'index'])->name('pageSeo');
});
// setting api end here 

// search api start here 
Route::prefix('search')->group(function(){
    Route::get('main-category-name',[SearchApi::class,'index']);
    Route::get('list-service/{search}',[SearchApi::class,'listService']);
    Route::post('/',[SearchApi::class,'search']);
    Route::post('advance',[SearchApi::class,'advance']);
    Route::get('random/{limit?}',[SearchApi::class,'random']);
    Route::get('show/{provider_id}',[SearchApi::class,'show']);
}); 
// search api section end here 



Route::fallback(function () {
    return response()->json(['success'=>false,'msg'=>'This is not allowed for the url.Please put the correct url']);
});




