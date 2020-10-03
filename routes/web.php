<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/product/get/{id}', [productController::class, 'index']);
Route::get('/product/show', [productController::class, 'show']);
Route::get('/product/create', [productController::class, 'create']);
Route::post('/product', [productController::class, 'store']);
Route::get('/product/{id}', [productController::class, 'edit']);
Route::put('/product/{id}', [productController::class, 'update']);
Route::delete('/product/{id}', [productController::class, 'destroy']);
