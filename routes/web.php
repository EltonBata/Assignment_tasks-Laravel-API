<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\RoutePath;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get(RoutePath::for('password.reset', '/reset-password/{token}'), function ($token) {
    return $token;
})
    ->middleware(['guest:' . config('fortify.guard')])
    ->name('password.reset');

Route::get('/', function () {
    return view('welcome');
});