<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PiutangController extends Controller
{
    /**
     * Get Daftar Piutang
     *
     * @return Response
     * @author Y.Brahmantyo A.K
     **/
    public function getIndex()
    {
    	return 'Daftar Piutang';
    }
}
