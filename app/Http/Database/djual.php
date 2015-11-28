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
    	return $this->hasMany('App\Http\Database\barang','plu','plu');
    }

    public function getDivisi()
    {
        return $this->hasOne('App\Http\Database\divisi',$this->barang->divisi,'divisi');
    }
    public function getSatuan()
    {
        return $this->hasOne('App\Http\Database\satuan','idsatuan','satuan');
    }

}
