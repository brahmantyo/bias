<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Config;
use Illuminate\Http\Request;
use App\Http\Database\jual;

class PenjualanController extends Controller {

	public function __construct(Request $request)
	{
		$this->middleware('permission:menu_penjualan');
		$this->middleware('permission:btn_penjualan_add',['only'=>['create','store']]);
		$this->middleware('permission:btn_penjualan_edit',['only'=>['edit','update']]);
		$this->middleware('permission:btn_penjualan_delete',['only'=>['destroy']]);
        if($request->get('show')){
            $pages = $request->get('show')=='all'?jual::count():$request->get('show');
            Config::set('pages', $pages);
        }
        return \View::share(['divisi'=>['putihan','beachwear']]);
	}
	/**
	 * Menampilkan daftar transaksi penjualan
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
	{
        //Search variable
        $s = $request->get('s'); //Search anything
        $tgl1 = $request->input('tgl1');
        $tgl2 = $request->input('tgl2');
        $divisi = $request->input('divisi');
        $konsumen = $request->input('konsumen');
        $sales = $request->input('sales');
        //End search variable

        if($request->input('adv')){
            $tgl1 = $request->input('tgl1');
            $tgl2 = $request->input('tgl2');
            $divisi = $request->input('divisi');
            $konsumen = $request->input('konsumen');
            $sales = $request->input('sales');
        } else {
            $jual = jual::join('mkonsumen AS k','k.idkonsumen','=','jual.idkons')
            ->join('msales AS sl','sl.idsales','=','jual.idsales')
            ->join('mdivisi AS d','d.iddivisi','=','sl.divisi')
            ->where('idtrx','like','%'.$s.'%')
            ->orWhere('d.nama','like','%'.$s.'%')
            ->orWhere('tgl','like','%'.$s.'%')
            ->orWhere('k.nama','like','%'.$s.'%')
            ->orWhere('sl.nama','like','%'.$s.'%')
            ->where('status','=',1);
        }

    //if($request->get('s')){

        $total = [
            //'s'=>$request->get('s'),
            'total'=>$jual->count(),
            'totbruto'=>$jual->sum('totbruto'),
            'totqty'=>$jual->sum('totqty'),
            'totdiskon'=>$jual->sum('totdiskon'),
            'totnetto'=>$jual->sum('totnetto')
        ];
        
        //}
        return view('admin.transaction.penjualan.penjualan',$total)->with('jual',$jual->paginate(Config::get('pages'))->appends('s',$s)->appends('show',Config::get('pages')));
	}

	/**
     * Advanced Search Form
     *
     * @return Response
     * @author Y. Brahmantyo A.K
     **/
    public function getSearch(Request $request)
    {
     return view('admin.transaction.penjualan.penjualan-search');
    }

    /**
     * Search all in Penjualan List
     *
     * @return Response
     * @author Y. Brahmantyo A.K
     **/
    public function postSearch(Request $request)
    {


        $jual = jual::where('tgl','<','2015-10-05');
        $total = [
            'totbruto'=>$jual->sum('totbruto'),
            'totqty'=>$jual->sum('totqty'),
            'totdiskon'=>$jual->sum('totdiskon'),
            'totnetto'=>$jual->sum('totnetto')
        ];
        
     return redirect('admin.transaction.penjualan.penjualan',$total)->with('jual',$jual->paginate(Config::get('pages'))->appends('show',Config::get('pages')));
    }


    /**
     * Show Detail
     *
     * @return View
     * @author Y.Brahmantyo A.K
     **/
    public function getShow($id)
    {
    	$jual = jual::find($id);
    	return view('admin.transaction.penjualan.penjualan-show')->with('jual',$jual);
    }

}