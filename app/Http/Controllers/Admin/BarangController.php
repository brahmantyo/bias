<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Config;
use Session;
use App\Http\Database\divisi;
use App\Http\Database\barang;

class BarangController extends Controller
{
    public function _construct()
    {
        $this->middleware('permission:menu_barang',['only'=>'getBarang']);
        $this->middleware('permission:menu_bahan',['only'=>'getBahan']);
        $this->middleware('permission:menu_warna',['only'=>'getWarna']);
        $this->middleware('permission:menu_motif',['only'=>'getMotif']);
        $this->middleware('permission:menu_konstruksi',['only'=>'getKonstruksi']);
        $this->middleware('permission:menu_divisi',['only'=>'getDivisi']);
    }
    /**
     * Get all daftar barang
     * 
     * @return Response
     * @author Y.Brahmantyo A.K
     */
    public function getDaftar(Request $request)
    {
        $divisi = divisi::all();
        $barang = barang::paginate(Config::get('pages'));
        switch($request){
            case $request->has('plu') : $barang = barang::where('plu','=',$request->input('plu'))
                                            ->paginate(Config::get('pages'));
                                            break;
            case $request->has('nama') : $barang = barang::where('namadet','like','%'.$request->input('nama').'%')
                                            ->paginate(Config::get('pages'));
                                            break;
            case $request->has('divisi') : $barang = barang::where('iddivisi','=',$request->input('divisi'))
                                            ->paginate(Config::get('pages'));
                                            break;
        }
        $request->flashOnly('plu','nama','divisi');

        return view('admin.master.barang.index')->with('barang',$barang)->with('divisi',$divisi);
    }

    /**
     * Get all daftar barang by divisi
     *
     * @return Response
     * @author Y.Brahmantyo A.K
     **/
    public function getSearchBarang(Request $request)
    {
        $divisi = divisi::all();
        $arrdivisi = [];
        foreach ($divisi as $d) {
            $arrdivisi[$d->iddivisi] = $d->nama;
        }
        $barang = barang::where('namadet','like','%'.$request->input('search').'%')
            ->paginate(Config::get('pages'));
        $request->flashOnly('search');
        return view('admin.master.barang.index')->with('barang',$barang)->with('arrdivisi',$arrdivisi);
    }

    public function getBahan()
    {
        return view('admin.master.barang.bahan');
    }
    public function getWarna()
    {
        return view('admin.master.barang.warna');
    }
    public function getMotif()
    {
        return view('admin.master.barang.motif');
    }
    public function getKonstruksi()
    {
        return view('admin.master.barang.konstruksi');
    }
    public function getDivisi()
    {
        return view('admin.master.barang.divisi');
    }
}
