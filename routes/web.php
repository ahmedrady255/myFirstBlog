<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['auth', 'verified'])->group(function () {
Route::get('/myPosts', [PostsController::class, 'index'])->name('posts.index');
Route::get('/myPosts/create', [PostsController::class, 'create'])->name('post.create');
Route::post('/myPosts', [PostsController::class, 'store'])->name('post.store');
Route::get('/myPosts/{post}', [PostsController::class, 'show'])->name('post.show');
Route::get('/myPosts/{id}/edit', [PostsController::class, 'edit'])->name('post.edit');
Route::put('/myPosts/{id}', [PostsController::class, 'update'])->name('post.update');
Route::delete('/myPosts/{id}', [PostsController::class, 'destroy'])->name('post.delete');
});

Route::post('/admin/dashboard/searchResults', [DashboardController::class, 'search'])->name('dashboard.search');

Route::middleware(['auth'])->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/admin/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
Route::post('/admin/dashboard', [DashboardController::class, 'store'])->name('dashboard.store');
Route::get('/admin/dashboard/{id}/edit', [DashboardController::class, 'edit'])->name('dashboard.edit');
Route::put('/admin/dashboard/{id}', [DashboardController::class, 'update'])->name('dashboard.update');
Route::delete('/admin/dashboard/{id}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
Route::get('/admin/dashboard/{id}', [DashboardController::class, 'show'])->name('dashboard.show');
});
