<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'fileGuest'], function() {

    Route::get('login', ['as' => 'authenticate.loginPage', 'uses' => 'AuthenticationController@loginPage']);
    Route::post('login', ['as' => 'authenticate.login', 'uses' => 'AuthenticationController@login']);

});

Route::group(['middleware' => 'fileAuth'], function() {

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    Route::post('logout', ['as' => 'authenticate.logout', 'uses' => 'AuthenticationController@logout']);

    Route::resource('articles', 'ArticleController', ['except' => ['show', 'destroy']]);
    Route::resource('pages', 'PagesController', ['except' => ['show', 'destroy']]);
    Route::resource('media', 'MediaController', ['except' => ['show', 'edit', 'update']]);
    Route::resource('content-blocks', 'ContentBlocksController');
    Route::resource('taxonomy', 'TaxonomyController', ['except' => ['show', 'edit', 'create']]);

});
