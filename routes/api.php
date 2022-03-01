<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\TimelineController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [RegisterController::class, 'register'])->name('register.index');
Route::post('login', [LoginController::class, 'login'])->name('login.index');

// add doctor
// Route::get('add-doctor/',[DoctorController::class, 'addDoctor'])->name('doctor.add');
// Route::post('add-doctor/',[DoctorController::class, 'saveAddDoctor']);

