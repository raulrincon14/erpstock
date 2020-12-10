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

// Categoria
Route::resource('admin/categoria','registro\CategoriaController');
Route::put('categoria/desactivar','registro\CategoriaController@desactivar');
Route::put('categoria/activar','registro\CategoriaController@activar');
Route::get('categoria/selectcategoria','registro\CategoriaController@selectCategoria');

// Marca
Route::resource('admin/marca','registro\MarcaController');
Route::put('marca/desactivar','registro\MarcaController@desactivar');
Route::put('marca/activar','registro\MarcaController@activar');
Route::get('marca/selectcategoria','registro\MarcaController@selectCategoria');

// Tipo
Route::resource('admin/tipo','registro\TipoController');
Route::put('tipo/desactivar','registro\TipoController@desactivar');
Route::put('tipo/activar','registro\TipoController@activar');
Route::get('tipo/selectipo','registro\TipoController@selectTipo');

// Unidad
Route::resource('admin/unidad','registro\UnidadController');
Route::put('unidad/desactivar','registro\UnidadController@desactivar');
Route::put('unidad/activar','registro\UnidadController@activar');
Route::get('unidad/selecunidad','registro\UnidadController@selectUnidad');

// Producto
Route::resource('admin/producto','registro\ProductoController');
Route::put('producto/desactivar','registro\ProductoController@desactivar');
Route::put('producto/activar','registro\ProductoController@activar');
Route::get('producto/buscarp','registro\ProductoController@buscarp');
Route::get('producto/buscar','registro\ProductoController@buscar');
Route::post('producto/uploads', 'registro\ProductoController@uploadFile');

//Cliente
Route::resource('admin/cliente','registro\ClienteController');
Route::put('cliente/desactivar','registro\ClienteController@desactivar');
Route::put('cliente/activar','registro\ClienteController@activar');

//Proveedor
Route::resource('admin/proveedor','registro\ProveedorController');
Route::put('proveedor/desactivar','registro\ProveedorController@desactivar');
Route::put('proveedor/activar','registro\ProveedorController@activar');
Route::get('/proveedor/selectProveedor','registro\ProveedorController@selectProveedor');

//ciudades
Route::get('/admin/departamentos','registro\DepartamentoController@departamentos');
Route::get('/admin/departamentos/provincias/{number}','registro\DepartamentoController@provincias');
Route::get('/admin/departamentos/distritos/{number}','registro\DepartamentoController@distritos');

//api para buscqueda por dni o ruc
Route::get('service','registro\ServiceController@index');
Route::get('/service/ruc/{number}','registro\ServiceController@ruc');
Route::get('/service/dni/{number}','registro\ServiceController@dni');

//Compra
Route::resource('admin/compra','movimientos\CompraController');

Route::get('/{any}', 'ApplicationController')->where('any', '.*');
