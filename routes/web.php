<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'auth'])
    ->middleware(['auth'])->name('home');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard-visits', [DashboardController::class, 'visits'])->name('dashboard.visits');


    // student
    Route::get('/student-list', [StudentController::class, 'studentList'])->name('student.list');
    Route::post('/add-student', [StudentController::class, 'addStudent'])->name('add.student');
    Route::get('edit/{id}', [StudentController::class, 'edit_student']);
    Route::POST('/update-student', [StudentController::class, 'update_student'])->name('update.student');
    Route::get('delete/{id}', [StudentController::class, 'delete_student']);

    Route::view('/add-student-form', 'admin.student.add-student');

    // search
    Route::get('/search-student', [SearchController::class, 'searchStudent'])->name('search.student');


    // session
    Route::get('/session-page', [SessionController::class, 'startSessionPage'])->name('session.page');
    Route::post('/session-store', [SessionController::class, 'createSession'])->name('session.store');
    Route::get('/all-session', [SessionController::class, 'ShowAllSession'])->name('session.all');
    Route::get('/active-session', [SessionController::class, 'showActiveSession'])->name('active.session.view');


});

Route::prefix('admin', )->middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});

