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

/*Route::get('/mail_test', function() {
    return new App\Mail\UserPassword('name','name','name');
});
*/


