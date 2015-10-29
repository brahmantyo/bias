<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PenjualanController extends Controller {

	/**
	 * Menampilkan daftar transaksi penjualan
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('admin.transaction.penjualan');
	}
	public function getJual()
	{
		$jual = \DB::table('jual')->select('idtrx as id','tgl','kasir','idkons as konsumen','idsales as sales','status','totqty','totbruto','totnetto','totdiskon')->get();
		return json_encode($jual);
	}
	public function getDjual($idtrx){
		$djual = \DB::table('djual')->select('*')
			->where('idinduk','=',$idtrx)->get();
		return json_encode($djual);
	}
	public function getSettings()
	{
		$data = \DB::table('msetting')->select('*')->get();
		return json_encode($data);
	}
}