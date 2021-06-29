@extends('admin.layouts.app')
@section('title', 'Tambah Data Pengembangan Diri Baru')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('pengembangan.create') }}">
            @csrf

            {{-- Jenis Pengembangan Diri --}}
            <div class="form-group row">
                <label for="jenis_pengdiri" class="col-sm-2 col-form-label">Jenis</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('jenis_pengdiri') is-invalid @enderror"
                        id="jenis_pengdiri" name="jenis_pengdiri" value="{{ old('jenis_pengdiri') }}" required
                        autocomplete="jenis_pengdiri" autofocus placeholder="Masukan Jenis Pengembangan Diri">
                </div>

                @error('jenis_pengdiri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Judul Pengembangan Diri --}}
            <div class="form-group row">
                <label for="judul_pengdiri" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('judul_pengdiri') is-invalid @enderror"
                        id="judul_pengdiri" name="judul_pengdiri" value="{{ old('judul_pengdiri') }}" required
                        autocomplete="judul_pengdiri" autofocus placeholder="Masukan Judul Pengembangan Diri">
                </div>

                @error('judul_pengdiri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Lokasi Pengembangan Diri --}}
            <div class="form-group row">
                <label for="lokasi_pengdiri" class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('lokasi_pengdiri') is-invalid @enderror"
                        id="lokasi_pengdiri" name="lokasi_pengdiri" value="{{ old('lokasi_pengdiri') }}" required
                        autocomplete="lokasi_pengdiri" placeholder="Masukan Lokasi Pengembangan Diri">
                </div>

                @error('lokasi_pengdiri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Periode --}}
            <div class="form-group row">
                <label for="periode_id" class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('periode_id') is-invalid @enderror" id="periode_id"
                        name="periode_id" value="{{ old('periode_id') }}" required autocomplete="periode_id"
                        placeholder="Masukan Periode">
                </div>

                @error('periode_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-user">
                    Tambah
                </button>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
