@extends('admin.layouts.app')
@section('title', 'Ubah Data Dosen')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('dosen.update', $data[0]->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Username --}}
            <div class="form-group row">
                <label for="user_id" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control @error('user_id') is-invalid @enderror" id="user_id"
                        name="user_id" value="{{ old('user_id', $data[0]->user_id) }}" required readonly>
                </div>

                @error('user_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Kode Dosen --}}
            <div class="form-group row">
                <label for="kode" class="col-sm-2 col-form-label">Kode Dosen</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode"
                        value="{{ old('kode', $data[0]->kode) }}" autocomplete="kode" autofocus>
                </div>

                @error('kode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Nama Dosen --}}
            <div class="form-group row">
                <label for="name_dsn" class="col-sm-2 col-form-label">Nama Dosen</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control @error('name_dsn') is-invalid @enderror" id="name_dsn"
                        name="name_dsn" value="{{ old('name_dsn', $data[0]->name_dsn) }}" autocomplete="name_dsn"
                        autofocus>
                </div>

                @error('name_dsn')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Tempat Lahir --}}
            <div class="form-group row">
                <label for="tmptlahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control @error('tmptlahir') is-invalid @enderror" id="tmptlahir"
                        name="tmptlahir" value="{{ old('tmptlahir', $data[0]->tmptlahir) }}" autocomplete="tmptlahir"
                        autofocus>
                </div>

                @error('tmptlahir')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Tanggal Lahir --}}
            <div class="form-group row">
                <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir"
                        name="tgl_lahir" value="{{ old('tgl_lahir', $data[0]->tgl_lahir) }}" autocomplete="tgl_lahir"
                        autofocus>
                </div>

                @error('tgl_lahir')
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
                        value="{{ old('email', $data[0]->email) }}" autocomplete="email" autofocus>
                </div>

                @error('email')
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
                        name="jja_id" value="{{ old('jja_id', $data[0]->jja_id) }}" required>
                        @foreach ($jja as $item)
                            <option value="{{ $item->id }}" {{ $data[0]->jja_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

                @error('jja_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- No Telepon --}}
            <div class="form-group row">
                <label for="no_telepon" class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon"
                        name="no_telepon" value="{{ old('no_telepon', $data[0]->no_telepon) }}" autocomplete="no_telepon"
                        autofocus>
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
                        name="alamat" autocomplete="alamat" autofocus>{{ old('alamat', $data[0]->alamat) }}</textarea>
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
                        name="picture" value="{{ old('picture', $data[0]->picture) }}" autocomplete="picture" autofocus
                        readonly>
                </div>

                @error('picture')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Status --}}
            {{-- Fitur dimatikan --}}
            {{-- <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-6">
                    <select id="status" class="form-control form-control @error('status') is-invalid @enderror"
                        name="status" value="{{ old('status', $data[0]->status) }}" required>
                        <option value="aktif" {{ $data[0]->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ $data[0]->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
                <a href="{{ route('dosen.index') }}" type="button" class="btn btn-secondary">
                    Back
                </a>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
