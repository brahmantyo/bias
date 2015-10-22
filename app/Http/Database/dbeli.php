<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class dbeli extends Model
{
    protected $table = 'dbeli';
    public $primaryKey = 'idinduk';
    public $timestamps = false;
}
