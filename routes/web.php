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

Route::get('chat', 'ChatController@index');
Route::get('ajax/chat', 'Ajax\ChatController@index'); // チャットのTL取得
Route::post('ajax/chat', 'Ajax\ChatController@create'); // チャットの投稿

//LineライクUIおためし
Route::get('line', 'LineController@index');

Auth::routes();


Route::get('/{any}', function () {
    return view('lobby');
})->where('any', '.*');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('chat', 'ChatController@index');
// Route::get('ajax/chat', 'Ajax\ChatController@index'); // ���b�Z�[�W�ꗗ���擾
// Route::post('ajax/chat', 'Ajax\ChatController@create'); // �`���b�g�o�^
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

//Route::get('lobby', 'LobbyController@index');