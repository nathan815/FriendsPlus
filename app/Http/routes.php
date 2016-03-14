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
  
  /**
   * Home page / feed
   */
  Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
  ]);

  /**
   * Static pages (about,contact)
   */
  Route::get('/about', function() {
    return view('static.about');
  });

  Route::get('/contact', [
    'uses' => 'ContactController@index',
    'as' => 'contact'
  ]);
  
  /**
   * Users
   */
  Route::get('/users', [
    'uses' => 'UsersController@getList',
    'as' => 'user.list'
  ]);
  Route::get('/users/{username}/{tab?}', [
    'uses' => 'ProfileController@getProfile',
    'as' => 'user.profile'
  ])
  ->where(['username' => '[A-Za-z0-9_\-]+']);

});

// Accessed only by guests
Route::group(['middleware' => ['web', 'guest']], function () {

    /**
     * Authentication
     */
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
  
  /**
   * Logout
   */
  Route::get('/logout', [
    'uses' => 'AuthController@getLogout',
    'as' => 'auth.logout'
  ]);

  /**
   * Search
   */
  Route::get('/search', [
    'uses' => 'SearchController@getResults',
    'as' => 'search.results'
  ]);

  /**
   * Settings pages
   */
  Route::get('/settings', [
    'uses' => 'SettingsController@getAccount',
    'as' => 'settings.account'
  ]);
  Route::post('/settings', [
    'uses' => 'SettingsController@postAccount'
  ]);

  Route::get('/settings/profile', [
    'uses' => 'SettingsController@getProfile',
    'as' => 'settings.profile'
  ]);
  Route::post('/settings/profile', [
    'uses' => 'SettingsController@postProfile',
  ]);

  Route::get('/settings/password', [
    'uses' => 'SettingsController@getPassword',
    'as' => 'settings.password'
  ]);
  Route::post('/settings/password', [
    'uses' => 'SettingsController@postPassword'
  ]);

  Route::get('/settings/emails', [
    'uses' => 'SettingsController@getEmails',
    'as' => 'settings.emails'
  ]);
  Route::post('/settings/emails', [
    'uses' => 'SettingsController@postEmails'
  ]);

  /**
   * Add/delete friends
   */
  Route::post('/friend/add', [
    'uses' => 'FriendRequestController@postAdd',
    'as' => 'user.friend.add'
  ]);

  Route::post('/friend/delete', [
    'uses' => 'FriendRequestController@postDelete',
    'as' => 'user.friend.delete'
  ]);

  /**
   * Accept/reject/cancel requests
   */
  Route::post('/friend/request/accept', [
    'uses' => 'FriendRequestController@postAccept',
    'as' => 'user.friend.accept'
  ]);
  Route::post('/friend/request/deny', [
    'uses' => 'FriendRequestController@postDeny',
    'as' => 'user.friend.deny'
  ]);
  Route::post('/friend/request/cancel', [
    'uses' => 'FriendRequestController@postCancel',
    'as' => 'user.friend.cancel'
  ]);

  /**
   * Friend requests page
   */
  Route::get('/friend/requests/{type?}', [
    'uses' => 'FriendRequestController@getRequests',
    'as' => 'user.friend.requests'
  ]);

  /**
   * Statuses
   */
  Route::post('/status/new', [
    'uses' => 'StatusController@postNew',
    'as' => 'status.new'
  ]);
  Route::get('/status/{id}', [
    'uses' => 'StatusController@getView',
    'as' => 'status.view'
  ]);
  Route::post('/status/like', [
    'uses' => 'StatusController@postLike',
    'as' => 'status.like'
  ]);

  /**
   * Comments
   */
  Route::post('/status/{id}/comments/new', [
    'uses' => 'CommentsController@postNew',
    'as' => 'comment.new'
  ]);

});
