<?php

use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostThumbnailController;
use App\Http\Controllers\Admin\ShowDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleRequestController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
// use Illuminate\Http\Request;

Route::get('dashboard', ShowDashboard::class)->name('dashboard');
Route::resource('posts', PostController::class);
Route::delete('/posts/{post}/thumbnail', [PostThumbnailController::class, 'destroy'])->name('posts_thumbnail.destroy');
Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
Route::resource('comments', CommentController::class)->only(['index', 'edit', 'update', 'destroy']);
Route::resource('media', MediaLibraryController::class)->only(['index', 'show', 'create', 'store', 'destroy']);
Route::match(['put', 'patch'], '/role/request/{roleRequest}', [RoleRequestController::class, 'update'])->name('role_request.update');
Route::resource('categories', CategoryController::class);

// Route::get('/get-session-info', function (Request $request) {
//     $data = $request->session()->all();
    
//     return $data;
// });