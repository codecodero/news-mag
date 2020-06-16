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
// Route::get('/', function () {
//     return view('plantilla');
// });

// Route::view('/', 'paginas.inicio');
// Route::view('/blog', 'paginas.blog');
// Route::view('/admin', 'paginas.admin');
// Route::view('/categorias', 'paginas.categorias');
// Route::view('/articulos', 'paginas.articulos');
// Route::view('/comentarios', 'paginas.comentarios');
// Route::view('/banner', 'paginas.banner');
// Route::view('/ads', 'paginas.ads');

// Route::get('/admin', 'AdminController@TraerAdmins');
// Route::get('/ads', 'AdsController@TraerAds');
// Route::get('/articulos', 'ArticulosController@TraerArticulos');
// Route::get('/banner', 'BannerController@TraerBanner');
// Route::get('/blog', 'BlogController@TraerBlog');
// Route::get('/categorias', 'CategoriasController@TraerCategorias');
// Route::get('/comentarios', 'ComentariosController@TraerComentarios');

Route::view('/', 'paginas.inicio');
Route::resource('/admin', 'AdminController');
Route::resource('/ads', 'AdsController');
Route::resource('/articulos', 'ArticulosController');
Route::resource('/banner', 'BannerController');
Route::resource('/blog', 'BlogController');
Route::resource('/categorias', 'CategoriasController');
Route::resource('/comentarios', 'ComentariosController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
