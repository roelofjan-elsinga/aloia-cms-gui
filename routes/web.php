<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

Route::resource('articles', 'ArticleController', ['except' => ['show']]);
Route::resource('pages', 'PagesController', ['except' => ['show']]);
Route::resource('content-blocks', 'ContentBlocksController');
Route::resource('files', 'FileManagerController', ['except' => ['show', 'edit', 'update']]);
