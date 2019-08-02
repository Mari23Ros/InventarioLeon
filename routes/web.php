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
Route::get('/nuevo', 'ProductController@newproduct');
Route:: post('/nuevo','ProductController@createProduct')->name('product.new');
Route::get('/producto', 'ProductController@searchProduct')->name('products.search');
Route::get('/producto/getWarehouseUsers', 'ProductController@getWarehouseUsers')->name('products.getWarehouseUsers');
Route::get('/producto/getWarehouseOnly', 'ProductController@getWarehouseOnly')->name('products.getWarehouseOnly');
Route::get('/warehouses', 'ProductController@getWarehousesForBuyer')->name('products.getWarehousesForBuyer');


Route::resource('/movimiento', 'MovementController');
Route::get('/movimiento/rellenar', 'MovementController@rellenar')->name('movimiento.rellenar');

Route::get('/getProductWarehouse', 'ReportController@getProductWarehouse')->name('report.getProductWarehouse');
Route::get('generateHistoricalPDF', 'ReportController@generateHistoricalPDF')->name('report.generateHistoricalPDF');
//Route::get('/consulta','ProductController@generalQuery')->name('generalQuery');
Route::get('/consulta','ProductController@consultaGeneral')->name('generalQuery');
Route::get('/consulta/general','ReportController@query');

Route::get('querypdf', 'ReportController@querypdf');
Route::get('/getWarehouseId', 'ReportController@getWarehouseId');
//Route::get('/getProductWarehouse', 'ReportController@getProductWarehouse');

Route::get('/reporte/historico', 'ReportController@historico')->name('report.historico');
Route::post('/reporte/historico', 'ReportController@store')->name('report.store');

Route::get('/pruebaconsultape', 'ProductController@inicio');
