<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Session;
use App\Http\Database\privileges_group as privileges_group;
use App\Http\Database\privileges;


class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        if((Session::get('group')->groupid < 0)||$this->checkPermission($permission)){
            return $next($request);
        } else {
            $privileges = privileges::where('privilegesname','=',$permission)->first();
            if($request->ajax()){
                return response('Unauthorized.', 401);
            }else{
                return response()->view('errors.401',['error'=>$privileges->privilegesdesc]);
            }
        }
    }

    public function checkPermission($perm)
    {
        $privileges = privileges_group::select('p.privilegesid as id','p.privilegesname as name','p.privilegesdesc as desc')
            ->leftJoin('mprivileges as p','p.privilegesid','=','mprivileges_group.privilegesid')
            ->where('mprivileges_group.groupid','=',\Session::get('group')->groupid)
            ->where('p.privilegesname','like','%'.$perm.'%')->get();
        
        if($privileges->count()){
            return true;
        }
        return false;
    }

}
