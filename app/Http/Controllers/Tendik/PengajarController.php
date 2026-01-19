<?php

namespace App\Http\Controllers\Tendik;

use App\Http\Controllers\Controller;
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
        $lembaga = Lembaga::all()->pluck('lembaga', 'id');
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
}
