<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ManageProductController;
use App\Http\Controllers\MyMainProfileController;
use App\Http\Controllers\MyProfileSliderController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductPriceController;
use App\Http\Controllers\StaffController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/our-clients', [App\Http\Controllers\MyProfileClientController::class, 'getClientList']);
Route::get('/find-id-by-slug', [App\Http\Controllers\MyBrandConentController::class, 'find']);



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', 'CustomAuthController@login');
    Route::post('/logout', 'CustomAuthController@logout');
    Route::post('/refresh', 'CustomAuthController@refresh');
    Route::any('/user-profile', 'CustomAuthController@me');
});


Route::post('cms-auth/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->get('cms-auth/user', [AuthController::class, 'getUserInfo']);


Route::get('/products',[MyMainProfileController::class, 'index']);
Route::get('/product/detail/{parentId}/{id}', [ProductDetailController::class, 'show']);

Route::middleware('auth:sanctum')->group(function() {
    Route::prefix("cms-product")->group(function(){
        Route::post("{id}/update-price",[ProductPriceController::class,'updatePrice']);
    });
});

Route::prefix('cms-user')->middleware('auth:sanctum')->group(function() {
    Route::get('manage', [StaffController::class, 'viewAdminManage'])->name('cms-user.manage');
    Route::get('edit/{id}', [StaffController::class, 'viewAdminEdit'])->name('cms-user.edit');
    Route::get('create', [StaffController::class, 'viewAdminCreate'])->name('cms-user.create');
    Route::post('store', [StaffController::class, 'store'])->name('cms-user.store');
    Route::put('update', [StaffController::class, 'update'])->name('cms-user.update');
    Route::delete('destroy/{id}', [StaffController::class, 'destroy'])->name('cms-user.destroy');
});

Route::prefix('slider')->middleware('auth:sanctum')->group(function() {
    Route::get('manage', [MyProfileSliderController::class, 'manageSlider']);
    Route::get('edit/{id}', [MyProfileSliderController::class, 'viewEdit']);
    Route::get('create', [MyProfileSliderController::class, 'viewAdminCreate']);
    Route::post('store', [MyProfileSliderController::class, 'store']);
    Route::post('update', [MyProfileSliderController::class, 'update']);
    Route::delete('destroy/{id}', [MyProfileSliderController::class, 'destroy']);
});


Route::post('auth/register', 'CustomAuthController@register');
Route::get('auth/check-number', 'StaffController@checkIfNumberRegistered');

Route::prefix("user")->group(function(){
    Route::get('{id}', 'StaffController@profile');
});

Route::get('sodaqo-category', 'MobileCategoryController@getAll');


Route::get('/stats', 'AndroidHomeController@stats');

Route::prefix('news')->group(function () {
    Route::get('/get', 'NewsController@get');
});

Route::get('/colek-service', 'ColekController@colek');
Route::get('/auth/colek', 'ColekController@colek');
Route::post('/auth/registerNumber', 'StaffController@registerNumber');

Route::prefix('user')->group(function () {
    Route::post('{id}/checkPassword', 'StaffController@checkPassword');
    Route::post('{id}/updatePasswordCompact', 'StaffController@updatePasswordCompact');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::prefix('user')->group(function () {
        Route::post('/update-photo', 'StaffController@updateProfilePhoto');
        Route::post('/update-data', 'StaffController@update');
        Route::post('/change-password', 'StaffController@updatePassword');
    });



    Route::prefix('price')->group(function () {
        Route::get('/', 'PriceController@getAll');
    });

    Route::post('save-user', 'UserController@saveUser');
    Route::put('edit-user', 'UserController@editUser');
});






