<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Priveleges
use App\Http\Database\privileges as privileges;
use App\Http\Database\privileges_group as privileges_group;
use App\Http\Database\privileges_user as privileges_user;
use App\setting;

//
use Config;
use View;
use Menu;

use App\Helpers as Helpers;
use Illuminate\Support\Collection;

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

        //set user and group (sementara, sblm auth diaktifkan)
        //Config::set('user',1);
        Config::set('group',1);
        $settings =  setting::all();
        foreach($settings as $item){
            Config::set($item->config_key,$item->config_value);
        }

        
        $privileges = privileges_group::select('p.privilegesid as id','p.privilegesname as name','p.privilegesdesc as desc')
            ->leftJoin('mprivileges as p','p.privilegesid','=','mprivileges_group.privilegesid')
            ->where('mprivileges_group.groupid','=',Config::get('group'))->get();
        Config::set('privileges',$privileges);



        //Setting All Menu Here ... !
        Menu::make('mastermenu',function($menu){
            $menu->raw('My Menu',['class'=>'header'])->data('permission','root_menu');
            $menu->add('Base')->data('permission','root_menu_base');
            $menu->item('base')->add('User','admin/user')->data('permission','menu_user');
            $menu->item('base')->add('Group','admin/group')->data('permission','menu_group');
            $menu->item('base')->add('Privileges','admin/privileges')->data('permission','menu_privileges');
            $menu->item('base')->add('Permission','admin')->data('permission','menu_permission');
            

            $menu->add('Master')->data('permission','root_menu_master');
            $menu->item('master')->add('Cabang','admin/cabang')->data('permission','menu_cabang');
            $menu->item('master')->add('Barang','admin/barang')->data('permission','menu_barang');
            
            $menu->item('master')->add('Supplier','admin/supplier')->data('permission','menu_supplier');
            $menu->item('master')->add('Konsumen','admin/konsumen')->data('permission','menu_konsumen');
            $menu->item('master')->add('Sales','admin/sales')->data('permission','menu_sales');

            $menu->add('Transaksi')->data('permission','root_menu_transaksi');
            $menu->item('transaksi')->add('Purchase Order','admin/po')->data('permission','menu_po');
            $menu->item('transaksi')->add('Pembelian','admin/pembelian')->data('permission','menu_beli');
            $menu->item('transaksi')->add('Penjualan','admin/penjualan')->data('permission','menu_jual');

            $menu->add('About','about',['class'=>'treeview'])->data('permission','menu_about');
        })->filter(function($item){
            if(Config::get('group')<0){
                return true;
            }else{
                foreach (Config::get('privileges') as $p) {
                    if($p->name===$item->data('permission')){
                        return true;
                    }
                }
            }
            return false;
        });
        Config::set('menu',Menu::get('mastermenu'));

        // End of Setting All Menu

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
