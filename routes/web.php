<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminRequestsController;
use App\Http\Controllers\BountyRequestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/bounties', [App\Http\Controllers\BountiesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('bounties');

Route::get('/bounty-request', [BountyRequestController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('bounty-request');

Route::post('/bounty-request', [BountyRequestController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('bounty-request.store');

Route::get('/completed-bounties', [App\Http\Controllers\CompletedBountiesController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('completed-bounties');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])
        ->name('admin.users.destroy');

    Route::get('/admin/requests', [AdminRequestsController::class, 'index'])->name('admin.requests');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
