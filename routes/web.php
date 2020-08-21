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
    return view('welcome');
});

Auth::routes();

Route::get('/profile', 'ProfileController@index')->name('profile.index');
Route::get('/profile/{username}', 'ProfileController@show')->name('profile.show');
Route::get('/p', 'PostsController@create')->name('post.create');
Route::get('/p/{post_id}', 'PostsController@show')->name('post.show');

