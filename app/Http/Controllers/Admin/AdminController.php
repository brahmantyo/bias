<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Database\jual;
use Carbon\Carbon;
use App\Helpers;

class AdminController extends Controller
{
    public function getCountKonsumens()
    {
    	 return jual::where('status',1)->distinct('idkons')->count('idkons');
    }

    public function getLastMonthSales()
    {
    	$data['num']= jual::where('tgl', '>=', Carbon::now()->subMonth()->format('Y-m-d'))
    		->where('status',1)
    		->sum('totnetto');
    	$data['num']= Helpers::currency($data['num'],0,'id');
    	$data['tgl1']=Carbon::parse('First day of this month')->format('Y-m-d');
    	$data['tgl1']=Carbon::now()->subMonth()->format('Y-m-d');
    	$data['tgl2']=Carbon::now()->format('Y-m-d');
    	return $data;
    }
    public function index()
    {
    	$kon = $this->getCountKonsumens();
    	$lms = $this->getLastMonthSales();
    	return view('admin.index')->with('kon',$kon)->with('lms',$lms);
    }
}