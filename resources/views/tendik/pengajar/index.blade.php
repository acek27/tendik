@extends('layouts.master')
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Guru</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Daftar Guru</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Guru</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p class="text-secondary">Rekapitulasi Data Guru. <a
                                    href="{{route('export.data')}}" target="_blank">Download <i class="fas fa-download"></i></a></p>
                            <table id="tabel_sekolah" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>No. Peserta</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Status</th>
                                    <th>Jabatan Paruh Waktu</th>
                                    <th>Jabatan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@push('js')
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var dt = $('#tabel_sekolah').DataTable({
                processing: true,
                serverSide: true,
                columnDefs: [{visible: false, targets: 0}],
                ajax: {
                    url: '{{ route('pengajar.data') }}',
                    type: "get",
                },
                columns: [{
                    data: 'id',
                    name: 'id',
                },
                    {
                        data: 'no_peserta',
                        name: 'no_peserta',
                        orderable: false,
                        align: 'center'
                    },
                    {
                        data: 'nama_peserta',
                        name: 'nama_peserta',
                        orderable: false,
                        align: 'center'
                    },
                    {
                        data: 'nip',
                        name: 'nip',
                        orderable: false,
                        align: 'center'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        align: 'center'
                    },
                    {
                        data: 'jabatan_paruh_waktu',
                        name: 'jabatan_paruh_waktu',
                        orderable: false,
                        searchable: false,
                        align: 'center'
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan',
                        orderable: false,
                        searchable: false,
                        align: 'center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        align: 'center'
                    },
                ],
            });
        });
    </script>
@endpush
