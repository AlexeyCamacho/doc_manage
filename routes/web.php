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

Route::get('/', function () {
    return view('main');
});

Auth::routes(['register' => false, 'verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UsersController@index')->name('users');
Route::post('/users/create', 'UsersController@create');
Route::post('/users/blocked', 'UsersController@blocked');
Route::post('/users/edit', 'UsersController@edit');
Route::post('/users/delete', 'UsersController@delete');

Route::get('/permissions', 'PermissionsController@index')->name('permissions');

Route::get('/role', 'RolesController@index')->name('role');
Route::get('/role/create', 'RolesController@show_create')->name('create-role');
Route::post('/role/create', 'RolesController@create');
Route::get('/role/edit/{id?}', 'RolesController@show_edit')->name('edit-role');
Route::post('/role/edit', 'RolesController@edit');
Route::post('/role/delete', 'RolesController@delete');

Route::get('/categories/{id?}', 'CategoriesController@index')->name('categories');

/*Route::get('/mail_test', function() {
    return new App\Mail\UserPassword('name','name','name');
});
*/


