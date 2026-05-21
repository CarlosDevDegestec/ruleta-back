<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PrizeController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ClaimController;
use App\Http\Controllers\Admin\ConfigController;

// Admin Auth
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Protected Admin Routes
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('prizes', PrizeController::class)->names([
        'index'   => 'admin.prizes.index',
        'create'  => 'admin.prizes.create',
        'store'   => 'admin.prizes.store',
        'edit'    => 'admin.prizes.edit',
        'update'  => 'admin.prizes.update',
        'destroy' => 'admin.prizes.destroy',
    ]);

    Route::resource('questions', QuestionController::class)->names([
        'index'   => 'admin.questions.index',
        'create'  => 'admin.questions.create',
        'store'   => 'admin.questions.store',
        'edit'    => 'admin.questions.edit',
        'update'  => 'admin.questions.update',
        'destroy' => 'admin.questions.destroy',
    ]);

    Route::get('claims', [ClaimController::class, 'index'])->name('admin.claims.index');

    Route::get('config', [ConfigController::class, 'edit'])->name('admin.config.edit');
    Route::put('config', [ConfigController::class, 'update'])->name('admin.config.update');
});
