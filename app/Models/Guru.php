<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $fillable = [
        'sekolah_id', 'no_peserta', 'nama_peserta', 'status', 'nip', 'lembaga_dapodik', 'kecamatan', 'jabatan_paruh_waktu', 'jabatan', 'gaji', 'tunjangan',
    ];

    public static $rulesCreate = [
        'nama_peserta' => 'required',
        'nip' => 'required|digits:18',
        'jabatan_paruh_waktu' => 'required',

    ];

    public static function rulesEdit(Guru $data)
    {
        return [
            'nama_peserta' => 'required',
            'nip' => 'required|digits:18',
            'jabatan_paruh_waktu' => 'required',
            'sekolah_id' => 'required',
        ];
    }

}
