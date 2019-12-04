<?php

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

Route::get('/', 'MainController@index')->name('index');

Auth::routes();

// Profile
Route::get('/home', 'HomeController@set_profile')->name('home');
Route::post('/set-profile', 'HomeController@profile')->name('set-profile');
Route::get('/profile/{User}', 'MainController@getProfile')->name('get-profile');
Route::get('/profile/{User}/edit', 'HomeController@editProfile')->name('profile.edit');
Route::post('/profile/{User}/update', 'HomeController@updateProfile')->name('profile.update');

// Posts
Route::resource('post', 'PostController');
Route::get('post/{Post}/single', 'MainController@showPost')->name('post.single');

// Comment
Route::resource('comment', 'CommentController');