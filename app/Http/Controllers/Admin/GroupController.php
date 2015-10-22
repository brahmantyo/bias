<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
use Request;
use Validator;
use App\Http\Database\group;
use App\Http\Database\user;
class GroupController extends Controller {

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
		$groups = group::where('groupid','>',0)
			->orderBy('groupid','desc')
			->paginate(\Config::get('pages'));
		return view('admin.master.user.group')->with('groups',$groups);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$parents=array();
		$groups = group::where('status','>',0)->get();
		foreach ($groups as $g) {
			if($g->groupid>0){
				if($g->parent==0){
					$parents[$g->groupid] = $g->groupname;
					$this->getChildGroup($groups,$g->groupid,$parents);
				}
			}
		}
		return view('admin.master.user.group-add')->with('parents',$parents);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    $v = Validator::make(Request::all(),[
	        'groupname' => 'required',
	        'groupparent' => 'required',
	    ]);
	    if ($v->fails())
	    {
	        return redirect()->back()->withInput()->withErrors($v->errors());
	    }


		$group = new group;
		$group->groupname = Request::get('groupname');
		$group->parent = Request::get('groupparent');
		$group->status = Request::get('status')?:'0';
		$group->save();
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
		$parents=array();
		$groups = group::where('status','>',0)->get();
		foreach ($groups as $g) {
			if($g->groupid>0){
				if($g->parent==0){
					$parents[$g->groupid] = $g->groupname;
					$this->getChildGroup($groups,$g->groupid,$parents);
				}
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
	public function update($id)
	{
	    $v = Validator::make(Request::all(),[
	        'groupname' => 'required',
	        'groupparent' => 'required',
	    ]);
	    if ($v->fails())
	    {
	        return redirect()->back()->withInput()->withErrors($v->errors());
	    }
	

		$group = group::find($id);
		$group->groupname = Request::get('groupname');
		$group->parent = Request::get('groupparent');
		$group->status = Request::get('status')?:'0';
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
		$group->delete();
		return redirect('/admin/group');
	}

}