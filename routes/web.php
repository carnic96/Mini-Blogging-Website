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
Route::post('otherprofile', 'ProfileController@follow')->name('otherprofile');
Route::get('edit_profile', 'ProfileController@edit')->name('edit_profile');
Route::post('edit_profile', 'ProfileController@edit')->name('edit_profile');
Route::post('search', 'ProfileController@search')->name('search');
Route::post('destroy', 'ProfileController@destroy')->name('destroy');
Route::get('saveComment', 'ProfileController@saveComment')->name('saveComment');
Route::get('/like/{id}', 'LikeController@index');
Route::get('/unlike/{id}', 'LikeController@unlike');
Route::get('/follow/{user_id}', 'ProfileController@follow')->name('follow');;
Route::get('/unfollow/{user_id}', 'ProfileController@unfollow')->name('unfollow');;
// Route::get('/timeline', 'CommentController@index');
