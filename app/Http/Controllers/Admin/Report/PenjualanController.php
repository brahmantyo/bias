<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PenjualanController extends Controller
{
    /**
     * Get Daftar Penjualan
     *
     * @return Response
     * @author Y.Brahmantyo A.K
     **/
    public function getIndex()
    {
    	return 'Penjualan';
    }
}
