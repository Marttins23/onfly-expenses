<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ExpenseController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;

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

Route::post('/register',[RegisterController::class, 'register'])->name('register-user');
Route::post('/login',[LoginController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources(['users' => UserController::class]);
    Route::resource('users.expenses', ExpenseController::class)->shallow();
});
