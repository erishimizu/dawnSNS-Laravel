<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');


//ログイン中のページ
Route::get('/top','PostsController@index');
Route::get('/top','PostsController@index')->middleware('auth');
Route::post('/create','PostsController@create')->middleware('auth');
Route::get('/postDelete/{post_id}','PostsController@postDelete');

Route::get('/profile','UsersController@profile')->middleware('auth');

Route::get('/search','UsersController@index');
Route::get('/search','UsersController@search')->middleware('auth');
Route::get('/searchList','UsersController@searchList')->middleware('auth');
Route::post('/searchList','UsersController@searchList')->middleware('auth');

Route::get('/follow-list','PostsController@index');
Route::get('/follower-list','PostsController@index');
Route::get('/user{id}','UsersController@usersProfile')->middleware('auth');
Route::get('/follow{id}','UsersController@userProfileFollow')->middleware('auth');
Route::get('/unfollow{id}','UsersController@userProfileUnfollow')->middleware('auth');

Route::get('/logout', 'Auth\LoginController@logout')->middleware('auth');
