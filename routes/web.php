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

//Clear Cache facade value:
Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return '<h1>Cleared</h1>';
});

Route::get('/', 'UserController@index');

Route::post('/mylogin', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::get('/sendMail/{email}', 'UserController@sendMail');

Route::get('/test', 'UserController@test');
Route::get('/view-newmail/{id}', 'UserController@viewMailHtml');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/password/reset/expired', 'UserController@expiredToken');

Route::get('/password/reset', 'UserController@getReset');
Route::post('password/reset', 'UserController@sendResetLinkEmail');

Route::get('password/reset/{token}', 'UserController@checkForUrl');
Route::post('/password/update/{token}', 'UserController@createNewPassword');

Route::middleware(['admin'])->group(function() {

	Route::get('/dashboard', 'AdminController@index');

	Route::get('/edit-error', 'AdminController@viewError');
	Route::post('/edit-errors', 'AdminController@editError');

	Route::get('/notification', 'AdminController@notification');
	Route::get('/getnotification', 'AdminController@getnotification');

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
