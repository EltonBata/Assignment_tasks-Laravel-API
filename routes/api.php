<?php

use App\Http\Controllers\Api\EtapaController;
use App\Http\Controllers\Api\FuncionarioController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SupervisaoController;
use App\Http\Controllers\Api\TarefaController;
use App\Http\Controllers\AuthController;
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

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:api'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::apiResource('/funcs', FuncionarioController::class)
        ->except('store')
        ->names('funcs');

    Route::apiResource('/roles', RoleController::class)
        ->except('show')
        ->names('roles');

    Route::apiResource('/tasks', TarefaController::class)
        ->names('tasks');

    Route::apiResource('/etapas', EtapaController::class)
        ->except(['show', 'index'])
        ->names('etapas');

    Route::apiResource('/supervisoes', SupervisaoController::class)
        ->except('index')
        ->parameters('supervisao')
        ->names('supervisao');
});