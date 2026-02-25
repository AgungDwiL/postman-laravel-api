<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.[] Make something great!
|
*/
Route::post('/add-product', [ProductController::class, 'create']);
Route::get('/{id}', [ProductController::class, 'get'])->where('id', '[0-9]+');
Route::patch('/{id}', [ProductController::class, 'update'])->where('id', '[0-9]+');
