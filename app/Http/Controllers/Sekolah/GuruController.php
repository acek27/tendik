<?php

namespace App\Http\Controllers\Sekolah;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Guru;
use App\Models\Sekolah;
use App\Models\User;
use App\Traits\HasUpload;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class GuruController extends Controller
{
    use Resource, HasUpload;

    protected $model = Guru::class;
    protected $view = 'sekolah.guru';
    protected $route = 'guru';

    public function __construct()
    {
        $this->middleware('can:guest');
    }

    public function tunjangan(Request $request, $id)
    {
        $guru = guru::where('nip', $id)->first();
        $data = Gaji::where('nip', $id)->get();
        return view($this->view . '.tunjangan', compact('data', 'guru'));
    }

    public function tunjangan_update(Request $request, $id)
    {
        $data = $this->model::where('nip', $id)->first();
        $gaji = 0;
        $file = null;
        //gaji
        if ($request->status == 0) {
            $gaji = 50000;
            $request->validate([
                'semester' => 'required',
                'status' => 'required',
            ]);
        } else {
            $this->validate($request, Gaji::$rulesCreate);
            $post = $this->hasFile($request->file_pernyataan, 'file_pernyataan');
            if ($data->status === 'R3' || $data->status === 'R3b' || $data->status === 'R3T' || $data->status === 'R2') {
                $gaji = 900000;
                $file = $post;
            } elseif ($data->status === 'R4') {
                $gaji = 750000;
                $file = $post;
            }
        }
        Gaji::updateOrCreate(
        // kondisi pencarian (WHERE)
            [
                'semester' => $request->semester,
                'tahun' => date('Y'),
                'nip' => $data->nip,
            ],
            // data yang di-update / di-insert
            [
                'sekolah_id' => $data->sekolah_id,
                'no_peserta' => $data->no_peserta,
                'nama_peserta' => $data->nama_peserta,
                'db_kepegawaian' => $data->status,
                'lembaga_dapodik' => $data->lembaga_dapodik,
                'kecamatan' => $data->kecamatan,
                'jabatan_paruh_waktu' => $data->jabatan_paruh_waktu,
                'jabatan' => $data->jabatan,
                'tunjangan' => 1,
                'status' => $request->status,
                'tanggal' => date('Y-m-d'),
                'file_pernyataan' => $file,
                'gaji' => $gaji
            ]
        );
        return redirect()->back();
    }


    public function file($id)
    {
        $data = Gaji::findOrFail($id);
        $result = $this->showFile($data->file_pernyataan);
        return $result;
    }

    public function anyData(Request $request)
    {
        return DataTables::of(Guru::where('sekolah_id', Auth::user()->username))
            ->addColumn('action', function ($data) {
                $edit = '<a href="' . route($this->route . '.edit', [$this->route => $data->id]) . '" class=""><i class="fa fa-edit text-secondary"></i></a>';
                $show = '<a href="' . route($this->route . '.tunjangan', $data->nip) . '" class=""><i class="fa fa-eye text-info"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"><i class="fas fa-trash text-danger"></i></a>';
                return $edit . '&nbsp' . '&nbsp' . $show;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }


    //reset
    public function reset()
    {
        $data = User::where('username', Auth::user()->username)->first();
        return view($this->view . '.reset', compact('data'));
    }

    public function reset_update(Request $request, $id)
    {
        $data = User::findOrFail($id);
        $data->update([
            'password' => $request->password
        ]);
        return redirect()->route('guru.index');
    }
}
