<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Validator;

use App\Http\Database\cabang;

class CabangController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cabang = cabang::paginate(\Config::get('pages'));
		return view('admin.master.cabang.cabang')->with('cabang',$cabang);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.master.cabang.cabang-add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules = [
			'nama'=> 'required',
			'alamat' => 'required',
			'telp' => 'required|alpha_num'
		];
		$v = Validator::make($request->all(),$rules);
		if($v->fails()){
			return redirect()->back()->withInput()->withErrors($v->errors());
		}
		$cabang = new cabang;
		$cabang->nama = $request->input('nama');
		$cabang->alamat = $request->input('alamat');
		$cabang->telp = $request->input('telp');
		$cabang->save();
		return redirect('/admin/cabang');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cabang = cabang::find($id);
		return view('admin.master.cabang.cabang-edit')->with('cabang',$cabang);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$rules = [
			'nama'=> 'required',
			'alamat' => 'required',
			'telp' => 'required|alpha_num'
		];
		$v = Validator::make($request->all(),$rules);
		if($v->fails()){
			return redirect()->back()->withInput()->withErrors($v->errors());
		}
		$cabang = cabang::find($id);
		$cabang->nama = $request->input('nama');
		$cabang->alamat = $request->input('alamat');
		$cabang->telp = $request->input('telp');
		$cabang->save();
		return redirect('/admin/cabang');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$cabang = cabang::find($id);
		if(\Config::get('group')>0){
			return redirect()->back()->withErrors(['Anda tidak berhak menghapus data ini. Silahkan hubungi Administrator']);
		}
		$cabang->delete();
		return redirect('/admin/cabang');
	}

}
