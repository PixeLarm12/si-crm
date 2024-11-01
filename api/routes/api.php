<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;

Route::apiResource('users', UserController::class);
Route::apiResource('assistances', AssistanceController::class);
Route::apiResource('genres', GenreController::class);
Route::apiResource('notifications', NotificationController::class);
Route::apiResource('products', ProductController::class);
Route::apiResource('ratings', RatingController::class);
Route::apiResource('sales', SaleController::class);