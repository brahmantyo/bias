<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Priveleges
use App\Http\Database\privileges as privileges;
use App\Http\Database\privileges_group as privileges_group;
use App\Http\Database\privileges_user as privileges_user;
use App\setting;

//
use Session;
use Config;
use View;
use Menu;

use App\Helpers as Helpers;
use Illuminate\Support\Collection;

//
use App\Http\Database\article as Article;
//use App\Http\Database\kota;
use App\Http\Database\cabang;
use App\Http\Database\divisi;
use App\Http\Database\sales;
use App\Http\Database\satuan;


class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public $companytitle;

	public function boot()
	{


		date_default_timezone_set('Asia/Jakarta');
/*
		$abouts  = array();
		$news = array();
		$memo = array();*/
		$dcabang = array();
		$ddivisi = array();
		$dsales = array();
		// $dkota = array();
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

		*/
		$cabang = cabang::all();
		foreach ($cabang as $v) {
			$dcabang[$v->idcabang]= $v->nama;
		}
		$dcabang = Helpers::assoc_merge([0=>'--Daftar Cabang--'],$dcabang);

		$divisi = divisi::all();
		foreach ($divisi as $v) {
			$ddivisi[$v->nama]= $v->nama;
		}
		$ddivisi = Helpers::assoc_merge([0=>'--Semua Divisi--'],$ddivisi);

		$sales = sales::all();
		foreach ($sales as $v) {
			$dsales[$v->nama]= $v->nama;
		}
		$dsales = Helpers::assoc_merge([0=>'--Semua Sales--'],$dsales);

		
		$satuan = satuan::all();
		foreach ($satuan as $v) {
			$dsatuan[$v->namasatuan]= $v->namasatuan;
		}


		$data = array(
	/*		'abouts'=>$abouts,
			'news'=>$news,
			'memo'=>$memo,
			'kota'=>$dkota,*/
			'satuan'=>$dsatuan,
			'cabang'=>$dcabang,
			'divisi'=>$ddivisi,
			'sales'=>$dsales,
			'menu'=>Config::get('menu'),
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
