<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $posts = \App\Models\Post::all();
    return view('welcome', compact('posts'));
})->name('home')->middleware('auth');

Route::get('/home', function (){
    return view('admin.dashboard');
})->middleware('auth');

Auth::routes(['register' => false]); // ['register' => false] inside routes() if you do not want that the users can register

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
