<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use Config;

use App\setting;
use App\Helpers as Helpers;
use Illuminate\Support\Collection;
// Priveleges
use App\Http\Database\privileges as privileges;
use App\Http\Database\privileges_group as privileges_group;
use App\Http\Database\privileges_user as privileges_user;
//
use Menu;
//
use App\Http\Database\article as Article;
use App\Http\Database\kota as Kota;
use App\Http\Database\cabang as Cabang;
use App\Http\Database\satuan as Satuan;


class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public $companytitle;

	public function boot()
	{

		$settings =  setting::all();
		foreach($settings as $item){
			Config::set($item->config_key,$item->config_value);
		}

		//$privileges = array();
		$privileges = privileges_group::select('p.privilegesid as id','p.privilegesname as name','p.privilegesdesc as desc')
			->leftJoin('mprivileges as p','p.privilegesid','=','mprivileges_group.privilegesid')
			->where('mprivileges_group.groupid','=',7)->get();

		Config::set('privileges',$privileges);

		Menu::make('mastermenu',function($menu){
			$menu->raw('My Menu',['class'=>'header'])->data('permission','root_menu');
			$menu->add('Master')->data('permission','root_menu_master');
			$menu->item('master')->add('Cabang','cabang')->data('permission','menu_cabang');
			$menu->item('master')->add('Barang','admin/barang')->data('permission','menu_barang');
			$menu->add('Transaksi')->data('permission','root_menu_transaksi');
			$menu->item('transaksi')->add('Purchase Order','admin/po')->data('permission','menu_po');
			$menu->add('About','about',['class'=>'treeview']);
		})->filter(function($item){
			$privileges = Config::get('privileges')->where('name',$item->data('permission'));
			if($privileges->count()){
				return true;
			}
			return false;
		});






		//$arr = Config::get('privileges');
		//var_dump(array_values(input)$arr->has());die;
		date_default_timezone_set('Asia/Jakarta');
/*
		$abouts  = array();
		$news = array();
		$memo = array();*/
		$dcabang = array();
		$dkota = array();
		$dsatuan = array();
		
		Config::set('registered',false);
		
		/*$articles = Article::select('article.*','users.first_name','users.last_name')
		->leftJoin('user','article.user','=','users.id')->get();
		
		foreach ($articles as $article) {
			switch($article->type){
				case 'about' : 
					$abouts[] = $article;break;
				case 'news' :
					$news[] = $article;break;
				case 'memo' :
					$memo[] = $article;break;
			}
			
		}
		$kota = Kota::all();
		foreach ($kota as $v) {
			$dkota[$v->idkota] = $v->nmkota;
		}
		$satuan = Satuan::all();
		foreach ($satuan as $v) {
			$dsatuan[$v->idsatuan]= $v->namasatuan;
		}
		$cabang = Cabang::all();
		foreach ($cabang as $v) {
			$dcabang[$v->idcabang]= $v->nama;
		}
		$dcabang = Helpers::assoc_merge([0=>'--Daftar Cabang--'],$dcabang);
		*/
		$data = array(
	/*		'abouts'=>$abouts,
			'news'=>$news,
			'memo'=>$memo,
			'kota'=>$dkota,
			'satuan'=>$dsatuan,
			'cabang'=>$dcabang,*/
			'menu'=>Menu::get('mastermenu'),
			'notification'=>[
				'all'=>0,
				'quote'=>NULL,
				'sjt'=>NULL
			],
		);
		return View::share($data);
	}

	private function cekPermission($permission)
	{

	}


	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
