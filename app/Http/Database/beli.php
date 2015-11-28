<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class beli extends Model
{
    protected $table = 'beli';
    public $primaryKey = 'idbeli';
    public $timestamps = false;

    public function supplier()
    {
    	return $this->hasOne('App\Http\Database\supplier','idsupp','idsupp');
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
        return $this->hasMany('App\Http\Database\dbeli','idinduk','idbeli');
    }
}
