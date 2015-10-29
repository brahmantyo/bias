<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Http\Database\konsumen;

class KonsumenController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$konsumen = konsumen::orderBy('tgldaftar')->paginate(\Config::get('pages'));
		return view('admin.master.konsumen.konsumen')->with('konsumen',$konsumen);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.master.konsumen.konsumen-add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules = [
			'nama' => 'required|unique:mkonsumen,nama',
			'alamat' => 'required',
			'telp' => 'required|numeric',
			'email' => 'email',
			'contact' => 'required'
		];
		$v = Validator::make($request->all(),$rules);
		if($v->fails()){
			return redirect()->back()->withInput()->withErrors($v->errors());
		}
		$konsumen = new konsumen;
		$konsumen->nama = $request->input('nama');
		$konsumen->alamat = $request->input('alamat');
		$konsumen->notelp = $request->input('telp');
		$konsumen->email = $request->input('email');
		$konsumen->cp = $request->input('contact');
		$konsumen->tgldaftar = Date('Y-m-d');
		$konsumen->save();
		return redirect('/admin/konsumen');
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
		$konsumen = konsumen::find($id);
		return view('admin.master.konsumen.konsumen-edit')->with('konsumen',$konsumen);
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
			'nama' => 'required|unique:,mkonsumen,nama',
			'alamat' => 'required',
			'telp' => 'required|numeric',
			'email' => 'email',
			'contact' => 'required'
		];
		$v = Validator::make($request->all(),$rules);
		if($v->fails()){
			return redirect()->back()->withInput()->withErrors($v->errors());
		}
		$konsumen = konsumen::find($id);
		$konsumen->nama = $request->input('nama');
		$konsumen->alamat = $request->input('alamat');
		$konsumen->notelp = $request->input('telp');
		$konsumen->email = $request->input('email');
		$konsumen->cp = $request->input('contact');
		$konsumen->save();
		return redirect('/admin/konsumen');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$konsumen = konsumen::find($id)->delete();
		return redirect('/admin/konsumen');
	}

}
