@extends('layouts.master')
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data Guru</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Edit Data Guru</li>
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
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit Data Guru</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {!! Form::model($data, ['route' => ['pengajar.update', $data->id], 'method'=> 'put']) !!}
                            <div class="form-group">
                                {{ Form::label('nama_peserta', 'Nama Guru', ['class' => 'col-form-label']) }}
                                {{ Form::text('nama_peserta',null,[
                                    'class'=>'form-control',
                                    'id' => 'nama_peserta',
                                    'required' => 'required',
                                    'data-parsley-length' => '[18,18]',
                                    'data-parsley-length-message' => 'Panjang NIP harus 18 angka.',
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('nip', 'NIP', ['class' => 'col-form-label']) }}
                                {{ Form::text('nip',null,[
                                    'class'=>'form-control',
                                    'id' => 'nip',
                                    'required' => 'required',
                                    'data-parsley-length' => '[18,18]',
                                    'data-parsley-length-message' => 'Panjang NIP harus 18 angka.',
                                ]) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('jabatan_paruh_waktu', 'Jabatan Paruh Waktu', ['class' => 'col-form-label']) }}
                                {{ Form::text('jabatan_paruh_waktu',null,[
                                    'class'=>'form-control',
                                    'id' => 'jabatan_paruh_waktu',
                                    'required' => 'required',
                                    'data-parsley-length' => '[18,18]',
                                    'data-parsley-length-message' => 'Panjang NIP harus 18 angka.',
                                ]) }}
                            </div>

                            <div class="form-group">
                                {{ Form::label('sekolah_id', 'Lembaga Dapodik', ['class' => 'col-form-label']) }}
                                {{ Form::select('sekolah_id', $lembaga,null,[
                                       'class'=>'form-control select2bs4',
                                       'id' => 'sekolah_id',
                                       'placeholder' => '-- Pilih Lembaga --',
                                       'required' => 'required']) }}
                            </div>

                            <div class="form-group">
                                <a href="{{route('pengajar.index')}}" class="btn btn-info"><i
                                        class="fas fa-arrow-left"></i> Kembali</a>
                                <input type="submit" value="Simpan Perubahan" class="btn btn-dark">
                            </div>

                            {!! Form::close() !!}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
@push('js')
    <!-- Select2 -->
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
    <script !src="">
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
@endpush
