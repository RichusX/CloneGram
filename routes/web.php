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

Auth::routes();

Route::get('/profile', ['middleware'=>'auth', 'uses'=>'ProfileController@index'])->name('profile.index');
Route::get('/profile/{username}', 'ProfileController@show')->name('profile.show');
Route::get('/profile/{username}/edit', ['middleware'=>'auth', 'uses'=>'ProfileController@edit'])->name('profile.edit');
Route::patch('/profile/{username}', ['middleware'=>'auth', 'uses'=>'ProfileController@update'])->name('profile.update');

Route::get('/', ['middleware'=>'auth', 'uses'=>'PostsController@index'])->name('index');
Route::get('/post/create', ['middleware'=>'auth', 'uses'=>'PostsController@create'])->name('post.create');
Route::post('/post', ['middleware'=>'auth', 'uses'=>'PostsController@store'])->name('post.store');
Route::get('/post/{post}', 'PostsController@show')->name('post.show');
Route::delete('/post/{post}', ['middleware'=>'auth', 'uses'=>'PostsController@destroy'])->middleware('can:delete,post')->name('post.destroy');
Route::get('/post/{post}/edit', ['middleware'=>'auth', 'uses'=>'PostsController@edit'])->middleware('can:update,post')->name('post.edit');
Route::patch('/post/{post}', ['middleware'=>'auth', 'uses'=>'PostsController@update'])->middleware('can:update,post')->name('post.update');

Route::post('/follow/{user}', ['middleware'=>'auth', 'uses'=>'FollowController@store'])->name('follow.store');
Route::post('/like/{post}', ['middleware'=>'auth', 'uses'=>'LikeController@store'])->name('like.store');
