<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgramsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RewardsController;

Route::get('home', [ProgramsController::class, 'index'])->name('home');
Route::get('/', [ProgramsController::class, 'index'])->name('home');
Route::get('/reports/edit/{report}', [ReportController::class, 'edit'])->name('reports.edit');
Route::get('/reports/myReports', [ReportController::class, 'myReports'])->name('reports.myReports');
Route::get('/programs/{program}', [ProgramsController::class, 'show'])->name('programs.show');

Route::get('/user/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/report/{program}', [ReportController::class, 'customReport'])->name('reports.custom');
Route::get('/report', [ReportController::class, 'create'])->name('reports.create');

Route::post('report', [ReportController::class, 'store'])->name('reports.store');

Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
Route::put('/reports/edit/{report}', [ReportController::class, 'update'])->name('reports.update');
Route::delete('/report/{report}', [ReportController::class, 'destroy'])->name('reports.destroy');

Route::patch('/reports/{report}/status', [ReportController::class, 'updateStatus'])->name('reports.updateStatus');

Route::get('/rewards', [RewardsController::class, 'myPayments'])->name('rewards.myRewards');

Route::post('/reports/{report}/pay', [ReportController::class, 'pay'])->name('reports.pay');

Auth::routes();




