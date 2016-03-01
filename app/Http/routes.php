<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

// Accessed by anyone
Route::group(['middleware' => ['web']], function () {
  
  Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
  ]);
  
  Route::get('/user/{username}', [
    'uses' => 'ProfileController@index',
    'as' => 'profile'
  ])
  ->where(['username' => '[A-Za-z0-9_\-]+']);

  Route::get('/about', function() {
    return view('static.about');
  });

  Route::get('/contact', [
    'uses' => 'ContactController@index',
    'as' => 'contact'
  ]);

});

// Accessed only by guests
Route::group(['middleware' => ['web', 'guest']], function () {

    Route::get('/sign-up', [
      'uses' => 'AuthController@getSignup',
      'as' => 'auth.signup'
    ]);
    Route::post('/sign-up', [
      'uses' => 'AuthController@postSignup'
    ]);

    Route::get('/login', [
      'uses' => 'AuthController@getLogin',
      'as' => 'auth.login'
    ]);
    Route::post('/login', [
      'uses' => 'AuthController@postLogin'
    ]);

});

// Accessed only by signed in users
Route::group(['middleware' => ['web', 'auth']], function () {
  
  Route::get('/logout', [
    'uses' => 'AuthController@getLogout',
    'as' => 'auth.logout'
  ]);

});