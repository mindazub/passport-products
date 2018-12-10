<?php

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('product/generate-data', 'ProductController@generateDataForm')
        ->name('product.generate_data');

    Route::post('product/generate-data', 'ProductController@generateData');

    Route::resource('product', 'ProductController')->except(['show']);
    Route::resource('role', 'RoleController')->except(['show']);
    Route::resource('user', 'UserController')->except(['show']);
});
