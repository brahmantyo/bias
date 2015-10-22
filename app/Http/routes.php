<?php
use App\Helpers as Helpers;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function()
{
	//-- Base --//
	/*
	Route::resource('user','UserController');
	*/
	Route::get('/','AdminController@index');
	//-- Master --//
	Route::resource('group','GroupController');
	Route::resource('user','UserController');
	Route::resource('cabang','CabangController');
	Route::resource('kota','KotaController');
	Route::resource('pegawai','PegawaiController');
	Route::resource('konsumen','KonsumenController');
	
	//-- Transactions --//

	//-- Reports --//
	Route::resource('po','POController');	
	Route::controller('pembelian','PembelianController');
	Route::controller('penjualan','PenjualanController');
	//-- Utility --//
	/*
	Route::resource('article','ArticleController');
	*/

});

Route::get('/','HomeController@index');
Route::get('test',function(){
	//var_dump(Menu::get('mastermenu'));
	//var_dump(Menu::get('mastermenu')->item('kota')->data('permission'));die;
	return view('admin.index');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);