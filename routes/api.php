<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\v1\ArticleAPIController;
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

Route::get('articles/{id}',[ArticleAPIController::class,'getByID']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('categories',CategoryController::class);
//    Route::resource('products','ProductController');
    Route::get('articles',[ArticleAPIController::class,'index']);
});
