<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LanguageTranslationController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
//use App\Http\Controllers\API\v1\ArticleAPIController;
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
Route::get('article/{slug}',[FrontendController::class,'detail'])->name('article.detail');
Route::get('categories/{name}',[FrontendController::class,'get_data_by_category'])->name('getByCategory');
Route::get('categories/sub_categories/{name}',[FrontendController::class,'get_data_by_sub_category'])->name('getBySubCategory');

Route::group(['prefix' => 'admin','middleware' => 'auth'],function (){
    Route::resource('dashboard', DashboardController::class);
    Route::post('dashboard',[DashboardController::class,'index'])->name('index.date_range');
    Route::resource('categories', CategoryController::class);
    Route::post('categories/change-status',[CategoryController::class,'changeStatus'])->name('categories.changeStatus');
//
    Route::resource('subCategory', SubCategoryController::class);
    Route::post('subCategory/change-status',[SubCategoryController::class,'changeStatus'])->name('subCategory.changeStatus');

//
    Route::resource('articles', ArticleController::class);
    Route::get('getSubCategory',[ArticleController::class,'getSubCategory']);
    Route::post('articles/change-status',[ArticleController::class,'changeStatus'])->name('articles.changeStatus');
//
    Route::resource('users', UserController::class);
    Route::post('users/change-status', [UserController::class,'changeStatus']);
    Route::post('user/reset-password', [UserController::class,'resetPassword'])->name('users.reset-password');
//
    Route::resource('profiles', ProfileController::class);
    Route::post('profiles/password',[ProfileController::class,'change_password'])->name('profiles.change_password');
//
    Route::resource('roles', RoleController::class);
    Route::post('roles/change-status',[RoleController::class,'changeStatus'])->name('roles.changeStatus');
//
    Route::get('languages', [LanguageTranslationController::class,'index'])->name('languages');
    Route::post('translations/update', [LanguageTranslationController::class,'transUpdate'])->name('translation.update.json');
    Route::post('translations/updateKey', [LanguageTranslationController::class,'transUpdateKey'])->name('translation.update.json.key');
    Route::delete('translations/destroy/{key}', [LanguageTranslationController::class,'destroy'])->name('translations.destroy');
    Route::post('translations/create', [LanguageTranslationController::class,'store'])->name('translations.create');
});
Auth::routes();

