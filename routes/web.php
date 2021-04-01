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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();
Route::get('/get_user', 'HomeController@get_user')->name('get_user');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'ForumController@index2')->name('home');

Route::post('/pertanyaan', 'ForumController@store')->name('pertanyaan.post');
Route::post('/jawaban', 'HomeController@jawabanStore')->name('jawaban.post');

Route::get('/settings', 'HomeController@settings')->name('settings');
Route::get('/about', 'HomeController@about')->name('about');

Route::get('/logout', 'HomeController@logout')->name('logout');
Route::post('/ganti_password', 'HomeController@gantiPassword')->name('ganti_password');