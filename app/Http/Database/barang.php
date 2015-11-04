<?php

namespace App\Http\Database;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = 'mbarang';
    protected $primaryKey = 'idbarang';
    public $timestamps = false;
}
