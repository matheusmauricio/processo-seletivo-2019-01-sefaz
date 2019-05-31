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

Route::get('/', function () {
    return view('home');
});

Route::get('v1/importar', 'ProdutoController@importarCSV');

Route::middleware(['verifica_parametros'])->group(function () {
    Route::get('v1/produtos', ['as' => 'buscarProduto', 'uses' => 'ProdutoController@buscarProduto']);
    
    Route::get('v1/produtos/{GTIN}', ['as' => 'buscarProduto', 'uses' => 'ProdutoController@buscarProduto']);

    Route::get('v1/produtos/{GTIN}/{latitude}/{longitude}', ['as' => 'buscarProdutoLatLng', 'uses' => 'ProdutoController@buscarProdutoLatLng']);

    Route::get('v1/produtos/{parametro1}/{parametro2}', ['as' => 'buscarProduto', 'uses' => 'ProdutoController@buscarProduto']);

    Route::get('v1/produtos/{parametro1}/{parametro2}/{parametro3}/{parametro4}', ['as' => 'buscarProduto', 'uses' => 'ProdutoController@buscarProduto'])->where('parametro4', '.*');;
});
