<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class dpo extends Model
{
    protected $table = 'dpo';
    public $primaryKey = 'idinduk';
    public $timestamps = false;

    public function barang()
    {
    	return $this->hasOne('\App\Http\Database\barang','plu','plu');
    }
}
