<?php

use App\Http\Controllers\Guest\WelcomeController;
use App\Http\Controllers\Guest\BountiesController;
use App\Http\Controllers\Guest\UserProfileController;
use App\Http\Controllers\Guest\CompletedBountiesController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ClaimBountyController;
use App\Http\Controllers\User\BountyRequestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminRequestsController;
use App\Http\Controllers\Admin\AdminDashboardController;

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [WelcomeController::class, 'index'])->name('home');
Route::get('/bounties', [BountiesController::class, 'index'])->name('bounties');
Route::get('/user/{name}', [UserProfileController::class, 'show'])->name('user.profile'); 
Route::get('/completed-bounties', [CompletedBountiesController::class, 'index'])->name('completed-bounties');

Route::middleware(['admin'])->group(function () {
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::patch('/admin/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('admin.users.toggleRole');

    Route::get('/admin/requests', [AdminRequestsController::class, 'index'])->name('admin.requests');
    Route::post('/admin/requests', [AdminRequestsController::class, 'store'])->name('admin.requests.store');
    Route::put('/admin/bounties/{id}', [AdminRequestsController::class, 'update'])->name('admin.requests.update');
    Route::get('/admin/bounties/{id}/edit', [AdminRequestsController::class, 'edit'])->name('admin.requests.edit');
    Route::delete('/admin/requests/{id}', [AdminRequestsController::class, 'destroy'])->name('admin.requests.destroy'); 
    Route::delete('/admin/claimed-bounties/{id}', [ClaimBountyController::class, 'destroy'])->name('admin.claimed-bounties.destroy');
    Route::post('/admin/claimed-bounties/{id}/verify', [ClaimBountyController::class, 'verify'])->name('admin.claimed-bounties.verify');
    Route::delete('/admin/requests/user/{id}', [AdminRequestsController::class, 'destroyRequest'])->name('admin.requests.user.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/bounty-request', [BountyRequestController::class, 'index'])->name('bounty-request');
    Route::post('/bounty-request', [BountyRequestController::class, 'store'])->name('bounty-request.store');
    Route::post('/bounties/{id}/claim', [ClaimBountyController::class, 'store'])->name('bounties.claim');
});

require __DIR__.'/auth.php';