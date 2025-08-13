<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminRequestsController;
use App\Http\Controllers\BountyRequestController;
use App\Http\Controllers\UserProfileController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BountiesController;
use App\Http\Controllers\CompletedBountiesController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function (Request $request) {
    $query = User::query();

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->input('name') . '%');
    }

    $users = $query->limit(50)->get();

    return view('welcome', ['users' => $users]);
});

Route::get('/user/{name}', [UserProfileController::class, 'show'])->name('user.profile'); 

Route::get('/bounties', [BountiesController::class, 'index'])->name('bounties');

Route::get('/bounty-request', [BountyRequestController::class, 'index'])->middleware(['auth', 'verified'])->name('bounty-request');

Route::post('/bounty-request', [BountyRequestController::class, 'store'])->middleware(['auth', 'verified'])->name('bounty-request.store');

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
});

require __DIR__.'/auth.php';
