<?php

Route::post('/register', 'Auth\AuthController@register');
Route::post('/login', 'Auth\AuthController@login');
Route::get('/user', 'Auth\AuthController@user');
Route::post('/logout', 'Auth\AuthController@logout');

Route::group(['prefix' => 'topics'], function () {
    Route::post('/', 'TopicsController@store')->middleware('auth:api');
    Route::get('/', 'TopicsController@index');
    Route::get('/{topic}', 'TopicsController@show');
    Route::put('/{topic}', 'TopicsController@update');
    Route::delete('/{topic}', 'TopicsController@destroy');

    Route::group(['prefix' => '{topic}/posts'], function () {
        Route::post('/', 'PostsController@store')->middleware('auth:api');
        Route::get('/{post}', 'PostsController@show');
        Route::put('/{post}', 'PostsController@update')->middleware('auth:api');
        Route::delete('/{post}', 'PostsController@destroy')->middleware('auth:api');

        Route::group(['prefix' => '{post}/likes'], function () {
            Route::post('/', 'PostLikesController@store')->middleware('auth:api');
        });
    });
});