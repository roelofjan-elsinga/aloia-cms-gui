<?php

use Illuminate\Support\Facades\Route;

Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

Route::resource('articles', 'ArticleController', ['except' => ['show', 'destroy']]);
Route::resource('pages', 'PagesController', ['except' => ['show', 'destroy']]);
Route::resource('media', 'MediaController', ['except' => ['show', 'edit', 'update']]);
Route::resource('content-blocks', 'ContentBlocksController');
Route::resource('taxonomy', 'TaxonomyController', ['except' => ['show', 'edit', 'create']]);
