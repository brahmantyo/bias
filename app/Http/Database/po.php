<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class po extends Model
{
    protected $table = 'po';
    protected $primaryKey = 'idpo';
    public $timestamps = false;

    public function detail()
    {
		return $this->hasMany('\App\Http\Database\dpo','idinduk','idpo');
    }
    public function supp()
    {
    	return $this->hasOne('\App\Http\Database\supplier','idsupp','idsupp');
    }
}
