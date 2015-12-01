<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Config;
use Session;
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
	public function getIndex(Request $request)
	{
        $errmsg = ['Just do Advanced Search'];
        $jual = jual::where('status','=',1);

        if($request->input('mode')=='adv'){
            $errmsg=[];
            $this->appends = ['mode'=>'adv'];
            $jual->join('mkonsumen AS k','k.idkonsumen','=','jual.idkons')
            ->join('msales AS sl','sl.idsales','=','jual.idsales')
            ->join('mdivisi AS d','d.iddivisi','=','sl.divisi')
            ->where(function($query) use($request){
                    $tgl1 = $request->input('tgl1');
                    $tgl2 = $request->input('tgl2');
                    $divisi = $request->input('divisi');
                    $konsumen = $request->input('konsumen');
                    $sales = $request->input('sales');
                    
                    if($tgl1 && $tgl2){
                        $query->where('tgl','>=',$tgl1)->where('tgl','<=',$tgl2);
                        $this->appends['tgl1']=$tgl1;
                        $this->appends['tgl2']=$tgl2;                    
                    }
                    if($divisi){
                        $query->where('d.nama','like','%'.$divisi.'%');
                        $this->appends['divisi']=$divisi;
                    }
                    if($konsumen){
                        $query->where('k.nama','like','%'.$konsumen.'%');
                        $this->appends['konsumen']=$konsumen;
                    }
                    if($sales){
                        $query->where('sl.nama','like','%'.$sales.'%');
                        $this->appends['sales']=$sales;
                    }        
                    return $query;
                })
            ->where('status','=',1);
            $jual = $jual->get();
        }
        return view('admin.transaction.penjualan.penjualan')->with('jual',$jual)->withErrors($errmsg);
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