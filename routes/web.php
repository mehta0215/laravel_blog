<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectGroupController;
use Illuminate\Auth\Events\Login;

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

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/',[LoginController::class,'login'])->middleware('isAlreadyLoggedIn');
Route::post('/admin/dashboard', [LoginController::class,'signin'])->middleware('isAlreadyLoggedIn')->name('login-user');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/admin/section', [SectionController::class, 'index'])->name('section');
Route::post('/section-submit',[SectionController::class, 'store'])->name('section-submit');
Route::post('/section-update/{id}',[SectionController::class, 'update'])->name('section-update');
Route::delete('/delete-section/{id}', [SectionController::class,'destroy'])->name('delete-section');

Route::get('/admin/class',[ClassController::class, 'index'])->name('class');
Route::post('/class-submit',[ClassController::class, 'store'])->name('class-submit');
Route::post('/class-update/{id}',[ClassController::class, 'update'])->name('class-update');
Route::delete('/delete-class/{id}', [ClassController::class,'destroy'])->name('delete-class');

Route::get('/admin/subject', [SubjectController::class,'index'])->name('subject');
Route::post('/subject-submit', [SubjectController::class, 'store'])->name('subject-submit');
Route::post('/subject-update/{id}',[SubjectController::class, 'update'])->name('subject-update');
Route::delete('/delete-subject/{id}', [SubjectController::class, 'destroy'])->name('delete-subject');

Route::get('/admin/subject-group', [SubjectGroupController::class, 'index'])->name('subjectGroup');
Route::post('/group-submit',[SubjectGroupController::class,'store'])->name('group-submit');
Route::delete('delete-subjectGroup/{id}', [SubjectGroupController::class, 'destroy'])->name('delete-subjectGroup');
