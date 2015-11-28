<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class jual extends Model
{
    protected $table = 'jual';
    public $primaryKey = 'idtrx';
    public $timestamps = false;

    public function konsumen()
    {
    	return $this->hasOne('App\Http\Database\konsumen','idkonsumen','idkons');
    }

    public function sales()
    {
        return $this->hasOne('App\Http\Database\sales','idsales','idsales');
    }

    public function getStatus()
    {
    	switch($this->status)
    	{
    		case '1' : return 'Valid'; break;
    		default: return 'Entry';
    	}
    	
    }

    public function detail()
    {
        return $this->hasMany('App\Http\Database\djual','idinduk','idtrx');
    }

    public function getTotalQty()
    {
        return $this->hasMany('App\Http\Database\djual','idinduk','idtrx')->sum('qty');
    }
}
