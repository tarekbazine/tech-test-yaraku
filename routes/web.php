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

Route::get('/', 'BookController@index');

Route::post('/books', 'BookController@store')
    ->name('books.store');

Route::post('/books/{book}/destroy', 'BookController@destroy')
    ->name('books.destroy');

Route::post('/books/{book}/update_author', 'BookController@updateAuthor')
    ->name('books.update_author');
