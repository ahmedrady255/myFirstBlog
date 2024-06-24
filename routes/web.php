<?php

use App\Http\Controllers\Dashboardcontroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class,'index'])->name('home.index');
Route::get('/admin/dashboard', [Dashboardcontroller::class,'index'])->name('dashboard.index');
Route::get('/allposts', [PostsController::class,'index'])->name('posts.index');
Route::get('/posts/{post}', [PostsController::class,'show'])->name('post.show');
Route::post('/admin/dashboard/searchresults',[Dashboardcontroller::class,'search'])->name('dashboard.search');
Route::get('/admin/dashboard/create', [Dashboardcontroller::class,'create'])->name('dashboard.create');
Route::post('/admin/dashboard', [Dashboardcontroller::class,'store'])->name('dashboard.store');
Route::get('/admin/dashboard/{id}/edit', [Dashboardcontroller::class,'edit'])->name('dashboard.edit');
Route::put('/admin/dashboard/{id}', [Dashboardcontroller::class,'update'])->name('dashboard.update');
Route::delete('/admin/dashboard/{id}', [Dashboardcontroller::class,'destroy'])->name('dashboard.destroy');
Route::get('/admin/dashboard/{id}', [Dashboardcontroller::class,'show'])->name('dashboard.show');






// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
