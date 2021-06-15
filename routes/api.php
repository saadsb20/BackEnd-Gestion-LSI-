<?php

use App\Http\Controllers\AuthController;
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



Route::group(
    [
        'middleware' => 'api',
    ],
    function ($router) {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/checkToken', [AuthController::class, 'checkToken']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
    }
);

Route::post('/register', [AuthController::class, 'register']);
Route::get('/adminprofile', [AuthController::class, 'AdminProfile'])->middleware(['api', 'role:Admin']);;
Route::get('/getstu', [AuthController::class, 'GetStu'])->middleware(['api', 'role:Admin']);;
Route::get('/getpro', [AuthController::class, 'GetPro'])->middleware(['api', 'role:Admin']);;

Route::get('/teacherprofile', [AuthController::class, 'TeacherProfile'])->middleware(['api', 'role:Teacher']);
Route::get('/studentprofile', [AuthController::class, 'StudentProfile'])->middleware(['api', 'role:Student']);
