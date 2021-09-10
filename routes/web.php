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
Route::get('/home/settings', 'HomeController@settings')->name('home-settings');
Route::post('/home/settings/change', 'HomeController@settings_change');

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
Route::post('/categories/create', 'CategoriesController@create');
Route::post('/categories/get_children', 'CategoriesController@get_children');
Route::post('/categories/edit', 'CategoriesController@edit');
Route::post('/categories/hide', 'CategoriesController@hide');
Route::post('/categories/show', 'CategoriesController@show');
Route::post('/categories/delete', 'CategoriesController@delete');

Route::post('/session/set', 'SessionController@set');
Route::post('/session/get', 'SessionController@get');
Route::post('/session/delete', 'SessionController@delete');
Route::post('/session/reset', 'SessionController@reset');

/*Route::get('/mail_test', function() {
    return new App\Mail\UserPassword('name','name','name');
});
*/


