<?php namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class cabang extends Model {

	protected $table = "mcabang";
	protected $primaryKey = "idcabang";
	public $timestamps = false;
}
