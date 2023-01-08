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
Route::get('users/{id}/roles', [App\Http\Controllers\UserController::class, 'roleShow'])->name('users.roles.show');
Route::patch('users/{id}/roles', [App\Http\Controllers\UserController::class, 'roleUpdate'])->name('users.roles.update');

Route::resource('groups', App\Http\Controllers\GroupController::class);

Route::get('profiles/{id}/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profiles.edit');
Route::patch('profiles/{id}/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profiles.update');
Route::get('profiles/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->name('profiles.show');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::get('profile/edit', [App\Http\Controllers\ProfileController::class, 'editUserProfile'])->name('profile.edit');
Route::patch('profile/update', [App\Http\Controllers\ProfileController::class, 'updateUserProfile'])->name('profile.update');

//Routes
Route::get('/', function () {
    return redirect('dashboard');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
