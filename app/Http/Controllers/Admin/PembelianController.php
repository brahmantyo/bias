<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PembelianController extends Controller {

	/**
	 * Menampilkan daftar transaksi pembelilan
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return view('admin.report.pembelian');
	}

}