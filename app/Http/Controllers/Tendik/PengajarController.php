<?php

namespace App\Http\Controllers\Tendik;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Guru;
use App\Models\Lembaga;
use App\Models\Sekolah;
use App\Traits\Resource;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
    use Resource;

    protected $model = Guru::class;
    protected $view = 'tendik.pengajar';
    protected $route = 'pengajar';

    public function __construct()
    {
        $this->middleware('can:administrator');
    }

    public function edit($id)
    {
        $data = $this->model::findOrFail($id);
        $lembaga = Lembaga::all()->pluck('lembaga', 'npsn');
        return view($this->view . '.edit', compact('data', 'lembaga'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->model::findOrFail($id);
        $lembaga = Lembaga::where('npsn', $request->sekolah_id)->first();
        $this->validate($request, $this->model::rulesEdit($data));
        $data->update([
            'nama_peserta' => $request->nama_peserta,
            'nip' => $request->nip,
            'jabatan_paruh_waktu' => $request->jabatan_paruh_waktu,
            'sekolah_id' => $request->sekolah_id,
            'lembaga_dapodik' => $lembaga->lembaga_dapodik,
            'kecamatan' => $lembaga->kecamatan,
        ]);
        return redirect(route($this->route . '.index'));
    }

    public function export_data(Request $request)
    {
        $filename = 'gaji_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $handle = fopen('php://temp', 'r+');

        // BOM UTF-8
        fwrite($handle, "\xEF\xBB\xBF");

        // Header kolom
        fputcsv($handle, [
            'NPSN', 'No Peserta', 'Nama Peserta', 'Status', 'NIP',
            'Lembaga Dapodik', 'Kecamatan', 'Semester', 'Jabatan Paruh Waktu',
            'Jabatan', 'Gaji', 'DB Kepegawaian', 'Tahun'
        ]);

        $data = \App\Models\Gaji::orderBy('tahun', 'desc')->get();

        foreach ($data as $row) {
            fputcsv($handle, [
                "'" . $row->sekolah_id,
                "'" . $row->no_peserta,
                $row->nama_peserta,
                $row->status ==  0? 'Mendapatkan Tunjangan Sertifikasi': 'Tidak Mendapatkan TPG',
                "'" . $row->nip,
                $row->lembaga_dapodik,
                $row->kecamatan,
                $row->semester,
                $row->jabatan_paruh_waktu,
                $row->jabatan,
                $row->gaji,
                $row->db_kepegawaian,
                $row->tahun,
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200, $headers);
    }
}
