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
    return view('welcome');
});

// CLIENTES
Route::get('Clientes', 'ClientesController@Index');
Route::get('Clientes/Listar', 'ClientesController@Listar');
Route::get('Clientes/DTE', 'ClientesController@emitir_dte');
Route::get('Clientes/DTEs', 'ClientesController@revisar_dte');
Route::post('Clientes/GuardarNuevo', 'ClientesController@GuardarNuevo');
Route::post('Clientes/Modificar', 'ClientesController@Modificar');
Route::post('Clientes/Eliminar', 'ClientesController@Eliminar');

// DTE - PAGOS
Route::post('Clientes/EmitirDTE', 'dteController@GuardarEmitido');
Route::post('Clientes/EmitirPago', 'ClientesController@GuardarNuevoPago');

// NOTA DE CREDITO
Route::get('Clientes/NC', 'dteController@cli_nc');
Route::post('Clientes/EmitirNC', 'dteController@cli_emitir');


// PROVEEDORES
Route::get('Proveedores', 'ProveedoresController@Index');
Route::get('Proveedores/Listar', 'ProveedoresController@Listar');
Route::get('Proveedores/DTE', 'ProveedoresController@emitir_dte');
Route::get('Proveedores/DTEs', 'ProveedoresController@revisar_dte');
Route::post('Proveedores/GuardarNuevo', 'ProveedoresController@GuardarNuevo');
Route::post('Proveedores/Modificar', 'ProveedoresController@Modificar');
Route::post('Proveedores/Eliminar', 'ProveedoresController@Eliminar');

// DTE - PAGOS
Route::post('Proveedores/EmitirDTE', 'dteController@GuardarRecibido');
Route::post('Proveedores/EmitirPago', 'ProveedoresController@GuardarNuevoPago');

// NOTA DE CREDITO
Route::get('Proveedores/NC', 'dteController@pro_nc');
Route::post('Proveedores/RecibirNC', 'dteController@pro_recibir');


// DETALLE PAGOS
route::post('DetalleDTERecibidas', 'dteController@DetalleDTE_R');
route::post('DetalleDTEEmitidas', 'dteController@DetalleDTE_E');

route::post('Depositar', 'dteController@Depositar');
route::post('Aprobar', 'dteController@Aprobar');
route::post('AprobarFactura', 'dteController@AprobarFactura');

// INFORMES
Route::get('Informes/PagosRealizados', 'InformesController@pagos_r');
Route::get('Informes/PagosRecibidos', 'InformesController@pagos_e');
Route::get('Informes/Pagos_Realizar_Pendientes', 'InformesController@pagos_r_pend');
Route::get('Informes/Pagos_Recibir_Pendientes', 'InformesController@pagos_e_pend');
Route::get('Informes/Clientes', 'InformesController@info_cli');
Route::post('Informes/Generar', 'InformesController@generar');

//FICHA DTE
Route::post('FichaDTE', 'dteController@FichaDTE');

