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

Route::get('/metronic', function () {
    return view('admins.admin');
});

Route::get('/users', function () {
    return view('users.user');
});

Route::get('/managers', function () {
    return view('users.manager');
});

Route::get('/advisers', function () {
    return view('users.adviser');
});

//User
//Route::resource('users', 'User\UserController', ['except' => ['create', 'edit'] ]);


