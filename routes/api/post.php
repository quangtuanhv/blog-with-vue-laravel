<?php
use Illuminate\Support\Facades\Route;

    Route::get('latest', 'PostController@getLatest')->name('post.lasest');
    Route::get('slide', 'PostController@getSlide')->name('post.slide');
    Route::get('popular','PostController@getPopular')->name('post.popular');
    Route::get('users/{id}', function ($id) {
        return $id;
    });