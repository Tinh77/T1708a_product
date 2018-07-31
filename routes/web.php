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
use App\Category;

//Product
Route::get('/admin/product/create', 'ProductController@create');
Route::post('/admin/product/store', 'ProductController@store');
Route::get('/admin/product/edit/{id}', 'ProductController@edit');
Route::post('/admin/product/update', 'ProductController@update');
Route::get('/admin/product/list', 'ProductController@index');
Route::get('/admin/product/search', 'ProductController@search');
//// Category
Route::get('/admin/category/list', 'CategoryController@index');
Route::get('/admin/category/create', 'CategoryController@create');
Route::post('/admin/category/store', 'CategoryController@store');
Route::get('/admin/category/edit/{id}', 'CategoryController@edit');
Route::post('/admin/category/update', 'CategoryController@update');
Route::post('/admin/category/destroy/{id}', 'CategoryController@destroy');

Route::resource('admin/article', 'ArticleController');
Route::resource('admin/blog', 'BlogController');

Route::get('/demo-master', function (){
    return view('admin.layout.master');
});