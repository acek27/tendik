<?php

namespace App\Http\Controllers\Sekolah;

use App\Http\Controllers\Controller;
use App\Models\Gaji;
use App\Models\Guru;
use App\Models\Sekolah;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class GuruController extends Controller
{
    use Resource;

    protected $model = Guru::class;
    protected $view = 'sekolah.guru';
    protected $route = 'guru';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tunjangan(Request $request, $id)
    {
        $guru = guru::where('nip', $id)->first();
        $data = Gaji::where('nip', $id)->get();
        return view($this->view . '.tunjangan', compact('data', 'guru'));
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
}
