<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Database\targetbeli as mpo;

class MonitoringPOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //$mpo = mpo::select('*','100+bulan')->orderBy('tahun')->orderBy('bulan')->get();
        $mpo = \DB::select('select *,(100+bulan) as idbulan from dtargetbeli order by tahun,idbulan');
        return view('admin.report.monitoringpo')->with('mpo',$mpo);
    }

}
