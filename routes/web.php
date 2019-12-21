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
Route::get('download/{id}', 'IndexController@download');
Route::post('/subscribe', 'IndexController@subscribe');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    Route::get('ssgrouplogin/{value}', 'AdminController@displayvalue');
    Route::get('ssgrouplogin', 'AdminController@index')->name('Admin.index');
    Route::resource('ssgrouplogin/wallpaper/add', 'WallpapersController');
    Route::get('ssgrouplogin/wallpaper/{id}', 'WallpapersController@destroy');
    Route::resource('ssgrouplogin/category/add', 'CategoriesController');
    Route::resource('ssgrouplogin/subcategory/add', 'SubcategoriesController');
});
