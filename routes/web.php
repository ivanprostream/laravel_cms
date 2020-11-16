<?php

use Illuminate\Support\Facades\Route;

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

/** Site routes **/

Route::get('/', 'App\Http\Controllers\SiteController@index')->name('home');

Route::get('/{slug}/{slug_2}/{slug_3}/{slug_4}/{slug_5}', 'App\Http\Controllers\SiteController@page');
Route::get('/{slug}/{slug_2}/{slug_3}/{slug_4}', 'App\Http\Controllers\SiteController@page');
Route::get('/{slug}/{slug_2}/{slug_3}', 'App\Http\Controllers\SiteController@page');
Route::get('/{slug}/{slug_2}', 'App\Http\Controllers\SiteController@page');
Route::get('/{slug}', 'App\Http\Controllers\SiteController@page');

/** Admin routes **/

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {

	Route::resource('/', 'App\Http\Controllers\HomeController');

	Route::resource('settings', 'App\Http\Controllers\SettingsController');

	Route::resource('/pages', 'App\Http\Controllers\PageController');
	Route::get('/structure', 'App\Http\Controllers\PageController@index');
	Route::post('/pages/sort', 'App\Http\Controllers\PageController@sort');

	Route::get('/pages/gallery/{id}', 'App\Http\Controllers\PageController@gallery');
	Route::patch('/pages/gallery_create/{id}', 'App\Http\Controllers\PageController@gallery_create');
	Route::delete('/pages/gallery_delete/{id}', 'App\Http\Controllers\PageController@gallery_delete');
	Route::post('/pages/sort_gallery', 'App\Http\Controllers\PageController@sort_gallery');

	Route::resource('/slider', 'App\Http\Controllers\SliderController');
	Route::get('/slider/sliders/{id}', 'App\Http\Controllers\SliderController@sliders');
	Route::patch('/slider/slide_create/{id}', 'App\Http\Controllers\SliderController@slide_create');
	Route::delete('/slider/slide_delete/{id}', 'App\Http\Controllers\SliderController@slide_delete');
	Route::post('/slider/sort', 'App\Http\Controllers\SliderController@sort');

	Route::resource('/infography', 'App\Http\Controllers\InfographyController');
	Route::get('/infography/infographes/{id}', 'App\Http\Controllers\InfographyController@infographes');
	Route::patch('/infography/infography_create/{id}', 'App\Http\Controllers\InfographyController@infography_create');
	Route::delete('/infography/infography_delete/{id}', 'App\Http\Controllers\InfographyController@infography_delete');
	Route::post('/infography/sort', 'App\Http\Controllers\InfographyController@sort');

	Route::resource('/tiser', 'App\Http\Controllers\TiserController');
	Route::get('/tiser/tisers/{id}', 'App\Http\Controllers\TiserController@tisers');
	Route::patch('/tiser/tiser_create/{id}', 'App\Http\Controllers\TiserController@tiser_create');
	Route::delete('/tiser/tiser_delete/{id}', 'App\Http\Controllers\TiserController@tiser_delete');
	Route::post('/tiser/sort', 'App\Http\Controllers\TiserController@sort');

	Route::resource('/cta', 'App\Http\Controllers\CtaController');

	Route::resource('/banner', 'App\Http\Controllers\BannerController');

	Route::resource('/review', 'App\Http\Controllers\ReviewController');

});

Auth::routes();

