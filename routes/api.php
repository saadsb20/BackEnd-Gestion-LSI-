<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SemestreController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PfeController;
use App\Http\Controllers\UserController;
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
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/checkToken', [AuthController::class, 'checkToken']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);

    }
);

 Route::get('/getstu/{semestre}', [UserController::class, 'GetStu'])->middleware(['api', 'role:Admin']);
 Route::put('/updateuser/{id}', [UserController::class, 'update'])->middleware(['api', 'role:Admin']);


 Route::get('/getpro', [UserController::class, 'GetPro'])->middleware(['api', 'role:Admin']);
 Route::delete('/deleteuser/{id}', [UserController::class, 'DeleteUser'])->middleware(['api', 'role:Admin']);

Route::resource('Modules',ModuleController::class)->middleware(['api', 'role:Admin|Student']);
Route::resource('Semestres',SemestreController::class)->middleware(['api', 'role:Admin']);
Route::resource('Seance',SeanceController::class)->middleware(['api', 'role:Admin|Student']);
Route::resource('Note',NoteController::class)->middleware(['api', 'role:Teacher|Student']);
Route::resource('Pfe',PfeController::class)->middleware(['api', 'role:Admin']);