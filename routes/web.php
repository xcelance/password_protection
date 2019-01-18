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

Route::get('/test', function () {
    return view('auth.test');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/reset-password', 'AdminController@getReset');
Route::post('/new-password', 'AdminController@resetPassword');

Route::middleware(['admin'])->group(function() {
	// test routes
	Route::get('/admin', function () {
	    return view('admin.test');
	});

	Route::get('/dashboard', 'AdminController@index');

	Route::get('/notification', 'AdminController@notification');
	Route::get('/getnotification', 'AdminController@getnotification');

	Route::get('/generate-password', 'AdminController@createPassword');
	Route::post('/generate-password', 'AdminController@generatePassword');

	Route::get('/view-admin', 'AdminController@adminEdit');
	Route::post('/edit-admin/{id}', 'AdminController@updateAdmin');

	Route::get('/active-user/{id}', 'AdminController@activate');

	Route::post('/reset-password', 'AdminController@resetPassword');

	Route::get('/users', 'AdminController@users');
	Route::get('/delete-user/{id}', 'AdminController@deleteUser');

	Route::get('/edit-user/{id}', 'AdminController@editUser');
	Route::post('/edit-user/{id}', 'AdminController@updateUser');

	Route::get('/create-user', 'AdminController@addUser');
	Route::post('/create-user', 'AdminController@createUser');

	Route::get('/urls', 'AdminController@getUrls');
	Route::post('/add-url', 'AdminController@addUrl');
	Route::get('/delete-url/{id}', 'AdminController@deleteUrl');
});
