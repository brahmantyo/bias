<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Database\muser as User;
use File;
use Hash;
use Request;
use Input;
use Redirect;

class UserController extends Controller {
	public $pagination = 5;
	public function __construct()
	{
		//$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$page='user.index';
		//Paginator::setCurrentPage($page);
		//Paginator::setBaseUrl($baseUrl);
		//Paginator::setPageName('page');
		$users = User::paginate($this->pagination);
		return view($page)->with('users',$users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('user.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = new User;

		$user->first_name = Input::get('first_name');
		$user->last_name = Input::get('last_name');
		$user->name = Input::get('name');
		$user->email = Input::get('email');
		$user->level = Input::get('level');
		$user->password = Hash::make(Input::get('password'));
		$user->photo = 'dist/img/'.Input::get('photo');
		$user->save();

		return Redirect::to('/user');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$users = User::find($id);
		return view('user.profile')->with('user',$users);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		$filename = File::name($user->photo).'.'.File::extension($user->photo);
		return view('user.edit')->with('user',$user)->with('filename',$filename);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $user = User::find($id);
 
        $user->first_name = Input::get('first_name');
        $user->last_name  = Input::get('last_name');
        $user->name 	  = Input::get('name');
        $user->email      = Input::get('email');
        $user->level      = Input::get('level');
        $user->password   = empty(Input::get('password'))?$user->password:Hash::make(Input::get('password'));
		$user->photo = 'dist/img/'.Input::get('photo');
 
        $user->save();
 
        return Redirect::to('/user');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);
		return Redirect::to('/user');
	}

}