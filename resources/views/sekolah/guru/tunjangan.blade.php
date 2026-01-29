@extends('layouts.master')
@push('css')
    <style>
        .parsley-errors-list li {
            color: #f96e5b !important;
        }
    </style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Status Penerimaan Tunjangan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Status Penerimaan Tunjangan</li>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tahun</th>
                                        <th>Berkas</th>
                                        <th>Status</th>
                                        <th>Semester</th>
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
                                                <td>
                                                    @if($datum->file_pernyataan == null)
                                                        {{'-'}}
                                                    @else
                                                        <a href="{{route('file.pernyataan', $datum->id)}}"
                                                           target="_blank"><i class="fas fa-download"></i></a>
                                                    @endif
                                                </td>
                                                <td>{{$datum->status == 0? 'Mendapatkan Tunjangan Sertifikasi': 'Tidak Mendapatkan TPG'}}</td>
                                                <td>{{$datum->semester == 1 ? '1 (Satu)' : '2 (Dua)'}}</td>
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
                                <a href="{{route('guru.index')}}" class="btn btn-info"><i
                                        class="fas fa-arrow-left"></i> Kembali</a>
                                {{--                                <button type="button" class="btn btn-success float-right"><i--}}
                                {{--                                        class="far fa-credit-card"></i> Submit--}}
                                {{--                                    Payment--}}
                                {{--                                </button>--}}
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;"
                                        data-toggle="modal" data-target="#modal-tunjangan">
                                    <i class="fas fa-upload"></i> Buat Usulan
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <div class="modal fade" id="modal-tunjangan" tabindex="-1"
         role="dialog"
         data-backdrop="static"
         data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Buat Pengusulan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::model($guru, ['route' => ['tunjangan.update', $guru->nip], 'method'=> 'put', 'files' => true]) !!}
                <div class="modal-body">

                    <div class="form-group">
                        {{ Form::label('nama_peserta', 'Nama Guru', ['class' => 'col-form-label']) }}
                        {{ Form::text('nama_peserta',null,[
                            'class'=>'form-control',
                            'id' => 'nama_peserta',
                            'disabled' => 'disabled',
                            'readonly' => 'readonly',
                        ]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('nip', 'NIP', ['class' => 'col-form-label']) }}
                        {{ Form::text('nip',null,[
                            'class'=>'form-control',
                            'id' => 'nip',
                            'disabled' => 'disabled',
                        ]) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label('jabatan_paruh_waktu', 'Jabatan Paruh Waktu', ['class' => 'col-form-label']) }}
                        {{ Form::text('jabatan_paruh_waktu',null,[
                            'class'=>'form-control',
                            'id' => 'jabatan_paruh_waktu',
                            'disabled' => 'disabled',
                            'readonly' => 'readonly',
                        ]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('status', 'Status Gaji', ['class' => 'col-form-label']) }}
                        {{ Form::select('status', ['0' => 'Mendapatkan Tunjangan Sertifikasi', '1' => 'Tidak Mendapatkan TPG'], null, [
                        'placeholder' => 'Pilih Status...',
                         'class'=>'form-control',
                         'id' => 'status',
                         'required' => 'required',
                        ])}}
                    </div>
                    <div class="form-group" id="file">
                        <p class="text-danger text-bold">Template Usulan Tidak Akan Menerima Sertifikasi. <a
                                href="{{asset('berkas/format_usulan.docx')}}">Download <i class="fas fa-download"></i></a></p>
                        <label for="file_pernyataan" class="col-form-label">Unggah Surat Pernyataan <span
                                class="text-danger">(Maksimal 2MB)</span></label>

                        {{ Form::file('file_pernyataan', [
                          'class' => 'form-control',
                          'id' => 'file_pernyataan',
                          'required' => 'required',
                          'accept' => 'application/pdf',
                          'data-parsley-filemaxsize-message' => 'File maksimal 2MB',
                          'data-parsley-filemaxsize' => '2',
                          'data-allowed-file-extensions' => 'pdf',
                      ]) }}
                    </div>
                    <div class="form-group" id>
                        {{ Form::label('semester', 'Semester', ['class' => 'col-form-label']) }}
                        {{ Form::select('semester', ['1' => 'Semester 1'], null, [
                        'placeholder' => 'Pilih Semester...',
                         'class'=>'form-control',
                         'id' => 'semester',
                         'required' => 'required',
                        ])}}
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection
@push('js')
    <!-- Parsley js -->
    <script type="module" src="{{asset('plugins/parsleyjs/id.js')}}"></script>
    <script src="{{asset('plugins/parsleyjs/parsley.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('form').parsley();

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            function toggleDiv() {
                let status = $('#status').val();

                if (status === '1') {
                    $('#file').show();
                    $('#file_pernyataan')
                        .prop('disabled', false)
                        .prop('required', true)
                        .attr('data-parsley-required', 'true');
                } else if (status === '0') {
                    $('#file').hide();
                    $('#file_pernyataan')
                        .prop('disabled', true)
                        .prop('required', false)
                        .removeAttr('data-parsley-required')
                        .val('');
                } else {
                    $('#file').hide();
                    $('#file_pernyataan')
                        .prop('disabled', true)
                        .prop('required', false)
                        .removeAttr('data-parsley-required')
                        .val('');
                }
            }

            // saat select berubah
            $('#status').on('change', function () {
                toggleDiv();
            });

            // saat load halaman (edit form)
            toggleDiv();
        });
    </script>
@endpush
