<?php

use App\Http\Controllers\User\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminRequestsController;
use App\Http\Controllers\User\BountyRequestController;
use App\Http\Controllers\Guest\UserProfileController;
use App\Http\Controllers\Guest\BountiesController;
use App\Http\Controllers\Guest\CompletedBountiesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Guest\WelcomeController;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/user/{name}', [UserProfileController::class, 'show'])->name('user.profile'); 
Route::get('/bounties', [BountiesController::class, 'index'])->name('bounties');
Route::get('/completed-bounties', [CompletedBountiesController::class, 'index'])->name('completed-bounties');

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::patch('/admin/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('admin.users.toggleRole');

    Route::get('/admin/requests', [AdminRequestsController::class, 'index'])->name('admin.requests');
    Route::post('/admin/requests', [AdminRequestsController::class, 'store'])->name('admin.requests.store');
    Route::delete('/admin/requests/{id}', [AdminRequestsController::class, 'destroy'])->name('admin.requests.destroy'); 
    Route::delete('/admin/requests/user/{id}', [AdminRequestsController::class, 'destroyRequest'])->name('admin.requests.user.destroy');

    Route::get('/admin/bounties/{id}/edit', [AdminRequestsController::class, 'edit'])->name('admin.requests.edit');
    Route::put('/admin/bounties/{id}', [AdminRequestsController::class, 'update'])->name('admin.requests.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/bounty-request', [BountyRequestController::class, 'index'])->name('bounty-request');
    Route::post('/bounty-request', [BountyRequestController::class, 'store'])->name('bounty-request.store');
});

require __DIR__.'/auth.php';
