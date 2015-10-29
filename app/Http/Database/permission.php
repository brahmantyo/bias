<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    protected $table = 'mprivileges';
    protected $primaryKey = 'privilegesid';
    public $timestamps = false;
}
