<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/notes', function () {
    return view('notes');
});
Route::get('/create', function () {
    return view('create');
});

Route::post('/checkEmail', function () {
    return view('checkEmail');
});
Route::post('/register', function () {
    return view('register');
});
Route::post('/enter', function () {
    return view('enter');
});
Route::post('/createNote', function () {
    return view('createNote');
});
Route::post('/editNote', function () {
    return view('editNote');
});
Route::post('/deleteNote', function () {
    return view('deleteNote');
});

