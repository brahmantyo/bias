<?php namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class privileges extends Model {

	protected $table = 'mprivileges';
	public $primaryKey = 'priviligesid';
	public $timestamps = false;
}
