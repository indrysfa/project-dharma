@extends('admin.layouts.app')
@section('title', 'Add New User Page')
@section('content')
    @can('create', App\Models\User::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            <form class="user" method="POST" action="{{ route('user.create') }}" enctype="multipart/form-data">
                @csrf

                {{-- Name --}}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Masukan Nama Lengkap">
                    </div>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- JJA --}}
                <div class="form-group row">
                    <label for="jja_id" class="col-sm-2 col-form-label">JJA</label>
                    <div class="col-sm-6">
                        <select id="jja_id" class="form-control form-control @error('jja_id') is-invalid @enderror"
                            name="jja_id" value="{{ old('jja_id') }}">
                            @foreach ($jja as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('jja_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                            name="username" value="{{ old('username') }}" autocomplete="username" autofocus
                            placeholder="Masukan Username">
                    </div>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            value="{{ old('email') }}" autocomplete="email" placeholder="Masukan Email">
                    </div>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password" autocomplete="password" placeholder="Masukan Kata Sandi">
                    </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="form-group row">
                    <label for="role_id" class="col-sm-2 col-form-label">Role</label>
                    <div class="col-sm-6">
                        <select id="role_id" class="form-control form-control @error('role_id') is-invalid @enderror"
                            name="role_id" value="{{ old('role_id') }}">
                            @foreach ($data as $item)
                                <option value="{{ $item->id }}">{{ $item->name_r }}</option>
                            @endforeach
                        </select>
                    </div>

                    @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Tempat Lahir --}}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Tempat Lahir</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('tmptlahir') is-invalid @enderror" id="tmptlahir"
                            name="tmptlahir" value="{{ old('tmptlahir') }}" autocomplete="tmptlahir" autofocus
                            placeholder="Masukan Tempat Lahir">
                    </div>

                    @error('tmptlahir')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Tgl Lahir --}}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Tgl Lahir</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                            name="tgl_lahir" value="{{ old('tgl_lahir') }}" autocomplete="tgl_lahir" autofocus
                            placeholder="Masukan Tanggal Lahir">
                    </div>

                    @error('tgl_lahir')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- No Telepon --}}
                <div class="form-group row">
                    <label for="no_telepon" class="col-sm-2 col-form-label">No Telepon</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon"
                            name="no_telepon" value="{{ old('no_telepon') }}" autocomplete="no_telepon" autofocus
                            placeholder="Masukan No Telepon">
                    </div>

                    @error('no_telepon')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="form-group row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-6">
                        <textarea type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                            name="alamat" autocomplete="alamat" autofocus
                            placeholder="Masukan Alamat">{{ old('alamat') }}</textarea>
                    </div>

                    @error('alamat')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Image --}}
                <div class="form-group row">
                    <label for="picture" class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-6">
                        <input type="file" class="form-control @error('picture') is-invalid @enderror" name="picture"
                            value="{{ old('picture') }}">
                    </div>

                    @error('picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                    <a type="button" href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
