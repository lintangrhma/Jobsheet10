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
use Illuminate\Http\Request;
Route::get ('/home', 'homeController@home');
Route::get ('/about', 'aboutController@about');
Route::get ('/article/{page}', 'articleController@article');
Route::get ('/kuis1/{page}', 'kuis1Controller@kuis1');
Route::get('/manage', 'ArticleController@index')->name('manage');

Route::get('/', function () {
    return view('home');
});
Route::get('/home', 'homeController@index');
Route::get('/article/add','ArticleController@add'); 
Route::post('/article/create','ArticleController@create'); 
Route::get('/article/edit/{id}','ArticleController@edit'); 
Route::post('/article/update/{id}','ArticleController@update'); 
Route::get('/article/delete/{id}','ArticleController@delete');

Gate::define('manage-articles', function($user){      
     return $user->roles == "Administrator"; }); 
Gate::define('user-display', function($user){       return $user->roles == "User"; 
     }); 
     