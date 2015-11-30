<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class djual extends Model
{
    protected $table = 'djual';
    public $primaryKey = 'idinduk';
    public $timestamps = false;

    public function jual()
    {
    	return $this->belongTo('App\Http\Database\jual','idtrx','idinduk');
    }

    public function barang()
    {
    	return $this->hasOne('App\Http\Database\barang','plu','plu');
    }

    public function div()
    {
        return \App\Http\Database\divisi::find($this->barang->iddivisi);
    }
    public function scopeSatuan()
    {
        return $this->hasOne('App\Http\Database\satuan','idsatuan','satuan');
    }

}
