<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    protected $table = 'msales';
    protected $primaryKey = 'idsales';
    public $timestamps = false;

    public function getDivisi(){
    	return $this->hasOne('App\Http\Database\divisi','iddivisi','divisi');
    }
}
