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

//Uni-routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index.index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');

//Admin routes
//Users
Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->middleware('admin:admin_access')->name('users.index');
Route::get('/users/{id}', [App\Http\Controllers\UserController::class, 'show'])->middleware('admin:admin_access')->name('users.show');
Route::get('/users/create', [App\Http\Controllers\UserController::class, 'create'])->middleware('admin:admin_access')->name('users.create');
Route::get('/users/remove/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('admin:admin_access')->name('users.remove');
Route::get('/users/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->middleware('admin:admin_access')->name('users.update');

//Subjects
Route::get('/subjects', [App\Http\Controllers\SubjectController::class, 'index'])->middleware('admin:admin_access')->name('subjects.index');
Route::get('/subjects/{id}', [App\Http\Controllers\SubjectController::class, 'show'])->middleware('admin:admin_access')->name('subjects.show');
Route::get('/subjects/create', [App\Http\Controllers\SubjectController::class, 'create'])->middleware('admin:admin_access')->name('subjects.create');
Route::get('/subjects/remove/{id}', [App\Http\Controllers\SubjectController::class, 'destroy'])->middleware('admin:admin_access')->name('subjects.remove');
Route::get('/subjects/update/{id}', [App\Http\Controllers\SubjectController::class, 'update'])->middleware('admin:admin_access')->name('subjects.update');

//Groups
Route::get('/groups', [App\Http\Controllers\GroupController::class, 'index'])->middleware('admin:admin_access')->name('groups.index');
Route::get('/groups/{id}', [App\Http\Controllers\GroupController::class, 'show'])->middleware('admin:admin_access')->name('groups.show');
Route::get('/groups/create', [App\Http\Controllers\GroupController::class, 'create'])->middleware('admin:admin_access')->name('groups.create');
Route::get('/groups/remove/{id}', [App\Http\Controllers\GroupController::class, 'destroy'])->middleware('admin:admin_access')->name('groups.remove');
Route::get('/groups/update/{id}', [App\Http\Controllers\GroupController::class, 'update'])->middleware('admin:admin_access')->name('groups.update');

//Profiles
Route::get('/profiles/{id}', [App\Http\Controllers\ProfileController::class, 'show'])->middleware('admin:admin_access')->name('profiles.show');
