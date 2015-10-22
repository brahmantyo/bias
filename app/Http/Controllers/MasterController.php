<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\armada;
use App\cabang;
use App\jabatan;
use App\konsumen;
use App\pegawai;
use App\User;
use Illuminate\Database\QueryException;
use Input;
use Redirect;
use Request;
use Validator;

class MasterController extends Controller {

	private $pagination = 5;

	public function __construct(){
		//$this->middleware('auth');
	}

	private function errorDict($e, $context, $value ){
		switch($e->getCode()){
			case '23000' : return 'Maaf Anda tidak bisa menghapus <b>'.strtoupper($context).' '.strtoupper($value).'</b> karena terkait dengan data lain.'; break;
		}
	}
	//Konsumen

	public function konsumen()
	{
		$konsumen = konsumen::orderBy('idkonsumen', 'desc')->paginate($this->pagination);
		return view('pages.konsumen')->with('konsumen',$konsumen);
	}

	public function konsumenDelete($id)
	{
		$konsumen = konsumen::find($id);
		try {
			$user = User::find($konsumen->iduser);
			$user->delete();
		} catch(QueryException $ue){
			//$errors = $this->errorDict($ue,'user',$konsumen->name);
		}finally{
			try {
				$konsumen->delete();
			} catch(QueryException $ke){
				$errors = $this->errorDict($ke,'konsumen',$konsumen->nama);
				return Redirect::to('/konsumen')->withErrors($errors);
			} finally{
				return Redirect::to('/konsumen');
			}
		}
	}

	public function konsumenCreate()
	{
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'telp' => 'required|numeric',
		        'email' => 'email',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$konsumen = new konsumen;
			$konsumen->nama = Request::get('nama');
			$konsumen->alamat = Request::get('alamat');
			$konsumen->kota = Request::get('kota');
			$konsumen->notelp = Request::get('telp');
			$konsumen->cp = Request::get('contact');
			$konsumen->email = Request::get('email');
			$konsumen->tgldaftar = date('Y-m-d H:i:s');
			$konsumen->save();
			return Redirect::to('/konsumen');
		}
		return view('pages.konsumen-add');
	}

	public function konsumenEdit($id)
	{
		$konsumen = konsumen::find($id);
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'telp' => 'required|numeric',
		        'email' => 'email',
		    ]);
		    if ($v->fails())
		    {
		    	$s='';
		        return redirect()->back()->withErrors($v->errors())->with('konsumen',$s);
		    }
			$konsumen->nama = Request::get('nama');
			$konsumen->alamat = Request::get('alamat');
			$konsumen->kota = Request::get('kota');
			$konsumen->notelp = Request::get('telp');
			$konsumen->cp = Request::get('contact');
			$konsumen->email = Request::get('email');
			$konsumen->tgldaftar = date('Y-m-d H:i:s');
			$konsumen->save();
			return Redirect::to('/konsumen');
		}
		return view('pages.konsumen-edit')->with('konsumen',$konsumen);
	}


	//Jabatan

	public function jabatan()
	{
		$jabatan = jabatan::paginate($this->pagination);
		return view('pages.jabatan')->with('jabatan',$jabatan);
	}

	public function jabatanDelete($id)
	{
		$jabatan = jabatan::find($id);
		try {
			$jabatan->delete();
    	} catch(QueryException $e) {
    		$errors = $this->errorDict($e,'jabatan',$jabatan->nmjabatan);
    		return Redirect::to('/jabatan')->withErrors($errors);
    	} finally {
    		return Redirect::to('/jabatan');
    	}
    }

	public function jabatanCreate()
	{
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$jabatan = new jabatan;
			$jabatan->nmjabatan = Request::get('nama');
			$jabatan->save();
			return Redirect::to('/jabatan');
		}
		return view('pages.jabatan-add');
	}

	public function jabatanEdit($id)
	{
		$jabatan = jabatan::find($id);
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$jabatan->nmjabatan = Request::get('nama');
			$jabatan->save();
			return Redirect::to('/jabatan');
		}
		return view('pages.jabatan-edit')->with('jabatan',$jabatan);
	}


	//Pegawai

	public function pegawai()
	{
		$pegawai = pegawai::leftJoin('jabatan','pegawai.idjabatan','=','jabatan.idjabatan')
					->select('idpegawai as nopeg','nama','alamat','nmjabatan as jabatan','tglrekrut','gajipokok')->paginate($this->pagination);
		return view('pages.pegawai')->with('pegawai',$pegawai);
	}

	public function pegawaiDelete($id)
	{
		$pegawai = pegawai::find($id);
		try {
			$pegawai->delete();
    	} catch(QueryException $e){
    		$errors = $this->errorDict($e,'pegawai',$pegawai->nama);
    		return Redirect::to('/pegawai')->withErrors($errors);
    	} finally {
			return Redirect::to('/pegawai');
		}
	}

	public function pegawaiCreate()
	{
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'jabatan' => 'required',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$pegawai = new pegawai;
			$pegawai->nama = Request::get('nama');
			$pegawai->alamat = Request::get('alamat');
			$pegawai->idjabatan = Request::get('jabatan');
			$pegawai->tglrekrut = date_format(date_create(Request::get('tglrekrut')),'Y-m-d');
			$pegawai->gajipokok = Request::get('gajipokok');
			$pegawai->save();
			return Redirect::to('/pegawai');
		}
		$jabatan = array();
		$tbljabatan = jabatan::all();
		foreach($tbljabatan as $j)
		{
			$jabatan[$j->idjabatan] = ucfirst($j->nmjabatan);	
		}
		return view('pages.pegawai-add')->with('jabatan',$jabatan);
	}

	public function pegawaiEdit($id)
	{
		$pegawai = pegawai::find($id);
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'jabatan' => 'required',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$pegawai->nama = Request::get('nama');
			$pegawai->alamat = Request::get('alamat');
			$pegawai->idjabatan = Request::get('jabatan');
			$pegawai->tglrekrut = date_format(date_create(Request::get('tglrekrut')),'Y-m-d');
			$pegawai->gajipokok = Request::get('gajipokok');
			$pegawai->save();
			return Redirect::to('/pegawai');
		}
		$jabatan = array();
		$tbljabatan = jabatan::all();
		foreach($tbljabatan as $j)
		{
			$jabatan[$j->idjabatan] = ucfirst($j->nmjabatan);	
		}
		return view('pages.pegawai-edit')->with('pegawai',$pegawai)->with('jabatan',$jabatan);
	}

	//Armada

	public function armada()
	{
		$armada = armada::paginate($this->pagination);
		return view('pages.armada')->with('armada',$armada);
	}

	public function armadaCreate()
	{
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nopol' => 'required',
		        'jenis' => 'required',
		        'tahun' => 'string|size:4',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$armada = new armada;
			$armada->nopolisi = strtoupper(Request::get('nopol'));
			$armada->jeniskendaraan = Request::get('jenis');
			$armada->tahun = Request::get('tahun');
			$armada->save();
			return Redirect::to('/armada');
		}
		return view('pages.armada-add');
	}

	public function armadaEdit($id)
	{
		$armada = armada::find($id);
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nopol' => 'required',
		        'jenis' => 'required',
		        'tahun' => 'string|size:4',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$armada->nopolisi = strtoupper(Request::get('nopol'));
			$armada->jeniskendaraan = Request::get('jenis');
			$armada->tahun = Request::get('tahun');
			$armada->save();
			return Redirect::to('/armada');
		}
		return view('pages.armada-edit')->with('armada',$armada);
	}
	
	public function armadaDelete($id)
	{
		$armada = armada::find($id);
		try {
			$armada->delete();
		} catch(QueryException $e){
			$errors = $this->errorDict($e,'armada',$armada->nopolisi);
			return $this->armada()->withErrors($errors);
		} finally {
			return $this->armada();			
		}

	}
	//Kota

	public function kota()
	{
		//
	}

	//Cabang

	public function cabang()
	{
		$cabang = cabang::paginate($this->pagination);
		return view('pages.cabang')->with('cabang',$cabang);
	}

	public function cabangDelete($id)
	{
		$cabang = cabang::find($id);
		$cabang->delete();
		return $this->cabang();
	}

	public function cabangCreate()
	{
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'telp' => 'max:15',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$cabang = new cabang;
			$cabang->nama = Request::get('nama');
			$cabang->alamat = Request::get('alamat');
			$cabang->telp = Request::get('telp');
			$cabang->save();
			return Redirect::to('/cabang');
		}
		return view('pages.cabang-add');
	}

	public function cabangEdit($id)
	{
		$cabang = cabang::find($id);
		if(Request::method()=='POST'){
		    $v = Validator::make(Request::all(),[
		        'nama' => 'required',
		        'alamat' => 'required',
		        'telp' => 'max:15',
		    ]);
		    if ($v->fails())
		    {
		        return redirect()->back()->withInput()->withErrors($v->errors());
		    }
			$cabang->nama = Request::get('nama');
			$cabang->alamat = Request::get('alamat');
			$cabang->telp = Request::get('telp');
			$cabang->save();
			return Redirect::to('/cabang');
		}
		return view('pages.cabang-edit')->with('cabang',$cabang);
	}
}