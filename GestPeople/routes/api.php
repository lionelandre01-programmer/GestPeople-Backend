<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\FuncaoController;

Route::post('/user/create', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/departamento/get', [DepartamentoController::class, 'show']);
Route::get('/funcao/get', [FuncaoController::class, 'show']);
Route::get('/auth/get', [UserController::class, 'getAuth']);
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::group(['prefix' => 'departamento', 'middleware' => 'auth:sanctum'], function(){

    Route::post('/create', [DepartamentoController::class, 'store']);
    Route::get('/users/count', [DepartamentoController::class, 'usersCount']);
});

Route::group(['prefix' => 'funcao', 'middleware' => 'auth:sanctum'], function(){

    Route::post('/create', [FuncaoController::class, 'store']);
    Route::get('/users/count', [FuncaoController::class, 'usersCount']);
    Route::get('/count', [FuncaoController::class, 'countFun']);
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function(){

    Route::get('/all', [UserController::class, 'allUsers']);
    Route::get('/bests', [UserController::class, 'bestsUser']);
    Route::get('/suspended/count', [UserController::class, 'userSuspended']);
    Route::get('/active/count', [UserController::class, 'activeUsers']);
    Route::post('/update', [UserController::class, 'update']);
});