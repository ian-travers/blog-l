<?php

Route::get('/', 'BlogController@index')->name('blog.index');

Route::get('/blog/{post}', 'BlogController@show')->name('blog.show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
