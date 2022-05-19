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

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/home', function () {
    return view('/pages/home');
})->middleware(['auth'])->name('home');*/

Route::get('/home', 'App\Http\Controllers\homeController@index')->middleware(['auth'])->name('home');
Route::post('/taxavalor', 'App\Http\Controllers\homeController@taxaValor')->middleware(['auth'])->name('taxavalor');
Route::post('/cotacoes', 'App\Http\Controllers\homeController@cotacoes')->middleware(['auth'])->name('cotacoes');
Route::post('/taxasupdate', 'App\Http\Controllers\homeController@updateTaxas')->middleware(['auth'])->name('updateTaxas');
Route::post('/cotacaosave', 'App\Http\Controllers\homeController@cotacaoSave')->middleware(['auth'])->name('cotacaoSave');
Route::get('/sendbasicemail/{id}','App\Http\Controllers\MailController@basic_email');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
