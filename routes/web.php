<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::get('/admin/posts', [PostsController::class, 'index'])->name('admin.posts.index');
Route::get('/admin/posts/create', [PostsController::class, 'create'])->name('admin.posts.create');

// Routes for login system
Auth::routes(['register' => false]); // ['register' => false] inside routes() if you do not want that the users can register
