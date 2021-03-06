<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','IndexController@index');
Route::post('/index/getlist','IndexController@getIndexList');
// 认证路由...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// 注册路由...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['middleware' => 'auth'], function () {
    Route::get('card/add','CardController@addCard');
    Route::post('card/add','CardController@saveCard');
    Route::get('card/list','CardController@cardList');
    Route::get('card/delete/{id}','CardController@cardDel');

    Route::get('msg/add','MemberController@addMsg');
    Route::post('msg/add','MemberController@saveMsg');
    Route::get('msg/list','MemberController@msgList');
    Route::get('msg/detail/{from_user_id}','MemberController@msgDetail');
    Route::post('msg/getlist','MemberController@getMsgList');
    Route::post('msg/getdetaillist','MemberController@getMsgDetailList');
});
Route::post('card/like','CardController@likeCard');
Route::get('about','IndexController@about');
