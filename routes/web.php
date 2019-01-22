<?php

Route::get('/', 'BlogController@index');

Route::get('/blog/show', function () {
    return view('blog.show');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
