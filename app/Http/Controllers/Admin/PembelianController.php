<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Config;
use App\Http\Database\beli;
class PembelianController extends Controller {
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
    public function getSearch(Request $request)
    {
        $s = $request->input('s');
        $beli = beli::leftJoin('msupplier AS s','s.idsupp','=','beli.idsupp')
                ->where('idbeli','like','%'.$s.'%')
                ->orWhere('idpo','like','%'.$s.'%')
                ->orWhere('tglbeli','like','%'.$s.'%')
                ->orWhere('s.nama','like','%'.$s.'%')
                ->paginate(\Config::get('pages'))->appends('s',$s);
        return view('admin.transaction.pembelian.pembelian')->with('beli',$beli);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$beli = beli::orderBy('idbeli')->paginate(Config::get('pages'));
		return view('admin.transaction.pembelian.pembelian')->with('beli',$beli);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		$beli = beli::find($id);
		return  view('admin.transaction.pembelian.pembelian-show')->with('beli',$beli);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/* ----------------- */

	/**
	 * Get all data pembelian
	 *
	 * @return ajaxrespon
	 * @author Y.Brahmantyo. A.K
	 **/
	public function getBeli()
	{
		return [["January", 30000],["Februari", 10000]];
	}
}
// ["February", "8.000.000]", ["March", "4.000.000"], ["April", "13.000.000"], ["May", "17.000.000"], ["June", "9.000.000"]