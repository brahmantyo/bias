<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Http\Controllers\Controller;

use App\Http\Database\group;
use App\Http\Database\privileges;
use App\Http\Database\privileges_group;


class PrivilegesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menu_privileges');
    }

    public function getIndex()
    {
        return view('admin.base.privileges');
    }

    /**
     * Get all user groups available
     *
     * @return array
     * @author Y.Brahmantyo. AK
     **/
    public function getGroups()
    {
        $output = group::where('groupid','>',0)->get();
        return json_encode($output);
    }

    /**
     * Get all privileges available for this group
     *
     * @return array
     * @author Y. Brahmantyo. AK
     **/
    public function getPrivileges()
    {
        $output = privileges::all();
        return json_encode($output);
    }

    /**
     * Get all permission of this group
     *
     * @return array
     * @author Y. Brahmantyo. AK
     **/
    public function getPermissions($group)
    {
        $output = privileges_group::select('mprivileges.*')
                        ->leftJoin('mgroup','mgroup.groupid','=','mprivileges_group.groupid')
                        ->leftJoin('mprivileges','mprivileges.privilegesid','=','mprivileges_group.privilegesid')
                        ->where('mprivileges_group.groupid','=',$group)->get();
        return json_encode($output);
    }

    /**
     * Set permissions for this group
     *
     * @return void
     * @author Y. Brahmantyo. AK
     **/
    public function postPermissions()
    {
        $group = Request::get('group');
        $priv = Request::get('priv');

        $permission = privileges_group::where('groupid','=',$group)->delete();
        
        foreach ($priv as $p) {
            $setPriv = new privileges_group;
            $setPriv->groupid = $group;
            $setPriv->privilegesid = $p;
            $setPriv->save();
        }
        $output = 'success';
        return json_encode($output);
    }

}