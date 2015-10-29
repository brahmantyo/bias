<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table = 'msupplier';
    protected $primaryKey = 'idsupplier';
    public $timestamps = false;
}
