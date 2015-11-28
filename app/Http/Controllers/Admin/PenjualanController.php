<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Config;
use Illuminate\Http\Request;
use App\Http\Database\jual;

class PenjualanController extends Controller {
	public function __construct()
	{
		$this->middleware('permission:menu_penjualan');
		$this->middleware('permission:btn_penjualan_add',['only'=>['create','store']]);
		$this->middleware('permission:btn_penjualan_edit',['only'=>['edit','update']]);
		$this->middleware('permission:btn_penjualan_delete',['only'=>['destroy']]);
	}
	/**
	 * Menampilkan daftar transaksi penjualan
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$jual = jual::where('status','1')->orderBy('tgl','desc')->paginate(Config::get('pages'));
		return view('admin.transaction.penjualan.penjualan')->with('jual',$jual);
	}

	/**
     * Search all in Penjualan List
     *
     * @return Response
     * @author Y. Brahmantyo A.K
     **/
    public function getSearch(Request $request)
    {
        $s = $request->input('s');
        $jual = jual::leftJoin('mkonsumen AS k','k.idkonsumen','=','jual.idkons')
                ->where('idtrx','like','%'.$s.'%')
                ->orWhere('tgl','like','%'.$s.'%')
                ->orWhere('k.nama','like','%'.$s.'%')
                ->paginate(\Config::get('pages'))->appends('s',$s);
        return view('admin.transaction.penjualan.penjualan')->with('jual',$jual);
    }

}