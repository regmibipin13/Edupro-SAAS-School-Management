<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SchoolsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\User\ClassroomsController;
use App\Http\Controllers\User\ExamController;
use App\Http\Controllers\User\SectionsController;
use App\Http\Controllers\User\StudentsController;
use App\Http\Controllers\User\SubjectsController;
use App\Http\Controllers\User\UsersController as NormalUserController;
use App\Models\Exam;
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
Route::group(['as' => 'user.', 'middleware' => ['auth']], function () {
    // Dashboard Page
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'userIndex'])->name('dashboard');

    // Edit Own School
    Route::get('school/{school}', [App\Http\Controllers\User\SchoolController::class, 'index'])->name('schools.edit');
    Route::patch('school/{school}', [App\Http\Controllers\User\SchoolController::class, 'update'])->name('schools.update');

    // Classrooms
    Route::resource('classrooms', ClassroomsController::class);

    // Class Sections
    Route::resource('sections', SectionsController::class);

    // Users (Teachers, Parents, and other users)
    Route::resource('users', NormalUserController::class);

    // Subjects
    Route::resource('subjects', SubjectsController::class);

    // Exams
    Route::resource('exams', ExamController::class);

    // Students
    Route::resource('students', StudentsController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
