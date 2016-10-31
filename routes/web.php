<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
  Route::get('/home', 'HomeController@index');
  Route::get('admin/users/', 'Admin\UsersController@index');
  Route::get('/admin/home', 'Admin\HomeController@index');
  Route::resource('/user-details-access-requests', 'UserDetailsAccessRequestsController');
  Route::resource('/admin/user-details', 'Admin\UserDetailsController');
  Route::resource('/admin/banks', 'Admin\BanksController');
  Route::resource('/admin/bank-api-users', 'Admin\BankAPIUsersController');
  Route::resource('/admin/bank-users', 'Admin\BankUsersController');
  Route::post('/api/users/getUsers', 'API\UsersController@getUsers');
  Route::post('/api/details/action', 'API\DetailsController@action');
  Route::post('/api/details/getDetails', 'API\DetailsController@getDetails');
});

Route::get('/home', 'HomeController@index');
Route::get('/banks', 'BanksController@index');
Route::resource('users', 'UsersController');
