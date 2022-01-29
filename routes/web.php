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

Route::get('/', [App\Http\Controllers\HomeController::class, 'home']);
Route::get('/signup', [App\Http\Controllers\AuthController::class, 'signup']);
Route::post('/signup', [App\Http\Controllers\AuthController::class, 'attemptSignup']);
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])
    ->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'attemptLogin']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
Route::get('/post/create', [App\Http\Controllers\PostsController::class, 'showCreateForm'])
    ->middleware('auth')
    ->name('post.create');
Route::post('/post/create', [App\Http\Controllers\PostsController::class, 'create'])
    ->middleware('auth');
Route::get('/post/{post}', [App\Http\Controllers\PostsController::class, 'show'])
    ->name('post.show');
Route::post('/post/{post}', [App\Http\Controllers\PostsController::class, 'addComment']);
Route::get('/post/{post}/delete', [App\Http\Controllers\PostsController::class, 'delete'])
    ->middleware('auth')
    ->name('post.delete');
Route::get('/post/{post}/bookmark', [App\Http\Controllers\PostsController::class, 'toggleBookmark'])
    ->middleware('auth')
    ->name('post.bookmark');
Route::get('/post/{post}/like', [App\Http\Controllers\PostsController::class, 'like'])
    ->middleware('auth')
    ->name('post.like');
Route::get('/post/{post}/dislike', [App\Http\Controllers\PostsController::class, 'dislike'])
    ->middleware('auth')
    ->name('post.dislike');
Route::get('/comment/{comment}/like', [App\Http\Controllers\PostsController::class, 'likeComment'])
    ->middleware('auth')
    ->name('comment.like');
Route::get('/comment/{comment}/dislike', [App\Http\Controllers\PostsController::class, 'dislikeComment'])
    ->middleware('auth')
    ->name('comment.dislike');
Route::get('/my_communities', [App\Http\Controllers\CommunitiesController::class, 'list'])
    ->middleware('auth')
    ->name('community.list');
Route::get('/my_communities/{community}/admins', [App\Http\Controllers\CommunitiesController::class, 'admins'])
    ->middleware('auth')
    ->name('community.admins');
Route::post('/my_communities/{community}/admins', [App\Http\Controllers\CommunitiesController::class, 'addAdmin'])
    ->middleware('auth');
Route::get('/my_communities/{community}/admins/{user}/delete', [App\Http\Controllers\CommunitiesController::class, 'deleteAdmin'])
    ->middleware('auth')
    ->name('community.delete-admin');
Route::get('/my_communities/create', [App\Http\Controllers\CommunitiesController::class, 'showCreateForm'])
    ->middleware('auth')
    ->name('community.create');
Route::post('/my_communities/create', [App\Http\Controllers\CommunitiesController::class, 'create'])
    ->middleware('auth');
Route::get('/my_communities/{community}/edit', [App\Http\Controllers\CommunitiesController::class, 'showEditForm'])
    ->middleware('auth')
    ->name('community.edit');
Route::post('/my_communities/{community}/edit', [App\Http\Controllers\CommunitiesController::class, 'edit'])
    ->middleware('auth');
Route::get('/community/{community}/subscribe', [App\Http\Controllers\CommunitiesController::class, 'subscribe'])
    ->middleware('auth')
    ->name('community.subscribe');
Route::get('/community/{community}/unsubscribe', [App\Http\Controllers\CommunitiesController::class, 'unsubscribe'])
    ->middleware('auth')
    ->name('community.unsubscribe');
Route::get('/community/{community}', [App\Http\Controllers\CommunitiesController::class, 'show'])
    ->name('community.show');
Route::get('/account', [App\Http\Controllers\AccountController::class, 'showEditForm'])
    ->middleware('auth')
    ->name('account');
Route::post('/account', [App\Http\Controllers\AccountController::class, 'edit'])
    ->middleware('auth');
Route::get('/bookmarks', [App\Http\Controllers\PostsController::class, 'bookmarks'])
    ->middleware('auth');
