<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Database\beli;

class PembelianController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu_pembelian');
        $this->middleware('permission:btn_pembelian_detail',['only'=>['show']]);
        $this->middleware('permission:btn_pembelian_add',['only'=>['create','store']]);
        $this->middleware('permission:btn_pembelian_edit',['only'=>['edit','update']]);
        $this->middleware('permission:btn_pembelian_delete',['only'=>['destroy']]);
    }
    /**
     * Search all in Pembelian List
     *
     * @return Response
     * @author Y. Brahmantyo A.K
     **/
    public function getShow($id)
    {
        $s = str_replace('-','/',$id);
        $beli = beli::leftJoin('msupplier AS s','s.idsupp','=','beli.idsupp')
                ->where('idbeli','like','%'.$s.'%')
                ->orWhere('idpo','like','%'.$s.'%')
                ->orWhere('tglbeli','like','%'.$s.'%')
                ->orWhere('s.nama','like','%'.$s.'%')
                ->get();
        return view('admin.report.pembelian')->with('beli',$beli);
    }
}
