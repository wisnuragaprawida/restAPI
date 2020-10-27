<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\product;
use App\Http\Resources\productsCollection;
use App\Http\Controllers\productController;
use App\Http\Controllers\DestinationController;
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


Route::get('/product', function () {
    return new productsCollection(product::all());
});
Route::get('/product/{kategori}', [productController::class, 'index']);
Route::get('/destination', [DestinationController::class, 'index']);
Route::get('/destination/s/{params}', [DestinationController::class, 'search']);
