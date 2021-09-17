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



Route::prefix('home')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/settings', 'HomeController@settings')->name('home-settings');
    Route::post('/settings/change', 'HomeController@settings_change');
});

Route::prefix('users')->group(function () {
    Route::get('/', 'UsersController@index')->name('users');
    Route::post('/create', 'UsersController@create');
    Route::post('/blocked', 'UsersController@blocked');
    Route::post('/edit', 'UsersController@edit');
    Route::post('/delete', 'UsersController@delete');
});


Route::get('/permissions', 'PermissionsController@index')->name('permissions');

Route::prefix('role')->group(function () {
    Route::get('/', 'RolesController@index')->name('role');
    Route::get('/create', 'RolesController@show_create')->name('create-role');
    Route::post('/create', 'RolesController@create');
    Route::get('/edit/{id?}', 'RolesController@show_edit')->name('edit-role');
    Route::post('/edit', 'RolesController@edit');
    Route::post('/role/delete', 'RolesController@delete');
});

Route::prefix('categories')->group(function () {
    Route::get('/{id?}', 'CategoriesController@index')->name('categories');
    Route::post('/create', 'CategoriesController@create');
    Route::post('/get_children', 'CategoriesController@get_children');
    Route::post('/edit', 'CategoriesController@edit');
    Route::post('/hide', 'CategoriesController@hide');
    Route::post('/show', 'CategoriesController@show');
    Route::post('/delete', 'CategoriesController@delete');
});

Route::prefix('documents')->group(function () {
    Route::post('/select', 'DocumentsController@select');
});

Route::prefix('session')->group(function () {
    Route::post('/set', 'SessionController@set');
    Route::post('/get', 'SessionController@get');
    Route::post('/delete', 'SessionController@delete');
    Route::post('/reset', 'SessionController@reset');
});

Route::prefix('documents')->group(function () {
    Route::get('/{id?}', 'DocumentsController@index');
});



/*Route::get('/mail_test', function() {
    return new App\Mail\UserPassword('name','name','name');
});
*/


