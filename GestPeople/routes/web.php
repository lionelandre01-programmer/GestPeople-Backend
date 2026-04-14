<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartamentoController;

Route::get('/',[DepartamentoController::class, 'index']);
Route::get('/user', function () {
    return Auth::user();
});