<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\CafeController;

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

Route::get('/destination/create', [DestinationController::class, 'create']);
Route::post('/destination', [DestinationController::class, 'store']);
Route::get('/destination/show', [DestinationController::class, 'show']);
Route::get('/destination/{id}', [DestinationController::class, 'edit']);
Route::put('/destination/{id}', [DestinationController::class, 'update']);
Route::delete('/destination/{id}', [DestinationController::class, 'destroy']);

Route::get('/cafe/create', [CafeController::class, 'create']);
Route::get('/cafe/menu/create/{id}', [CafeController::class, 'createMenu']);

Route::post('/cafe', [CafeController::class, 'store']);
Route::post('/cafe/menu/{id}', [CafeController::class, 'storeMenu']);

Route::get('/cafe/show', [CafeController::class, 'show']);
Route::get('/cafe/info/{id}', [CafeController::class, 'showInfo']);

Route::get('/cafe/{id}', [CafeController::class, 'edit']);
Route::get('/cafe/menu/{id}', [CafeController::class, 'editMenu']);

Route::put('/cafe/{id}', [CafeController::class, 'update']);
Route::put('/cafe/menu/{id}', [CafeController::class, 'updateMenu']);

Route::delete('/cafe/{id}', [CafeController::class, 'destroy']);
Route::delete('/cafe/menu/{id}', [CafeController::class, 'destroyMenu']);
