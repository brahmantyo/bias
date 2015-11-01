<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class dbeli extends Model
{
    protected $table = 'dbeli';
    public $primaryKey = 'idinduk';
    public $timestamps = false;

    public function getdivisi()
    {
        return $this->hasOne('App\Http\Database\divisi','iddivisi','divisi');
    }    
}
