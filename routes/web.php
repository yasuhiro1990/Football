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
// 検索画面ルート
// Route::get('/search','Admin\AcountController@search1');
Route::get('/search','Admin\AcountController@search');
// ホーム画面ルート
Route::get('/first','Admin\AcountController@home');

// 検索結果
Route::get('/yourpage','Admin\AcountController@yourpage');
Route::post('/yourpage','Admin\FavoriteController@postHoge')->middleware('auth');
// ログイン
Route::group(['prefix'=>'admin'],function(){
    Route::get('acount','Admin\AcountController@add');
    Route::post('acount','Admin\AcountController@create');
    Route::get('mypage','Admin\AcountController@index')->middleware('auth');
    Route::get('edit','Admin\AcountController@edit')->middleware('auth');
    Route::post('edit','Admin\AcountController@update')->middleware('auth');
    
});
