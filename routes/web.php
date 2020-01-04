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


Route::get('/qrcode',function(){
	return QrCode::size(100)->generate('ASO');
});

Route::get('qr-gallery', 'QrCodeController@index');
Route::post('qr-gallery', 'QrCodeController@upload');
Route::delete('qr-gallery/{id}', 'QrCodeController@destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
