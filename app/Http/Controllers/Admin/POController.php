<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Database\po;

class POController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu_po');
        $this->middleware('permission:btn_po_add',['only'=>['create','store']]);
        $this->middleware('permission:btn_po_edit',['only'=>['edit','update']]);
        $this->middleware('permission:btn_po_delete',['only'=>['destroy']]);
    }
    public function getAllpo()
    {
        $po = po::leftJoin('msupplier AS s','s.idsupp','=','po.idsupp')
            ->where('status','>','0')
            ->orderBy('tglpo','desc')
            ->paginate(\Config::get('pages'));
        return $po->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $po = po::leftJoin('msupplier AS s','s.idsupp','=','po.idsupp')
            ->where('status','>','0')
            ->orderBy('tglpo','desc')
            ->paginate(\Config::get('pages'));
        return view('admin.transaction.po')->with('po',$po);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $po = po::find(str_replace('-','/',$id));
        return view('admin.transaction.po-show')->with('po',$po);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $po = po::find(str_replace('-','/',$id));
        if($po->detail->count()){
            return redirect()->back()->withErrors(['Data tidak dapat di hapus']);
        }
        //$po->delete();
        return redirect('/admin/po')->withErrors(['Data sudah terhapus']);
    }
}
