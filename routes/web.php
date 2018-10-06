<?php



Route::get('/', 'DemoController@nasabah')->name('nasabah');
Route::post('nasabah', 'DemoController@tambah_nasabah')->name('tambah_nasabah');
Route::patch('tabungan/{id}/tambah', 'DemoController@tambah_tabungan')->name('tambah_tabungan');
Route::patch('tabungan/{id}/kurang', 'DemoController@kurang_tabungan')->name('kurang_tabungan');
Route::get('update/{id}', 'DemoController@update')->name('update');
Route::get('bonus/{id}', 'DemoController@bonus')->name('bonus');
//Route::get('marketing', 'DemoController@marketing')->name('marketing');

Auth::routes();

Route::get('marketing/{id}', 'HomeController@index')->name('home');
