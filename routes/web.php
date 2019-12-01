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

Route::get('/', 'IndexController@index');
Route::get('wallpapers/{value}', 'IndexController@tabvalues');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    Route::get('ssgrouplogin/{value}', 'AdminController@displayvalue');
    Route::get('ssgrouplogin', 'AdminController@index');
    Route::resource('ssgrouplogin/wallpaper/add', 'WallpapersController');
    Route::resource('ssgrouplogin/category/add', 'CategoriesController');
    Route::resource('ssgrouplogin/subcategory/add', 'SubcategoriesController');
});
