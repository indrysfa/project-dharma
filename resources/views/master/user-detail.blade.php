@extends('admin.layouts.app')
@section('title', 'Halaman Detail User')
@section('content')
    @can('view', App\Models\User::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            <form class="form-horizontal">
                <div class="card-body row">
                    <div class="col-sm-4">
                        <div class="col-sm-8 pt-1">
                            @if ($user->picture == '')
                                <img class="img-profile rounded-circle"
                                    src="{{ asset('assets/sb-admin2/img/undraw_profile.svg') }}">
                            @else
                                <img src="{{ Storage::url('public/image/' . $user->picture) }}" alt="gallery"
                                    class="img-responsive" width="180">
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label"><b>Name</b></label>
                            <div class="col-sm-8 pt-1">
                                {{ $user->name }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-sm-4 col-form-label"><b>Username</b></label>
                            <div class="col-sm-8 pt-1">
                                {{ $user->username }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label"><b>Email</b></label>
                            <div class="col-sm-8 pt-1">
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-sm-4 col-form-label"><b>Role</b></label>
                            <div class="col-sm-8 pt-1">
                                {{ $user->m_role->name_r }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tmptlahir" class="col-sm-4 col-form-label"><b>Tempat Lahir</b></label>
                            <div class="col-sm-8 pt-1">
                                {{ $user->tmptlahir }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_telepon" class="col-sm-4 col-form-label"><b>No Telepon</b></label>
                            <div class="col-sm-8 pt-1">
                                {{ $user->no_telepon }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-4 col-form-label"><b>Alamat</b></label>
                            <div class="col-sm-8 pt-1">
                                {{ $user->alamat }}
                            </div>
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
    @endcan
@endsection
