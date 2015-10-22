<?php namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;
use App\Http\Database\muser as User;
use App\Http\Database\mkota as Kota;

class konsumen extends Model {

	//
	protected $table='mkonsumen';
	protected $primaryKey = 'idkonsumen';
	public $timestamps = false;
	protected $hidden = ['syn'];
	public function user()
	{
		return $this->belongsTo(User,'iduser');
	}
	public function dtkota()
	{
		return $this->belongsTo(Kota,'kota','idkota');
	}
}
