<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GLController extends Controller
{
    /**
     * Get General Ledger
     *
     * @return Response
     * @author Y.Brahmantyo A.K
     **/
    public function getIndex()
    {
    	return 'General Ledger';
    }
}