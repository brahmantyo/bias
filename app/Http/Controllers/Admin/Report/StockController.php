<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Database\stock;

class StockController extends Controller
{
    /**
     * Get Daftar Stock
     *
     * @return Response
     * @author Y.Brahmantyo A.K
     **/
    public function getIndex(Request $request)
    {
        $stock = stock::selectRaw('sup.nama AS supplier,stock.plu,mb.namadet AS nmbarang,SUM(stock.qtyunitsisa) qtyunit,stu.namasatuan satunit,SUM(stock.qtypjgsisa) qtypjg,stp.namasatuan satpjg,SUM(stock.qtybrtsisa) qtybrt,stb.namasatuan satbrt')
                    ->leftJoin('mbarang AS mb','mb.plu','=','stock.plu')
                    ->leftJoin('msupplier AS sup','sup.idsupp','=','mb.idsup')
                    ->leftJoin('msatuan AS stu','stu.idsatuan','=','mb.satunit')
                    ->leftJoin('msatuan AS stp','stp.idsatuan','=','mb.satpjg')
                    ->leftJoin('msatuan AS stb','stb.idsatuan','=','mb.satbrt');

        if(!empty($request->input('p'))){
            $search = $request->input('p');
            $stock = $stock->where('sup.nama','like','%'.$search.'%')
                        ->orWhere('stock.plu','like','%'.$search.'%')
                        ->orWhere('mb.namadet','like','%'.$search.'%');
        }

        $stock = $stock->groupBy('stock.plu')->paginate(\Config::get('pages'));
        $request->flashOnly('p');
    	return view('admin.report.stock')->with('stock',$stock);
    }

    /**
     * Get Stock Detail
     *
     * @return void
     * @author Y.Brahmantyo A.K
     **/
    public function getShow(Request $request)
    {
        return 'detail stock';
    }
}
