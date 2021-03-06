<?php

use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\PhotosController;
use App\Http\Controllers\PostsController as BlogPostsController;

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

Route::get('/', [PagesController::class, 'home'])->name('pages.home');
Route::get('about', [PagesController::class, 'about'])->name('pages.about');
Route::get('archive', [PagesController::class, 'archive'])->name('pages.archive');
Route::get('contact', [PagesController::class, 'contact'])->name('pages.contact');

Route::get('/blog/{post}', [BlogPostsController::class, 'show'])->name('posts.show');
Route::get('/categorias/{category}', [CategoriesController::class, 'show'])->name('categories.show');
Route::get('/etiquetas/{tag}', [TagsController::class, 'show'])->name('tags.show');

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => 'auth'],
function (){
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('posts', [PostsController::class, 'index'])->name('admin.posts.index');
    Route::get('posts/create', [PostsController::class, 'create'])->name('admin.posts.create');
    Route::post('posts', [PostsController::class, 'store'])->name('admin.posts.store');
    Route::delete('posts/{post}', [PostsController::class, 'destroy'])->name('admin.posts.destroy');
    Route::get('posts/{post}', [PostsController::class, 'edit'])->name('admin.posts.edit');
    Route::put('posts/{post}', [PostsController::class, 'update'])->name('admin.posts.update');

    Route::post('posts/{post}/photos', [PhotosController::class, 'store'])->name('admin.posts.photos.store');
    Route::delete('photos/{photo}', [PhotosController::class, 'destroy'])->name('admin.photos.destroy');
}
);

// Routes for login system
Auth::routes(['register' => false]); // ['register' => false] inside routes() if you do not want that the users can register
