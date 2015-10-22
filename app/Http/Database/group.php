<?php namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class group extends Model {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'mgroup';
	protected $primaryKey = "groupid";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['groupname', 'parent', 'status'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
}