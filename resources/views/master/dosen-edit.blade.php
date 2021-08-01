@extends('admin.layouts.app')
@section('title', 'Ubah Data Dosen')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="alert alert-info" role="alert">
            Hanya untuk mengubah status, Jika ingin mengubah data silahkan ke menu User
        </div>

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

            {{-- Nama Dosen --}}
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Nama Dosen</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $data[0]->name) }}" autocomplete="name" autofocus readonly>
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
                        value="{{ old('email', $data[0]->email) }}" autocomplete="email" autofocus readonly>
                </div>

                @error('email')
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
                        autofocus readonly>
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
                        autofocus readonly>
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
                    <input type="number" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon"
                        name="no_telepon" value="{{ old('no_telepon', $data[0]->no_telepon) }}" autocomplete="no_telepon"
                        autofocus readonly>
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
                    <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                        value="{{ old('alamat', $data[0]->alamat) }}" readonly autocomplete="alamat" autofocus>
                </div>

                @error('alamat')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Image --}}
            <div class="form-group row">
                <label for="image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                        value="{{ old('image', $data[0]->image) }}" autocomplete="image" autofocus readonly>
                </div>

                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Status --}}
            <div class="form-group row">
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
            </div>

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
