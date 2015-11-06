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

Route::group(['middleware'=>['auth','admin'],'prefix'=>'admin','namespace'=>'Admin'],function()
{
	//-- Base --//
	Route::get('/',function(){
		return view('admin.index');
	});
	Route::get('about',function(){
		return view('admin.about');
	});

	Route::resource('group','GroupController');
	Route::resource('user','UserController');
	
	Route::controller('privileges','PrivilegesController');
	Route::resource('permission','PermissionController');
	Route::post('/permission/searchperm',['uses'=>'PermissionController@search']);

	//-- Master --//
	Route::resource('cabang','CabangController');
	Route::resource('supplier','SupplierController');
	Route::resource('konsumen','KonsumenController');
	Route::resource('sales','SalesController');
	Route::controller('barang','BarangController');
	
	//-- Transactions --//
	Route::resource('po','POController');	
	Route::resource('pembelian','PembelianController');
	Route::controller('penjualan','PenjualanController');

	//-- Reports --//
	Route::resource('monitoringpo','MonitoringPOController');
	//-- Utility --//
	/*
	Route::resource('article','ArticleController');
	*/


});

Route::group(['middleware'=>'auth'],function(){
	Route::get('/',function(){
		return Redirect::to('/admin');
	});	
});

Route::get('test',function(){
	return redirect()->route('tentang');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);