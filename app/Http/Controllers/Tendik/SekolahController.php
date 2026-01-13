<?php

namespace App\Http\Controllers\Tendik;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Sekolah;
use App\Traits\Resource;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SekolahController extends Controller
{
    use Resource;

    protected $model = Sekolah::class;
    protected $view = 'sekolah';
    protected $route = 'sekolah';

    public function __construct()
    {
        $this->middleware('can:crud_sekolah');
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
                $show = '<a href="' . route($this->route . '.show', [$this->route => $data->id]) . '" class=""><i class="fa fa-search text-primary"></i></a>';
                $del = '<a href="#" data-id="' . $data->id . '" class="hapus-data"><i class="fas fa-trash text-danger"></i></a>';
                return $edit . '&nbsp' ;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
}
