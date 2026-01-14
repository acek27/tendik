<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $casts = ['id' => 'integer'];
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'kecamatan'
    ];
    public static $rulesCreate = [
        'name' => 'required',
        'username' => 'required|unique:users',
        'email' => 'required|unique:users|email',
        'password' => 'required',
        'kecamatan' => 'required',
    ];

    public static function rulesEdit(Sekolah $data)
    {
        return [
            'name' => 'required',
            'kecamatan' => 'required',
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
