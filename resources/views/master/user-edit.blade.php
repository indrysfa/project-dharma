@extends('admin.layouts.app')
@section('title', 'Edit User Page')
@section('content')
    @can('update', App\Models\User::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            <form class="user" method="POST" action="{{ route('user.update', $user->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Username --}}
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-6 pt-1">
                        {{ $user->username }}
                    </div>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Name --}}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-6">
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

                {{-- Email --}}
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                            value="{{ old('email', $user->email) }}" required autocomplete="email"
                            placeholder="Masukan Email">
                    </div>

                    @error('email')
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
                            name="role_id" value="{{ old('role_id', $user->role_id) }}" required>
                            @foreach ($role as $item)
                                <option value="{{ $item->id }}" {{ $user->role_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name_r }}</option>
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
                            name="tmptlahir" value="{{ old('tmptlahir', $user->tmptlahir) }}" required
                            autocomplete="tmptlahir" autofocus placeholder="Masukan Tempat Lahir">
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
                            name="tgl_lahir" value="{{ old('tgl_lahir', $user->tgl_lahir) }}" required
                            autocomplete="tgl_lahir" autofocus placeholder="Masukan Tanggal Lahir">
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
                            name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}" required
                            autocomplete="no_telepon" autofocus placeholder="Masukan No Telepon">
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
                            placeholder="Masukan Alamat">{{ old('alamat', $user->alamat) }}</textarea>
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
                        <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture"
                            name="picture" value="{{ old('picture', $user->picture) }}">
                        <img style="width: 90px" src="{{ Storage::url('public/image/' . $user->picture) }}">
                    </div>

                    @error('picture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('user.index') }}" type="button" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
