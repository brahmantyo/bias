<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CashflowController extends Controller
{
    /**
     * Get Cash Flow
     *
     * @return Response
     * @author Y.Brahmantyo A.K
     **/
    public function getIndex()
    {
    	return 'Cash Flow';
    }
}