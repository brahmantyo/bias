<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Database\po;
use Config;
class POController extends Controller
{
    /**
     * Get PO
     *
     * @return Response
     * @author Y.Brahmantyo A.K
     **/
    public function getIndex()
    {
        $po = po::leftJoin('msupplier AS s','s.idsupp','=','po.idsupp')
            ->where('status','>','0')
            ->orderBy('tglpo','desc')
            ->paginate(Config::get('pages'));
        return view('admin.transaction.po')->with('po',$po);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShow($id)
    {
        $po = po::find(str_replace('-','/',$id));
        return view('admin.transaction.po-show')->with('po',$po);
    }
}
