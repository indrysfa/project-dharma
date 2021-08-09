@extends('admin.layouts.app')
@section('title', 'Halaman Detail Dosen')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="form-horizontal">
            <div class="card-body row">
                <div class="col-sm-4">
                    <div class="col-sm-5 pt-1">
                        @if ($dosen->picture == '')
                            <img class="img-profile rounded-circle"
                                src="{{ asset('assets/sb-admin2/img/undraw_profile.svg') }}">
                        @else
                            <img src="{{ Storage::url('public/image/' . $dosen->picture) }}" alt="gallery"
                                class="img-responsive" width="180">
                        @endif
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group row">
                        <label for="name_dsn" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-5 pt-1">
                            {{ $dosen->name_dsn }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-5 pt-1">
                            {{ $dosen->user_id }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-5 pt-1">
                            {{ $dosen->email }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tmptlahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-5 pt-1">
                            {{ $dosen->tmptlahir }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_telepon" class="col-sm-2 col-form-label">No Telepon</label>
                        <div class="col-sm-5 pt-1">
                            {{ $dosen->no_telepon }}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-5 pt-1">
                            {{ $dosen->alamat }}
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a class="btn btn-secondary" style="color: #060930" href="{{ route('dosen.index') }}">Back</a>
            </div>
            <!-- /.card-footer -->
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
