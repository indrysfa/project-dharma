@extends('admin.layouts.app')
@section('title', 'Halaman Detail User')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="form-horizontal">
            <div class="card-body">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                         {{ $user->name }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        {{ $user->username }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        {{ $user->email }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-10">
                        <pre>{{ $user->role }}</pre>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tmptlahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-10">
                        {{ $user->tmptlahir }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_telepon" class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-10">
                        {{ $user->no_telepon }}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        {{ $user->alamat }}
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a class="btn btn-secondary" style="color: #060930" href="{{ route('user.index') }}">Back</a>
            </div>
            <!-- /.card-footer -->
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
