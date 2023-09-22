<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ProductsController::class)->group(function () {
    Route::get('/products', 'index');
});


Route::controller(QuotationController::class)->group(function () {
    Route::get('/quotations', 'index');
    Route::post('/quotation', 'store');
});
