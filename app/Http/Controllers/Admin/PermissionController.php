<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Config;
use Validator;
use App\Http\Database\permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu_permission');
        $this->middleware('permission:btn_permission_add',['only'=>['create','store']]);
        $this->middleware('permission:btn_permission_edit',['only'=>['edit','update']]);
        $this->middleware('permission:btn_permission_delete',['only'=>['destroy']]);
    }

    public function search(Request $request)
    {
        $cari = $request->input('cari');
        $perm = permission::Where('privilegesname','like','%'.$cari.'%')
                ->orWhere('privilegesdesc','like','%'.$cari.'%')
                ->paginate(Config::get('pages'));
        return view('admin.base.permission')->with('permission',$perm);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perm = permission::orderBy('privilegesid','desc')->paginate(Config::get('pages'));
        return view('admin.base.permission')->with('permission',$perm);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.base.permission-add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'desc' => 'required'
        ];
        $v = Validator::make($request->all(),$rules);
        if($v->fails()){
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        $perm = new permission;
        $perm->privilegesname = $request->input('name');
        $perm->privilegesdesc = $request->input('desc');
        $perm->save();
        return redirect('/admin/permission');    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perm = permission::find($id);
        return view('admin.base.permission-edit')->with('perm',$perm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'desc' => 'required'
        ];
        $v = Validator::make($request->all(),$rules);
        if($v->fails()){
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        $perm = permission::find($id);
        $perm->privilegesname = $request->input('name');
        $perm->privilegesdesc = $request->input('desc');
        $perm->save();
        return redirect('/admin/permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perm = permission::find($id)->delete();
        return redirect('/admin/permission');
    }
}
