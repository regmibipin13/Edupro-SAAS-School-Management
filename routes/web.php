<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SchoolsController;
use App\Http\Controllers\Admin\UsersController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Admin Routes
Route::group(['as' => 'admin.', 'middleware' => ['auth', 'is_admin'], 'prefix' => 'admin'], function () {
    // Dashboard Page
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'adminIndex'])->name('dashboard');

    // Permissions Page
    Route::resource('permissions', PermissionsController::class);

    // Permissions Page
    Route::resource('roles', RolesController::class);

    // Users
    Route::resource('users', UsersController::class);

    // Schools
    Route::resource('schools', SchoolsController::class);
});



// Normal User Routes
Route::group(['as' => 'frontend.', 'middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'userIndex'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
