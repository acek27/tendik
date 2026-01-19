@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Starter Page</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-10">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-user"></i> Data Lengkap.
                                    <small class="float-right text-sm">Tanggal hari
                                        ini: {{\Carbon\Carbon::now()->translatedFormat('d F Y')}}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Identitas
                                <address>
                                    <strong>{{$guru->nama_peserta}}</strong><br>
                                    NIP. {{$guru->nip}}<br>

                                    Status Kepegawaian: <strong>{{$guru->status}}</strong><br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Lembaga Dapodik
                                <address>
                                    <strong>{{$guru->lembaga_dapodik}}</strong><br>
                                    {{$guru->kecamatan}}<br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Jabatan<br>
                                <b>{{$guru->jabatan}}</b><br>
                                {{$guru->jabatan_paruh_waktu}}
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tahun</th>
                                        <th>Berkas</th>
                                        <th>Status</th>
                                        <th>Gaji</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($urut = 1)
                                    @for($i = date('Y');$i>=2026;$i--)
                                        @php($datum = $data->where('tahun', $i)->first())

                                        @if($datum)
                                            <tr>
                                                <td>{{$urut}}</td>
                                                <td>{{$i}}</td>
                                                <td>{{$datum->file_pernyataan == null ? '-' : 'Download'}}</td>
                                                <td>{{$datum->status == 0? 'Tidak Menerima Tunjangan': 'Menerima Tunjangan'}}</td>
                                                <td>{{$datum->besaran_gaji}}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{$urut}}</td>
                                                <td>{{$i}}</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                            </tr>
                                        @endif
                                        @php($urut++)
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="{{route('sekolah.index')}}" class="btn btn-info"><i
                                        class="fas fa-arrow-left"></i> Kembali</a>
                                {{--                                <button type="button" class="btn btn-success float-right"><i--}}
                                {{--                                        class="far fa-credit-card"></i> Submit--}}
                                {{--                                    Payment--}}
                                {{--                                </button>--}}

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->


@endsection
