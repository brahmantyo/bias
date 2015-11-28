<?php namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Hash;
use Validator;

use App\Http\Database\user;
use App\Http\Database\group;
class UserController extends Controller {

	public function __construct()
	{
		$this->middleware('permission:menu_user');
		$this->middleware('permission:btn_user_add',['only'=>['create','store']]);
		$this->middleware('permission:btn_user_edit',['only'=>['edit','update']]);
		$this->middleware('permission:btn_user_delete',['only'=>['destroy']]);
	}

	/**
	 * Function for get child/children of group
	 *
	 * @param recordset $groups
	 * @param int $idparent
	 * @param pointer $parent
	 * @return Response
	 */
	private function getChildGroup($groups,$idparent,&$parents){
		foreach($groups as $g){
			if($g->parent==$idparent){
				$parents[$g->groupid] = $parents[$idparent].'>'.$g->groupname;
				$this->getChildGroup($groups,$g->groupid,$parents);
			}
		}
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(\Config::get('group')>0){
			$user = user::select('musers.*','mgroup.groupname')
				->leftJoin('mgroup','mgroup.groupid','=','musers.groupid')
					->where('musers.status','>',0)
					->where('musers.groupid','>',0)
					->paginate(\Config::get('pages'));
		}else{
			$user = user::where('status','>',0)
					->paginate(\Config::get('pages'));			
		}
		return view('admin.master.user.user')->with('users',$user);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$grouplvl=array();
		if(\Config::get('group') == -1){
			$groups = group::where('status','>',0)->get();
		}else{
			$groups = group::where('status','>',0)->where('groupid','>',0)->get();
		}

		foreach ($groups as $g) {
			if($g->parent==0){
				$grouplvl[$g->groupid] = $g->groupname;
				$this->getChildGroup($groups,$g->groupid,$grouplvl);
			}
		}

		return view('admin.master.user.user-add')->with('groups',$grouplvl);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$rules = [
			'login' => 'required|unique:musers,name',
			'email' => 'required|email',
			'password' => 'required|confirmed'
		];
		$v = Validator::make($request->input(),$rules);
		if($v->fails()){
			return redirect()->back()->withInput()->withErrors($v->errors());
		}
		$user = new user;
		$user->firstname = $request->input('firstname');
		$user->lastname = $request->input('lastname');
		$user->name = $request->input('login');
		$user->email = $request->input('email');
		$user->groupid = $request->input('group');
		$user->password = Hash::make($request->input('password'));
		$user->photo = ''; //not yet implemented
		$user->status = $request->input('status');
		$user->created_at = Date('Y-m-d');
		$user->save();

		return redirect('/admin/user');

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
		if(null === \Config::get('group')){
			return redirect('/admin');
		}
		$grouplvl=array();
		if(\Config::get('group') == -1){
			$groups = group::where('status','>',0)->get();
		}else{
			$groups = group::where('status','>',0)->where('groupid','>',0)->get();
		}
		foreach ($groups as $g) {
			if($g->parent==0){
				$grouplvl[$g->groupid] = $g->groupname;
				$this->getChildGroup($groups,$g->groupid,$grouplvl);
			}
		}
		$user = user::find($id);
		return view('admin.master.user.user-edit')->with('user',$user)->with('groups',$grouplvl);
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
			'login' => 'required|unique:musers,name,'.$id,
			'email' => 'required|email',
			'password' => 'required|confirmed',

		];

		$validator = Validator::make($request->all(),$rules);
		if($validator->fails()){
			return redirect()->back()->withErrors($validator->errors())->withInput();
		}

		$user = user::find($id);
		//cek password 
		$newpassword = '';
		$password = $request->get('password');
		$oldpassword = $user->password;
		if($request->get('password')===$oldpassword){
			$newpassword=$oldpassword;
		}else{
			$newpassword = Hash::make($password);
		}
		//end cek
		
		$user->firstname = $request->get('firstname');
		$user->lastname = $request->get('lastname');
		$user->name = $request->get('login');
		$user->email = $request->get('email');
		$user->password = $newpassword;
		$user->groupid = $request->get('group');
		$user->photo = $request->get('photo');
		$user->status = $request->get('status');
		$user->updated_at = Date('Y-m-d');
		$user->save();
		return redirect('/admin/user');
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

}
