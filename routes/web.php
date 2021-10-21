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
    Route::post('/settings/get', 'HomeController@settings_get');
});

Route::prefix('users')->group(function () {
    Route::get('/', 'UsersController@index')->name('users');
    Route::post('/create', 'UsersController@create');
    Route::post('/blocked', 'UsersController@blocked');
    Route::post('/edit', 'UsersController@edit');
    Route::post('/delete', 'UsersController@delete');
});


Route::get('/permissions', 'PermissionsController@index')->name('permissions');


Route::prefix('tags')->group(function () {
    Route::get('/', 'TagsController@index')->name('tags');
    Route::post('/create', 'TagsController@create');
    Route::post('/edit', 'TagsController@edit');
    Route::post('/delete', 'TagsController@delete');
});

Route::prefix('statuses')->group(function () {
    Route::get('/', 'StatusesController@index')->name('statuses');
    Route::post('/create', 'StatusesController@create');
    Route::post('/edit', 'StatusesController@edit');
    Route::post('/delete', 'StatusesController@delete');
});

Route::prefix('role')->group(function () {
    Route::get('/', 'RolesController@index')->name('role');
    Route::get('/create', 'RolesController@show_create')->name('create-role');
    Route::post('/create', 'RolesController@create');
    Route::get('/edit/{id?}', 'RolesController@show_edit')->name('edit-role');
    Route::post('/edit', 'RolesController@edit');
    Route::post('/delete', 'RolesController@delete');
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
    Route::get('/{id?}', 'DocumentsController@index');
    Route::post('/select', 'DocumentsController@select');
    Route::post('/create', 'DocumentsController@create');
    Route::post('/edit', 'DocumentsController@edit');
    Route::post('/active', 'DocumentsController@active');
    Route::post('/complete', 'DocumentsController@complete');
    Route::post('/responsible', 'DocumentsController@responsible_edit');
    Route::post('/delete', 'DocumentsController@delete');
});

Route::prefix('session')->group(function () {
    Route::post('/set', 'SessionController@set');
    Route::post('/get', 'SessionController@get');
    Route::post('/delete', 'SessionController@delete');
    Route::post('/reset', 'SessionController@reset');
});

Route::prefix('files')->group(function () {
   Route::get('/download/{file_id}', 'FilesController@download_preview');
   Route::get('/preview/{file_id}', 'FilesController@preview');
   Route::post('/create', 'FilesController@create');
   Route::post('/edit', 'FilesController@edit');
   Route::post('/delete', 'FilesController@delete');
});

Route::prefix('journal')->group(function () {
   Route::get('/', 'JournalController@index')->name('journal');
});

Route::prefix('logs')->group(function () {
   Route::get('/', 'LogsController@index')->name('logs');
});

/*Route::get('/test', function() {
    $a = 'documents/CtseGNeAERLhbOUPVNuif0TYaoVGIhttVtiC83l4.png';
    dispatch(new ProcessDeleteFiles($a));
});*/

/*Route::get('/mail_test', function() {
    return new App\Mail\UserPassword('name','name','name');
});
*/
