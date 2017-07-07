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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/timeline', 'HomeController@timeline')->name('timeline');
Route::get('/profile/{id}', 'ProfileController@index');
Route::get('/new_post', 'NewPostController@index');
Route::get('/settings', 'SettingController@index');
Route::post('/savePost', 'HomeController@savePost');
Route::get('profile', 'ProfileController@profile')->name('profile');
Route::post('edit_profile', 'ProfileController@edit')->name('edit_profile');
Route::post('search', 'ProfileController@search')->name('search');
Route::post('destroy', 'ProfileController@destroy')->name('destroy');
Route::get('saveComment', 'ProfileController@saveComment')->name('saveComment');
// Route::get('/timeline', 'LikeController@index');
// Route::get('/timeline', 'CommentController@index');
