<?php
use Illuminate\Support\Facades\Route;

    Route::get('latest', 'PostController@getLatest')->name('post.lasest');
    Route::get('slide', 'PostController@getSlide')->name('post.slide');
    Route::get('popular','PostController@getPopular')->name('post.popular');
    Route::resource('single', 'PostController')->except([
        'index','create','edit'
    ]);
    
    
    
    Route::get('{id}', function ($id) {
        return $id;
    });