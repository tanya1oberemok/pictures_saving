<?php

use App\Http\Controllers\PostController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/my-posts', [PostController::class, 'index'])->name('my-posts');

Route::get('/create-post', [PostController::class, 'create'])->name('create-post');
Route::post('/create-post', [PostController::class, 'store'])->name('create-post');

Route::get('/show-post/{post}', [PostController::class, 'show'])->name('show-post');
Route::put('/edit-post/{post}', [PostController::class, 'edit'])->name('edit-post');

Route::delete('/delete-post/{post}', [PostController::class, 'destroy'])->name('delete-post');
