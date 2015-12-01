<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    protected $table = 'msales';
    protected $primaryKey = 'idsales';
    public $timestamps = false;

    public function scopeDivisi(){
    	return \App\Http\Database\divisi::where('iddivisi',$this->divisi)->first();
    }
    public function div(){
    	return $this->hasOne('App\Http\Database\divisi','iddivisi','divisi');
    }
}
