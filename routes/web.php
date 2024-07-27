<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;



use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
Route::get('/', function(){
   $posts= Post::where('user_id', auth()->id())->get();
    return view('allusers', ['posts' =>$posts]);
});
Route::get('/allusers', [HomeController::class, 'index'])->name('allusers');
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/createUser', [UserController::class,'createUser']);

Route::get('/', [HomeController::class, 'index'])->middleware('auth');
// Create post
Route::post('/createPost', [PostController::class, 'createPost'])->name('createPost');
Route::get('/editPost/{post}', [PostController::class, 'editPost'])->name('posts.edit');

// Route to handle the update request
Route::put('/editPost/{post}', [PostController::class, 'updatePost'])->name('posts.update');
Route::delete('/delete-post/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
