<?php

use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SchoolsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\User\AttendancesController;
use App\Http\Controllers\User\ClassroomsController;
use App\Http\Controllers\User\DaysController;
use App\Http\Controllers\User\ExamController;
use App\Http\Controllers\User\FeePaymentsController;
use App\Http\Controllers\User\GradesController;
use App\Http\Controllers\User\MarksController;
use App\Http\Controllers\User\MarksheetController;
use App\Http\Controllers\User\SectionsController;
use App\Http\Controllers\User\StudentsController;
use App\Http\Controllers\User\SubjectsController;
use App\Http\Controllers\User\TimesController;
use App\Http\Controllers\User\TimetablesController;
use App\Http\Controllers\User\UsersController as NormalUserController;
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
    return view('frontend.home');
});

Route::get('/home', function () {
    return redirect()->to('/dashboard');
});

Route::get('/school-registration', [FrontendController::class, 'register']);
Route::post('/school-registration', [FrontendController::class, 'postRegister'])->name('schools.register');
Route::get('/pay/success', [FrontendController::class, 'success']);
Route::get('/pay/error', [FrontendController::class, 'error']);

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
    Route::get('schools/login/{school}', [SchoolsController::class, 'login'])->name('schools.login');
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
    Route::get('classrooms/{classroom}/sections', [ClassroomsController::class, 'getSections'])->name('classrooms.getSections');
    Route::get('classrooms/{classroom}/subjects', [ClassroomsController::class, 'getSubjects'])->name('classrooms.getSubjects');
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
    Route::post('students/{student}/doc', [StudentsController::class, 'uploadDocs'])->name('students.uploadDoc');
    Route::resource('students', StudentsController::class);

    //Grades
    Route::resource('grades', GradesController::class);

    // Marks
    Route::resource('marks', MarksController::class);

    // Marksheet
    Route::get('marksheets/{student}/{exam}', [MarksheetController::class, 'marksheet'])->name('marksheets.view');
    Route::get('marksheets', [MarksheetController::class, 'index'])->name('marksheets.index');


    // Attendance
    Route::resource('attendances', AttendancesController::class);

    // Days
    Route::resource('days', DaysController::class);

    // Times
    Route::resource('times', TimesController::class);

    // Timetables
    Route::get('timetables/pdf', [TimetablesController::class, 'pdf'])->name('timetables.pdf');
    Route::get('timetables/all', [TimetablesController::class, 'allPdf'])->name('timetables.allpdf');
    Route::resource('timetables', TimetablesController::class);

    // Fee Payments
    Route::get('fees/pending', [FeePaymentsController::class, 'pending']);
    Route::get('fees/{feeId}/pdf', [FeePaymentsController::class, 'generatePDF'])->name('fees.pdf');
    Route::get('fees/export', [FeePaymentsController::class, 'export'])->name('fees.export');
    Route::resource('fees', FeePaymentsController::class);
    Route::post('pay/fee', [FeePaymentsController::class, 'pay']);
});

Route::middleware('auth')->group(function () {
    Route::get('profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
