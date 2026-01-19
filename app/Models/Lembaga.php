<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembaga extends Model
{
    protected $table = 'lembaga';
    protected $fillable = ['npsn', 'lembaga_dapodik', 'kecamatan'];

    protected $appends = ['lembaga'];

    public function getLembagaAttribute()
    {
        return $this->attributes['lembaga_dapodik'] . ' - ' . $this->attributes['kecamatan'];
    }
}
