<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class dpo extends Model
{
    protected $table = 'dpo';
    public $primaryKey = 'idinduk';
    public $timestamps = false;
}
