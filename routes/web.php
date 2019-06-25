<?php

use Illuminate\Support\Facades\Route;

Route::get('articles/create', ['as' => 'article.create', 'uses' => 'ArticleController@create']);
Route::post('articles/create', ['as' => 'article.store', 'uses' => 'ArticleController@store']);
Route::get('articles/{slug}/edit', ['as' => 'article.edit', 'uses' => 'ArticleController@edit']);
Route::put('articles', ['as' => 'article.update', 'uses' => 'ArticleController@update']);

Route::resource('media', 'MediaController', ['except' => ['show', 'edit', 'update']]);
