<?php

use App\Enums\AuthEnum;
use App\Enums\GenreEnum;
use App\Enums\RatingEnum;
use App\Enums\SaleEnum;
use App\Enums\UserEnum;
use App\Enums\ProductEnum;
use App\Enums\AssistanceEnum;
use App\Enums\NotificationEnum;

use App\Http\Controllers\AuthController;
use App\Http\Middleware\JwtMiddleware;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LogController;

/**
 * AUTH
 */
Route::prefix(AuthEnum::ROUTE_PREFIX)->group(function () {
	Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
	Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::middleware([JwtMiddleware::class])->group(function () {
	/**
	 * USERS
	 */
	Route::prefix(UserEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::post('/', [UserController::class, 'store'])->name('users.store');
		Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
		Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
		Route::post('/import/leads', [UserController::class, 'importLeads'])->name('users.importLeads')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN);
		Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.delete');
	});

	/**
	 * ASSISTANCES
	 */
	Route::prefix(AssistanceEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [AssistanceController::class, 'index'])->name('assistances.index')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::get('/{id}', [AssistanceController::class, 'show'])->name('assistances.show')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::post('/', [AssistanceController::class, 'store'])->name('assistances.store');
		Route::put('/{id}', [AssistanceController::class, 'update'])->name('assistances.update')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::delete('/{id}', [AssistanceController::class, 'destroy'])->name('assistances.delete')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
	});

	/**
	 * GENRES
	 */
	Route::prefix(GenreEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [GenreController::class, 'index'])->name('genres.index');
		Route::get('/{id}', [GenreController::class, 'show'])->name('genres.show')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::post('/', [GenreController::class, 'store'])->name('genres.store')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::put('/{id}', [GenreController::class, 'update'])->name('genres.update')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::delete('/{id}', [GenreController::class, 'destroy'])->name('genres.delete')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
	});

	/**
	 * NOTIFICATIONS
	 */
	Route::prefix(NotificationEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
		Route::get('/{id}', [NotificationController::class, 'show'])->name('notifications.show');
		Route::get('/{id}/check', [NotificationController::class, 'check'])->name('notifications.check');
		Route::post('/', [NotificationController::class, 'store'])->name('notifications.store')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::put('/{id}', [NotificationController::class, 'update'])->name('notifications.update')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::delete('/{id}', [NotificationController::class, 'destroy'])->name('notifications.delete')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
	});

	/**
	 * PRODUCTS
	 */
	Route::prefix(ProductEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [ProductController::class, 'index'])->name('products.index');
		Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
		Route::post('/', [ProductController::class, 'store'])->name('products.store')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::put('/{id}', [ProductController::class, 'update'])->name('products.update')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.delete')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
	});

	/**
	 * RATINGS
	 */
	Route::prefix(RatingEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [RatingController::class, 'index'])->name('ratings.index');
		Route::get('/{id}', [RatingController::class, 'show'])->name('ratings.show');
		Route::get('/recommend/{id}', [RatingController::class, 'recommend'])->name('ratings.recommend')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::post('/', [RatingController::class, 'store'])->name('ratings.store');
		Route::put('/{id}', [RatingController::class, 'update'])->name('ratings.update');
		Route::delete('/{id}', [RatingController::class, 'destroy'])->name('ratings.delete');
	});

	/**
	 * SALES
	 */
	Route::prefix(SaleEnum::ROUTE_PREFIX)->group(function () {
		Route::get('/', [SaleController::class, 'index'])->name('sales.index')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::get('/{id}', [SaleController::class, 'show'])->name('sales.show')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::get('/report/generate/{period}', [SaleController::class, 'reportGenerate'])->name('sales.reportGenerate')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN);
		Route::post('/', [SaleController::class, 'store'])->name('sales.store')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN . '-' . UserEnum::EMPLOYEE . '');
		Route::put('/{id}', [SaleController::class, 'update'])->name('sales.update')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN);
		Route::delete('/{id}', [SaleController::class, 'destroy'])->name('sales.delete')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN);
	});

	/**
	 * Logs
	 */
	Route::prefix('logs')->group(function () {
		Route::get('/', [LogController::class, 'index'])->name('logs.index')->middleware(RoleMiddleware::class . ':' . UserEnum::ADMIN);
	});
});

