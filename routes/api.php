<?php

use App\Http\Controllers\Api\AdministradorController;
use App\Http\Controllers\Api\FuncionarioController;
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

    Route::apiResource('/admins', AdministradorController::class)
        ->except(['store', 'update'])
        ->names('admins');

    Route::apiResource('/funcs', FuncionarioController::class)
        ->names('funcs');

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});