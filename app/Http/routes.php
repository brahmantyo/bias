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
	Route::get('/','AdminController@index');
/*	Route::get('/',function(){
		return view('admin.index');
	});*/
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
	//Route::resource('po','POController');
	Route::controller('po','POController');
	Route::controller('pembelian','PembelianController');
	Route::controller('penjualan','PenjualanController');
	Route::group(['prefix'=>'report','namespace'=>'Report'],function(){
		//Report Monitoring PO
			Route::controller('po','POController');
		//Report Persediaan / Stock
			Route::controller('stock','StockController');
		//Report Pembelian
			Route::controller('pembelian','PembelianController');
		//Report Penjualan
			Route::controller('penjualan','PenjualanController');
		//Report Rugi Laba
			Route::controller('rl','RLController');
		//Report Piutang
			Route::controller('piutang','PiutangController');
		//Report Hutang
			Route::controller('hutang','HutangController');
		//Report Aliran Kas (Cash Flow)
			Route::controller('cashflow','CashflowController');
		//Report Buku Besar / General Ledger
			Route::controller('gl','GLController');
	});

	//-- Reports --//
	Route::controller('monitoringpo','MonitoringPOController');
	Route::get('beli','PembelianController@getBeli');
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

Route::get('/allsales','Admin\AdminController@index');