<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
    protected $table = 'mdivisi';
    protected $primaryKey = 'iddivisi';
    public $timestamps = false;
}
