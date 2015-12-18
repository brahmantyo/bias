<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

use Menu;
use Session;
use Config;
use App\Http\Database\privileges as privileges;
use App\Http\Database\privileges_group as privileges_group;
use App\Http\Database\privileges_user as privileges_user;
use App\setting;

class AdminMiddleware {
	protected $auth;

	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(!$this->auth->guest()){

        //set user and group (sementara, sblm auth diaktifkan)
        //Config::set('user',1);
        $group = Session::get('group');
        Config::set('group',$group->groupid);
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
            $menu->item('base')->add('Permission','admin/permission')->data('permission','menu_permission');
            

            $menu->add('Master')->data('permission','root_menu_master');
            $menu->item('master')->add('Cabang','admin/cabang')->data('permission','menu_cabang');
            $menu->item('master')->add('Barang')->data('permission','menu_barang');
               	$menu->item('barang')->add('Daftar Barang','admin/barang/daftar')->data('permission','menu_barang');
                $menu->item('barang')->add('Parameter')->data('permission','menu_barang_parameter');
            	    $menu->item('parameter')->add('Bahan','admin/barang/bahan')->data('permission','menu_jenis');
                	$menu->item('parameter')->add('Warna','admin/barang/warna')->data('permission','menu_warna');
                	$menu->item('parameter')->add('Motif','admin/barang/motif')->data('permission','menu_motif');
                	$menu->item('parameter')->add('Konstruksi','admin/barang/konstruksi')->data('permission','menu_konstruksi');
                	$menu->item('parameter')->add('Divisi','admin/barang/divisi')->data('permission','menu_divisi');
                                
            $menu->item('master')->add('Supplier','admin/supplier')->data('permission','menu_supplier');
            $menu->item('master')->add('Konsumen','admin/konsumen')->data('permission','menu_konsumen');
            $menu->item('master')->add('Sales','admin/sales')->data('permission','menu_sales');

            $menu->add('Transaksi')->data('permission','root_menu_transaksi');
                $menu->item('transaksi')->add('Purchase Order','admin/purchasing')->data('permission','menu_po');
                $menu->item('transaksi')->add('Pembelian','admin/pembelian')->data('permission','menu_pembelian');
                $menu->item('transaksi')->add('Penjualan','admin/penjualan')->data('permission','menu_penjualan');

            $menu->add('Report')->data('permission','root_menu_report');
                $menu->item('report')->add('Purchasing')->data('permission','menu_report_purchasing');
                    $menu->item('purchasing')->add('Monitoring PO','admin/report/po')->data('permission','menu_monitoring_po');
                    //$menu->item('purchasing')->add('Monitoring Kontrak','admin/monitoringkontrak')->data('permission','menu_monitoring_kontrak');
                    //$menu->item('purchasing')->add('Monitoring Stock','admin/report/stock')->data('permission','menu_monitoring_stock');
                $menu->item('report')->add('Inventory')->data('permission','menu_report_inventory');
                $menu->item('report')->add('Sales')->data('permission','menu_report_sales');


            $menu->add('About','admin/about',['class'=>'treeview'])->data('permission','menu_about');
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

			return $next($request);
		}
		return redirect('/');
	}

}
