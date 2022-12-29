<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

//Resources
Route::resource('subjects', App\Http\Controllers\SubjectController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('groups', App\Http\Controllers\GroupController::class);
Route::resource('profiles', App\Http\Controllers\ProfileController::class);

//Uni-routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
