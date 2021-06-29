@extends('admin.layouts.app')
@section('title', 'Ubah Data Penelitian')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('penelitian.update', $penelitian->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul Penelitian --}}
            <div class="form-group row">
                <label for="judul_penelitian" class="col-sm-2 col-form-label">Judul Penelitian</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('judul_penelitian') is-invalid @enderror"
                        id="judul_penelitian" name="judul_penelitian"
                        value="{{ old('judul_penelitian', $penelitian->judul_penelitian) }}" required
                        autocomplete="judul_penelitian" autofocus>
                </div>

                @error('judul_penelitian')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Status Penelitian --}}
            <div class="form-group row">
                <label for="status_penelitian" class="col-sm-2 col-form-label">Status Penelitian</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('status_penelitian') is-invalid @enderror"
                        id="status_penelitian" name="status_penelitian"
                        value="{{ old('status_penelitian', $penelitian->status_penelitian) }}" required
                        autocomplete="status_penelitian" autofocus>
                </div>

                @error('status_penelitian')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Jumlah Anggota --}}
            <div class="form-group row">
                <label for="jumlah_anggota" class="col-sm-2 col-form-label">Jumlah Anggota</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('jumlah_anggota') is-invalid @enderror"
                        id="jumlah_anggota" name="jumlah_anggota"
                        value="{{ old('jumlah_anggota', $penelitian->jumlah_anggota) }}" required
                        autocomplete="jumlah_anggota">
                </div>

                @error('jumlah_anggota')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Tahun Penelitian --}}
            <div class="form-group row">
                <label for="tahun_penelitian" class="col-sm-2 col-form-label">Tahun Penelitian</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('tahun_penelitian') is-invalid @enderror"
                        id="tahun_penelitian" name="tahun_penelitian"
                        value="{{ old('tahun_penelitian', $penelitian->tahun_penelitian) }}" required
                        autocomplete="tahun_penelitian">
                </div>

                @error('tahun_penelitian')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-user">
                    Update
                </button>
                <a href="{{ route('penelitian.index') }}" type="button" class="btn btn-secondary btn-user">
                    Back
                </a>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
