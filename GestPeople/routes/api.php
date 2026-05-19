<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\FuncaoController;
use App\Http\Controllers\DesempenhoController;
use App\Http\Controllers\PresencaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\MessegeController;
use App\Http\Controllers\SuspensaoController;
use App\Http\Controllers\SalaryController;


Route::post('/login', [UserController::class, 'login']); //Rota para login
Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']); //Rota para logout

//Grupo de rotas para acessar as funcionalidades para interagir com os departamentos
Route::group(['prefix' => 'departamento', 'middleware' => 'auth:sanctum'], function(){

    Route::post('/create', [DepartamentoController::class, 'store']);
    Route::get('/users/count', [DepartamentoController::class, 'usersCount']);
    Route::get('/each/{id}', [DepartamentoController::class, 'eachDep']);
    Route::get('/get', [DepartamentoController::class, 'show']);
});

//Grupo de rotas para acessar as funcionalidades para interagir com os funções
Route::group(['prefix' => 'funcao', 'middleware' => 'auth:sanctum'], function(){

    Route::get('/', [FuncaoController::class, 'index']);
    Route::post('/create', [FuncaoController::class, 'store']);
    Route::get('/users/count', [FuncaoController::class, 'usersCount']);
    Route::get('/count', [FuncaoController::class, 'countFun']);
    Route::get('/get', [FuncaoController::class, 'show']);
});

//Grupo de rotas para acessar as funcionalidades para interagir com os usuários
Route::group(['prefix' => 'user', 'middleware' => 'auth:sanctum'], function(){

    Route::get('/all', [UserController::class, 'allUsers']);
    Route::get('/bests', [UserController::class, 'bestsUser']);
    Route::get('/last/suspensao', [UserController::class, 'lastSuspensao']);
    Route::post('/update', [UserController::class, 'update']);
    Route::get('/depAll', [UserController::class, 'depAllUser']);
    Route::post('/create', [UserController::class, 'store']);
});

//Grupo de rotas para acessar as funcionalidades para interagir com os desempenhos
Route::group(['prefix' => 'desempenho', 'middleware' => 'auth:sanctum'], function(){

    Route::get('/', [DesempenhoController::class, 'index']);
    Route::post('/create', [DesempenhoController::class, 'create']);
});

//Grupo de rotas para acessar as funcionalidades para interagir com os presenças
Route::group(['prefix' => 'presenca', 'middleware' => 'auth:sanctum'], function(){

    Route::get('/', [PresencaController::class, 'index']);
    Route::post('/create', [PresencaController::class, 'store']);
    Route::get('/information/{id}', [PresencaController::class, 'show']);
});

//Grupo de rotas para acessar as funcionalidades para interagir com os mensagens
Route::group(['prefix' => 'messege', 'middleware' => 'auth:sanctum'], function(){

    Route::get('/', [MessegeController::class, 'index']);
    Route::post('/send', [MessegeController::class, 'store']);
    Route::get('/see/{id}', [MessegeController::class, 'show']);
});

//Grupo de rotas para acessar as funcionalidades para interagir com os Salário
Route::group(['prefix' => 'salary', 'middleware' => 'auth:sanctum'], function(){

    Route::get('/', [SalaryController::class, 'index']);
    Route::post('/create', [SalaryController::class, 'store']);
    Route::get('/show/{id}', [SalaryController::class, 'show']);
});

//Grupo de rotas para acessar as funcionalidades para interagir com os Suspensão
Route::group(['prefix' => 'suspensao', 'middleware' => 'auth:sanctum'], function(){

    Route::get('/', [SuspensaoController::class, 'index']);
    Route::post('/create', [SuspensaoController::class, 'store']);
    Route::get('/information/{id}', [SuspensaoController::class, 'show']);
});

//Grupo de rotas para acessar as funcionalidades para interagir com os Pagamentos
Route::group(['prefix' => 'pagamento', 'middleware' => 'auth:sanctum'], function(){

    Route::get('/', [PagamentoController::class, 'index']);
    Route::post('/create', [PagamentoController::class, 'store']);
    Route::get('/information/{id}', [PagamentoController::class, 'show']);
});