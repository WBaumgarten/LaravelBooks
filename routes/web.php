<?php

//Navigation Routes
Route::get('/', 'PagesController@index');
Route::get('/books/export', 'PagesController@export');
Route::get('books/list/{orderType}', ['uses' => 'BooksController@index']);
Route::get('books/csv/{dataType}', ['uses' => 'BooksController@exportCSV']);
Route::get('books/xml/{dataType}', ['uses' => 'BooksController@exportXML']);
Route::get('pages/dashboard/{orderType}',['uses' => 'PagesController@dashboard']);
Route::post('/search', 'BooksController@search');
Route::resource('books', 'BooksController');

//Auth Routes
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
