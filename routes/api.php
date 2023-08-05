<?php

use App\Http\Controllers\Api\FuncionarioController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TarefaController;
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

Route::middleware(['web', 'auth'])->group(function () {

    Route::apiResource('/funcs', FuncionarioController::class)
        ->except('store')
        ->names('funcs');

    Route::apiResource('/roles', RoleController::class)
        ->except('show')
        ->names('roles');

    Route::apiResource('/tasks', TarefaController::class)
        ->names('tasks');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});