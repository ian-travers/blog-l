<?php

Route::get('/', 'BlogController@index')->name('blog.index');

Route::get('/blog/{slug}', 'BlogController@show')->name('blog.show');

Route::get('/category/{category}', 'BlogController@category')->name('category');

Route::get('author/{author}', 'BlogController@author')->name('author');

Route::get('tag/{tag}', 'BlogController@tag')->name('tag');

Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::get('edit-account', 'Backend\HomeController@edit')->name('edit-account');
Route::put('edit-account', 'Backend\HomeController@update');

Route::put('/backend/blog/restore/{blog}', 'Backend\BlogController@restore')->name('backend.blog.restore');
Route::delete('/backend/blog/force-destroy/{blog}', 'Backend\BlogController@forceDestroy')->name('backend.blog.force-destroy');
Route::resource('/backend/blog', 'Backend\BlogController', ['as' => 'backend']);

Route::resource('/backend/categories', 'Backend\CategoriesController', ['as' => 'backend']);

Route::get('/backend/users/confirm/{user}', 'Backend\UsersController@confirm')->name('backend.users.confirm');
Route::resource('/backend/users', 'Backend\UsersController', ['as' => 'backend']);
