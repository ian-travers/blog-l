<?php

Route::get('/', 'BlogController@index')->name('blog.index');

Route::get('/blog/{slug}', 'BlogController@show')->name('blog.show');

Route::get('/category/{category}', 'BlogController@category')->name('category');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
