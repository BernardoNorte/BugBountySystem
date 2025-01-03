<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

Route::get('home', [ProgramsController::class, 'index'])->name('home');
Route::get('/', [ProgramsController::class, 'index'])->name('home');
Route::get('/programs/{program}', [ProgramsController::class, 'show'])->name('programs.show');

Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');

Route::get('/report', [ReportController::class, 'create'])->name('reports.create');
Route::post('report', [ReportController::class, 'store'])->name('reports.store');

Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');

Auth::routes();




