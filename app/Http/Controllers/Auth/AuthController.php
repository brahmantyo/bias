<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Hash;
use Config;
use App\Http\Database\user;
use App\Http\Database\group;
use App\Http\Database\privileges_group;


class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;

	public $redirectPath = '/';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
	public function getLogout()
    {
        $this->auth->logout();
        Session::flush();
        return redirect('/');
    }
	
	public function postLogin(Request $request)
	{
	    $this->validate($request,[
	        'name' => 'required',
	        'password' => 'required',
	    ]);

	    $credentials = $request->only('name', 'password');
	    try {
		    $user = user::where('name','=',$credentials['name'])->firstOrFail();
	    } catch(ModelNotFoundException $e){
		    return redirect('/')
                ->withInput($request->only('name', 'remember'))
                ->withErrors([
                    'name' => 'These credentials do not match our records.',
                ]);
	    }

	    if($user){
	    	session()->regenerate();
	    	Session::set('user',$user);
	    	$group = group::find($user->groupid);
	    	if($group->count()){
	    		Session::set('group',$group);
	    		$privileges = privileges_group::select('p.privilegesid as id','p.privilegesname as name','p.privilegesdesc as desc')
				            ->leftJoin('mprivileges as p','p.privilegesid','=','mprivileges_group.privilegesid')
				            ->where('mprivileges_group.groupid','=',$group->groupid)->get();
				Session::set('privileges',$privileges);
	    	}
	    	
		}
	    if ($this->auth->attempt($credentials, $request->has('remember')))
	    {
    		return redirect('/admin');
	    }
	    return redirect('/')
            ->withInput($request->only('name', 'remember'))
            ->withErrors([
                'password' => 'Password is wrong',
            ]);
        

	}

}
