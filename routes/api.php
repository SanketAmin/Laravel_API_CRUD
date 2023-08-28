<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\UserController;
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
Route::prefix('v1')->middleware('throttle:60,1')->group(function () {
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth:api'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        // Admin-only routes
        Route::middleware(['role:admin'])->group(function () {
            Route::post('delete/transaction', [UserController::class, 'deleteFinancialTransaction'])->name('deleteFinancialTransaction');
        });

        // User-only routes
        Route::middleware(['role:user'])->group(function () {
            Route::post('create/transaction', [UserController::class, 'storeFinancialTransaction'])->name('storeFinancialTransaction');
            Route::post('all-user-transactions', [UserController::class, 'getAllUserFinancialTransaction'])->name('getAllUserFinancialTransaction');
            Route::post('update/transaction', [UserController::class, 'updateFinancialTransaction'])->name('updateFinancialTransaction');
        });

    });
});
