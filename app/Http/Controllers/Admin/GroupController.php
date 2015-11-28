<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use App\Http\Database\group;
use App\Http\Database\user;
use App\Http\Database\privileges_group;

class GroupController extends Controller {

	public function __construct()
	{
		$this->middleware('permission:menu_group');
		$this->middleware('permission:btn_group_add',['only'=>['create','store']]);
		$this->middleware('permission:btn_group_edit',['only'=>['edit','update']]);
		$this->middleware('permission:btn_group_delete',['only'=>'destroy']);

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
			$groups = group::where('groupid','>',0)
			->orderBy('groupid','desc')
			->paginate(\Config::get('pages'));
		}else{
			$groups = group::orderBy('groupid','desc')
			->paginate(\Config::get('pages'));
		}
		
		
		//echo $groups->count();
		//die;
		return view('admin.master.user.group')->with('groups',$groups);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$parents=[0=>'No Parent'];
		if(\Config::get('group') == -1){
			$groups = group::where('status','>',0)->get();
		}else{
			$groups = group::where('status','>',0)->where('groupid','>',0)->get();
		}
		foreach ($groups as $g) {
			if($g->parent==0){
				$parents[$g->groupid] = $g->groupname;
				$this->getChildGroup($groups,$g->groupid,$parents);
			}
		}
		return view('admin.master.user.group-add')->with('parents',$parents);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
	    $v = Validator::make($request->all(),[
	        'groupname' => 'required',
	        'groupparent' => 'required',
	    ]);
	    if ($v->fails())
	    {
	        return redirect()->back()->withInput()->withErrors($v->errors());
	    }


		$group = new group;
		$group->groupname = $request->get('groupname');
		$group->parent = $request->get('groupparent');
		$group->status = $request->get('status')?:'0';
		$group->save();
		
		$groupid = $group->groupid;
		$gpriv = new privileges_group;
		//Add root menu permission
		$gpriv->privilegesid = 0;
		$gpriv->groupid = $groupid;
		$gpriv->save();
		//Add about menu permission
		$gpriv = new privileges_group;
		$gpriv->privilegesid = 10;
		$gpriv->groupid = $groupid;
		$gpriv->save();
		return redirect('/admin/group');
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


	public function edit($id)
	{
		$parents=[0=>'No Parent'];
		if(\Config::get('group') == -1){
			$groups = group::where('status','>',0)->get();
		}else{
			$groups = group::where('status','>',0)->where('groupid','>',0)->get();
		}
		foreach ($groups as $g) {
			if($g->parent==0){
				$parents[$g->groupid] = $g->groupname;
				$this->getChildGroup($groups,$g->groupid,$parents);
			}
		}
		$group = group::find($id);
		return view('admin.master.user.group-edit')->with('group',$group)->with('parents',$parents);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
	    $v = Validator::make($request->all(),[
	        'groupname' => 'required',
	        'groupparent' => 'required',
	    ]);
	    if ($v->fails())
	    {
	        return redirect()->back()->withInput()->withErrors($v->errors());
	    }
	

		$group = group::find($id);
		$group->groupname = $request->get('groupname');
		$group->parent = $request->get('groupparent');
		$group->status = $request->get('status')?:'0';
		$group->save();
		return redirect('/admin/group');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */


	public function destroy($id)
	{
		$user = user::where('groupid','=',$id);
		if($user->count()){
			$errors[] = 'maaf, group ini dipakai oleh beberapa group, jika anda yakin, mohon hapus user yang terkait dengan group ini';
	        return redirect()->back()->withErrors($errors);
		}
		$group = group::find($id);
		$groupchild = group::where('parent','=',$id);
		if($groupchild->count()){
			$errors[] = 'maaf, group ini memiliki sub group!';
	        return redirect()->back()->withErrors($errors);
		}

		//Clear permission for this group
		\DB::table('mprivileges_group')->where('groupid','=',$id)->delete();

		$group->delete();
		return redirect('/admin/group');
	}

}