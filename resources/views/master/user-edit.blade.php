@extends('admin.layouts.app')
@section('title', 'Edit User Page')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('user.update') }}">
            @csrf

            {{-- Name --}}
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus
                        placeholder="Masukan Nama Lengkap">
                </div>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Username --}}
            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                        name="username" value="{{ old('username', $user->username) }}" required autocomplete="username" autofocus
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
                <div class="col-sm-10">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                        value="{{ old('email', $user->email) }}" required autocomplete="email" placeholder="Masukan Email">
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
                <div class="col-sm-5">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ old('password', $user->password) }}"
                        name="password" required autocomplete="new-password" placeholder="Masukan Kata Sandi">
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="col-sm-5">
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required
                        autocomplete="new-password" placeholder="Repeat Password">
                </div>
            </div>

            {{-- Role --}}
            <div class="form-group row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <select id="role" class="form-control form-control @error('role') is-invalid @enderror" name="role"
                        value="{{ old('role', $user->role) }}" required>
                        <option value="dosen">Dosen</option>
                        <option value="lc">Language Center</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                @error('role')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Tempat Lahir --}}
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('tmptlahir') is-invalid @enderror" id="tmptlahir"
                        name="tmptlahir" value="{{ old('tmptlahir', $user->tmptlahir) }}" required autocomplete="tmptlahir" autofocus
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
                <div class="col-sm-10">
                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                        name="tgl_lahir" value="{{ old('tgl_lahir', $user->tgl_lahir) }}" required autocomplete="tgl_lahir" autofocus
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
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon"
                        name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}" required autocomplete="no_telepon" autofocus
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
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                        value="{{ old('alamat', $user->alamat) }}" required autocomplete="alamat" autofocus
                        placeholder="Masukan Alamat">
                </div>

                @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input type="number" class="form-control" name="status" value="0" hidden>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-user btn-block">
                    Update
                </button>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
