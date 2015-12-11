<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Database\po;
use App\Http\Database\dpo;

class POController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu_po');
        $this->middleware('permission:btn_po_add',['only'=>['create','store']]);
        $this->middleware('permission:btn_po_edit',['only'=>['edit','update']]);
        $this->middleware('permission:btn_po_delete',['only'=>['destroy']]);
    }

    /**
     * Search all in PO List
     *
     * @return Response
     * @author Y. Brahmantyo A.K
     **/
    public function getSearch(Request $request)
    {
        $s = $request->input('s');
        $po = po::leftJoin('msupplier AS s','s.idsupp','=','po.idsupp')
                ->where('idpo','like','%'.$s.'%')
                ->orWhere('tglpo','like','%'.$s.'%')
                ->orWhere('s.nama','like','%'.$s.'%')
                ->paginate(\Config::get('pages'))->appends('s',$s);
        return view('admin.transaction.po')->with('po',$po);
    }

    /**
     * Display listing of all Purchase Order     
     * 
     * @return Response
     * @author Y.Brahmantyo A.K
     */
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
    public function getIndex(Request $request)
    {
        /*

SELECT po.*,dpo.*,b.namadet nmbarang,d.nama, s.nama supplier,d.nama divisi
FROM dpo
INNER JOIN po ON po.idpo=dpo.idinduk
LEFT JOIN supplier s ON s.idsupp=po.idsupp
LEFT JOIN barang b ON b.plu=dpo.plu
LEFT JOIN divisi d ON d.iddivisi=b.divisi
WHERE po.status=1
ORDER BY dpo.idinduk

       */
        $errmsg = "Just Do Advanced Search";
        if($request->input('mode')=='adv'){
            $po = dpo::select('po.*','dpo.*','b.namadet as nmbarang','b.divisi as nmdivisi','b.supplier')
            ->selectRaw('(SELECT COUNT(*) FROM dpo WHERE dpo.idinduk=po.idpo) AS pocount')
            ->join('po','po.idpo','=','dpo.idinduk')
            //->leftJoin('msupplier as s','s.idsupp','=','po.idsupp')
            ->leftJoin('mbarang as b','b.plu','=','dpo.plu')
            //->leftJoin('mdivisi as d','d.iddivisi','=','b.divisi')
            ->where(function($query) use($request){
                    $tgl1 = $request->input('tgl1');
                    $tgl2 = $request->input('tgl2');
                    $divisi = $request->input('divisi');
                    $supplier = $request->input('supplier');
                    $kontrak = $request->input('kontrak');
                    if($tgl1 && $tgl2){
                        $query->where('tglpo','>=',$tgl1)->where('tglpo','<=',$tgl2);
                        $this->appends['tgl1']=$tgl1;
                        $this->appends['tgl2']=$tgl2;                    
                    }
                    if($divisi){
                        $query->where('b.divisi','like','%'.$divisi.'%');
                        $this->appends['divisi']=$divisi;
                    }
                    if($supplier){
                        $query->where('b.supplier','like','%'.$supplier.'%');
                        $this->appends['supplier']=$supplier;
                    }
                    if($kontrak){
                        $query->where('po.contractno','=',$kontrak);
                        $this->appends['kontrak']=$kontrak;
                    }        
                    return $query;
                })
            ->where('po.status',1)->orderBy('dpo.idinduk','desc')->get();
            //dd($po);die;            
            return view('admin.transaction.purchasing.po')->with('po',$po);
    /*        $po = po::leftJoin('msupplier AS s','s.idsupp','=','po.idsupp')
                ->where('status','=','1')
                ->where(function($query) use($request){
                        $tgl1 = $request->input('tgl1');
                        $tgl2 = $request->input('tgl2');
                        $divisi = $request->input('divisi');
                        $supplier = $request->input('supplier');
                        $kontrak = $request->input('kontrak');
                        if($tgl1 && $tgl2){
                            $query->where('tglpo','>=',$tgl1)->where('tglpo','<=',$tgl2);
                            $this->appends['tgl1']=$tgl1;
                            $this->appends['tgl2']=$tgl2;                    
                        }
                        if($divisi){
                            $query->where('d.nama','like','%'.$divisi.'%');
                            $this->appends['divisi']=$divisi;
                        }
                        if($supplier){
                            $query->where('s.nama','like','%'.$supplier.'%');
                            $this->appends['supplier']=$supplier;
                        }
                        if($kontrak){
                            $query->where('po.contractno','=',$kontrak);
                            $this->appends['kontrak']=$kontrak;
                        }        
                        return $query;
                    })
                ->orderBy('tglpo','desc')
                ->get();
            return view('admin.transaction.purchasing.po')->with('po',$po);*/
        }
        return view('admin.transaction.purchasing.po');
    }

    /**
     * Show Purchasing Order Detail
     *
     * @return void
     * @author Y.Brahmantyo A.K
     **/
    public function getShow($id)
    {
        $po = po::where('idpo',str_replace('-','/',$id))->first();
       return view('admin.transaction.purchasing.po-show')->with('po',$po);
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

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function getShow($id)
    // {
    //     $po = po::find(str_replace('-','/',$id));
    //     return view('admin.transaction.po-show')->with('po',$po);
    // }

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
