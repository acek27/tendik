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
                    <h1 class="m-0">Ubah Password</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Beranda</a></li>
                        <li class="breadcrumb-item active">Ubah Password</li>
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
                            <h3 class="card-title">Ubah Password</h3>
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
                            {!! Form::model($data, ['route' => ['reset.update', $data->id], 'method'=> 'put']) !!}
                            <div class="form-group">
                                {{ Form::label('password', 'Perbarui Password', ['class' => 'col-form-label']) }}
                                <div class="input-group">
                                    <div class="input-group-prepend" id="klik_password">
                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <a href="{{route('guru.index')}}" class="btn btn-info"><i
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

    <script>
        $(document).ready(function () {
            const togglePassword = document.querySelector('#klik_password');
            const password = document.querySelector('#password');
            const icon = togglePassword.querySelector('i');

            togglePassword.addEventListener('click', function () {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);

                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            })
        });
    </script>
@endpush
