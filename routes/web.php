<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
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

Route::resource('/', FrontendController::class);


Route::group(['prefix' => 'admin','middleware' => 'auth'],function (){
    Route::resource('dashboard', DashboardController::class);

    Route::resource('categories', CategoryController::class);
    Route::post('categories/change-status',[CategoryController::class,'changeStatus'])->name('categories.changeStatus');
//
    Route::resource('subCategory', SubCategoryController::class);
    Route::post('subCategory/change-status',[SubCategoryController::class,'changeStatus'])->name('subCategory.changeStatus');

//
    Route::resource('articles', ArticleController::class);
    Route::get('getSubCategory',[ArticleController::class,'getSubCategory']);
    Route::post('articles/change-status',[ArticleController::class,'changeStatus'])->name('articles.changeStatus');
});
Auth::routes();

