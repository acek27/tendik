<?php

namespace App\Http\Controllers\Tendik;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Guru;
use App\Models\Sekolah;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SekolahController extends Controller
{
    use Resource;

    protected $model = Sekolah::class;
    protected $view = 'tendik.sekolah';
    protected $route = 'sekolah';

    public function __construct()
    {
        $this->middleware('can:administrator');
    }

    public function update(Request $request, $id)
    {
        if ($request->password == '') {
            unset($request['password']);
        }
        $data = Sekolah::findOrFail($id);
        $this->validate($request, $this->model::rulesEdit($data));
        $data->update($request->all());
        return redirect()->route('sekolah.index');
    }

    public function tunjangan(Request $request, $id)
    {
        $guru = guru::where('nip', $id)->first();
        $data = Gaji::where('nip', $id)->get();
        return view($this->view . '.tunjangan', compact('data', 'guru'));
    }

    public function anyData(Request $request)
    {
        return DataTables::of($this->model::where('id', '!=', 1))
            ->addColumn('action', function ($data) {
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '" class=""><i class="fa fa-edit text-secondary"></i></a>';
                $show = '<a href="' . route($this->route . '.show', [$this->route => $data->id]) . '" class=""><i class="fa fa-search text-info"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"><i class="fas fa-trash text-danger"></i></a>';
                return $edit . '&nbsp' . '&nbsp' . $show;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function detail($id)
    {
        return DataTables::of(Guru::where('sekolah_id', $id))
            ->addColumn('action', function ($data) {
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '" class=""><i class="fa fa-edit text-secondary"></i></a>';
                $show = '<a href="' . route($this->route . '.tunjangan', $data->nip) . '" class=""><i class="fa fa-eye text-info"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"><i class="fas fa-trash text-danger"></i></a>';
                return $edit . '&nbsp' . '&nbsp' . $show;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function generate()
    {
        $data = Guru::all();
        foreach ($data as $datum) {
            Gaji::create([
                'sekolah_id' => $datum->sekolah_id,
                'no_peserta' => $datum->no_peserta,
                'nama_peserta' => $datum->nama_peserta,
                'db_kepegawaian' => $datum->status,
                'nip' => $datum->nip,
                'lembaga_dapodik' => $datum->lembaga_dapodik,
                'kecamatan' => $datum->kecamatan,
                'jabatan_paruh_waktu' => $datum->jabatan_paruh_waktu,
                'jabatan' => $datum->jabatan,
                'gaji' => $datum->gaji,
                'tunjangan' => $datum->tunjangan,
                'tanggal' => date('Y-m-d'),
                'tahun' => 2025,
                'file_pernyataan' => null,
                'status' => $datum->tunjangan,
            ]);
        }
        return 'sukses';
    }
}
