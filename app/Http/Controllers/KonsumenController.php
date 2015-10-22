<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Request;
use Validator;
use Hash;
use App\User;
use App\konsumen;
use Input;

class KonsumenController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return view('world.dashboard.index');
	}

	public function daftar()
	{

		$rules = [
			'userid'		=> 'required|unique:users,name',
			'password'		=> 'required',
			'confirm'		=> 'required|same:password',
			'alamat'		=> 'required|min:10',
			'kota'			=> 'required|not_in:0',
			'telp'			=> 'required',
			'email'			=> 'email|unique:users,email',
			'nmdepan'		=> 'required',
		];

		$messages = [
			'userid.required'	=> 'User ID wajib diisi',
			'userid.unique'		=> 'User '.Request::get('userid').' sudah terdaftar',
			'password.required'	=> 'Password belum terisi',
			'confirm.required'	=> 'Konfirmasi Password belum terisi',
			'confirm.same'		=> 'Password konfirmasi tidak sama (pastikan tombol CAPS LOCK tidak aktif)',
			'alamat.required'	=> 'Alamat harus diisi',
			'alamat.min'		=> 'Alamat yang Anda masukan terlalu pendek (min:10 karakter)',
			'kota.required'		=> 'Kota wajib diisi',
			'kota.not_in'		=> 'Kota belum dipilih',
			'telp.required'		=> 'Telp dari Perusahaan/Contact Person wajib dicantumkan',
			'email.email'		=> 'Format pengisian email belum benar',
			'email.unique'		=> 'Email '.Request::get('email').' sudah terdaftar',
			'nmdepan.required'	=> 'Nama depan contact person wajib tercantum',
		];
		$validator = Validator::make(Request::all(),$rules,$messages);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator->errors())->withInput();
		}

		//create user
		$userid = Request::get('userid');
		$password = Request::get('password');
		$fname = Request::get('nmdepan');
		$lname = Request::get('nmbelakang');
		$email = Request::get('email');
		$level = 'KONSUMEN';
		$photo = '/dist/img/avatar.png';

		$user = new User;
		$user->name = $userid;
		$user->password = Hash::make($password);
		$user->first_name = $fname;
		$user->last_name = $lname;
		$user->email = $email;
		$user->level = $level;
		$user->photo = $photo;
		$user->save();



		//create konsumen
		$contact = $fname.($lname==''?'':' '.$lname);
		$nmperusahaan = Request::get('nmperusahaan');
		$alamat = Request::get('alamat');
		$kota = Request::get('kota');
		$notelp = Request::get('telp');
		

		$konsumen = new konsumen;
		$konsumen->nama = $nmperusahaan?$nmperusahaan:'-';
		$konsumen->alamat = $alamat; //required. alamat perusahaan
		$konsumen->kota = $kota;
		$konsumen->notelp = $notelp?$notelp:'-';
		$konsumen->email = $email;
		$konsumen->cp = $contact;
		$konsumen->tgldaftar = date('Y-m-d');
		$konsumen->iduser = $user->id;
		$konsumen->save();

		return Redirect::back()->withErrors('Success: <div class="text text-success"><h1>Pendaftaran Berhasil. Silahkan Login ke <b>Konsumen Area</b> untuk melakukan pengiriman</h1></div>');

	}

	public function profilShowStart()
	{
		$user = \Auth::user();
		$konsumen = \App\konsumen::where('iduser','=',$user->id)->first();
		return view('world.dashboard.profil-modal')->with('user',$user)->with('konsumen',$konsumen);
	}

	public function profilSaveStart()
	{
		$rules = [
			'alamat'		=> 'required|min:10',
			'kota'			=> 'required|not_in:0',
			'telp'			=> 'required',
			'email'			=> 'email',
			'contact'		=> 'required',
			'id'			=> 'required',
		];

		$messages = [
			'alamat.required'	=> 'Alamat harus diisi',
			'alamat.min'		=> 'Alamat yang Anda masukan terlalu pendek',
			'kota.required'		=> 'Kota wajib diisi',
			'kota.not_in'		=> 'Kota belum dipilih',
			'telp.required'		=> 'Telp dari Perusahaan/Contact Person wajib dicantumkan',
			'email.email'		=> 'Format pengisian email belum benar',
			'contact.required'	=> 'Nama contact person wajib tercantum',
			'id.required'		=> 'Maaf Anda tidak berhak melakukan operasi ini !',
		];
		$validator = Validator::make(Request::all(),$rules,$messages);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator->errors())->withInput();
		}

		$nmperusahaan = Request::get('nmperusahaan');
		$alamat = Request::get('alamat');
		$kota = Request::get('kota');
		$notelp = Request::get('telp');
		$email = Request::get('email');
		$contactperson = Request::get('contact');
		$id = Request::get('id');



		$konsumen = new konsumen;
		$konsumen->nama = $nmperusahaan?$nmperusahaan:'-';
		$konsumen->alamat = $alamat; //required. alamat perusahaan
		$konsumen->kota = $kota;
		$konsumen->notelp = $notelp?$notelp:'-';
		$konsumen->email = $email;
		$konsumen->cp = $contactperson;
		$konsumen->tgldaftar = date('Y-m-d');
		$konsumen->iduser = $id;
		$konsumen->save();
		return Redirect::to('/konsumenpanel');
		//return '<script type="text/javascript">window.location.href("/konsumenpanel");parent.$.fancybox.close()</script>';
	}




	public function profilShow()
	{
		$user = \Auth::user();
		$konsumen = \App\konsumen::where('iduser','=',$user->id)->first();
		return view('world.dashboard.profil')->with('user',$user)->with('konsumen',$konsumen);
	}

	public function profilEdit()
	{
		$user = \Auth::user();
		$konsumen = \App\konsumen::where('iduser','=',$user->id)->first();

		$rules = [
			'nmperusahaan' => 'max:30',
			'alamat' => 'required|min:3|max:100',
			'kota' => 'required',
			'email' => 'required',
			'kpassword' => 'same:password'
		];

		$messages = [
			'nmperusahaan.max'	=> 'Pengisian Nama Perusahaan maksimal 30 karakter',
			'alamat.required' => 'Alamat Perusahaan harus diisi',
			'alamat.min'	=> 'Alamat Perusahaan belum benar',
			'alamat.max'	=> 'Alamat Perusahaan maksimal 100 karakter',
			'kota' => 'Field Kota belum terisi',
			'email.required' => 'Email harus diisi',
			'kpassword.same' => 'Password konfimasi tidak sama'
		];

		$validator = Validator::make(Request::all(),$rules,$messages);

		if($validator->fails()){
			return view('world.dashboard.profil')->with('user',$user)->with('konsumen',$konsumen)->withErrors($validator->errors());
		}

		$cekprofil=false;

		$firstname = Request::get('contactfirst'); //contact first name
		$lastname = Request::get('contactlast');	//contact last name
		$space = ($firstname&&$lastname)?' ':'';
		$contactperson = ($firstname||$lastname)?$firstname.$space.$lastname:'';
		$nmperusahaan = Request::get('nmperusahaan');
		$alamat = Request::get('alamat');
		$kota = Request::get('kota');
		$notelp =  Request::get('telp');
		$email = Request::get('email');
		$password = Request::get('password');
		$kpassword = Request::get('kpassword');

		//update data user

		$user->name = $user->name; //required. nama user
		$user->email = $user->email; //required. email user
		$user->level = $user->level; //required. level user
		$user->password = Hash::make($password?$password:$user->password); //required. if empty use old password 
		$user->photo = 'dist/img/avatar.png';
		$user->first_name = $firstname?$firstname:'-';
		$user->last_name = $lastname?$lastname:'-';
		$user->save();

		//update data konsumen
		$getuser = User::where('email','=',$email)->get();
		
		foreach ($getuser as $key => $value) {
			$id = $value->id;
		}

		$konsumen->nama = $nmperusahaan?$nmperusahaan:'-';
		$konsumen->alamat = $alamat; //required. alamat perusahaan
		$konsumen->kota = $kota;
		$konsumen->notelp = $notelp?$notelp:'-';
		$konsumen->email = $email;
		$konsumen->cp = $contactperson;
		$konsumen->tgldaftar = date('Y-m-d');
		$konsumen->iduser = $id;
		$konsumen->save();

		return $this->index();
	}

}
