<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class beli extends Model
{
    protected $table = 'beli';
    public $primaryKey = 'idbeli';
    public $timestamps = false;
}
