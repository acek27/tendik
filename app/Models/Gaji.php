<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    protected $table = 'gaji';
    protected $fillable = [
        'sekolah_id', 'no_peserta', 'nama_peserta', 'status', 'nip', 'lembaga_dapodik', 'kecamatan','semester',
        'jabatan_paruh_waktu', 'jabatan', 'gaji', 'tunjangan', 'db_kepegawaian', 'tanggal', 'tahun', 'file_pernyataan'
    ];
    protected $attributes = [
        'file_pernyataan' => null,
    ];
    public static $rulesCreate = [
        'file_pernyataan' => 'required|file|mimes:pdf|max:2048',
        'semester' => 'required',
        'status' => 'required',
    ];

    public function getBesaranGajiAttribute()
    {
        $gaji = 0;
        if ($this->status == 0) {
            $gaji = 50000;
        } else {
            if ($this->db_kepegawaian === 'R3' || $this->db_kepegawaian === 'R3b' || $this->db_kepegawaian === 'R3T' || $this->db_kepegawaian === 'R2') {
                $gaji = 900000;
            } elseif ($this->db_kepegawaian === 'R4') {
                $gaji = 750000;
            }
        }
        return 'Rp ' . number_format($gaji, 0, ',', '.');
    }
}
