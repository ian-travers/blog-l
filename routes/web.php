<?php

Route::get('/', 'BlogController@index')->name('blog.index');

Route::get('/blog/{slug}', 'BlogController@show')->name('blog.show');

Route::get('/category/{category}', 'BlogController@category')->name('category');

Route::get('author/{author}', 'BlogController@author')->name('author');

Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');

Route::resource('/backend/blog', 'Backend\BlogController', ['as' => 'backend']);
