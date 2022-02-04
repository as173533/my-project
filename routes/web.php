<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::middleware(['web'])->group(function () {
    Route::get('', ['uses' => 'SiteController@index', 'as' => 'index']);
    Route::get('/', ['uses' => 'SiteController@index', 'as' => '/']);
    Route::get('index', ['uses' => 'SiteController@index', 'as' => 'index']);

    
//    Route::get('/blog-search','SiteController@blogsearch')->name('front.blogsearch');
//    Route::get('autocomplete', 'SiteController@autocomplete')->name('autocomplete');
});
Route::middleware(['user_not_logged_in'])->group(function () {
    
    Route::get('login', 'SiteController@get_login')->name('login');
    Route::post('login', 'SiteController@post_login')->name('login');
    
});
Route::middleware(['user_logged_in'])->group(function () {
    Route::get('/projects', 'SiteController@projects')->name('projects');
    Route::get('/project-details/{id}', 'SiteController@get_project_details')->name('project-details');
    Route::get('logout', ['uses' => 'SiteController@logout', 'as' => 'logout']);
    
});
