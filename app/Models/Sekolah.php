<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $casts = [ 'id' => 'integer' ];
}
