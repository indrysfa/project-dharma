@extends('admin.layouts.app')
@section('title', 'Ubah Data Pengembangan Diri')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('pengembangan.update', $pengembangan->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Jenis --}}
            <div class="form-group row">
                <label for="jenis_pengdiri" class="col-sm-2 col-form-label">Jenis</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('jenis_pengdiri') is-invalid @enderror"
                        id="jenis_pengdiri" name="jenis_pengdiri"
                        value="{{ old('jenis_pengdiri', $pengembangan->jenis_pengdiri) }}" required
                        autocomplete="jenis_pengdiri" autofocus>
                </div>

                @error('jenis_pengdiri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Judul --}}
            <div class="form-group row">
                <label for="judul_pengdiri" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('judul_pengdiri') is-invalid @enderror"
                        id="judul_pengdiri" name="judul_pengdiri"
                        value="{{ old('judul_pengdiri', $pengembangan->judul_pengdiri) }}" required
                        autocomplete="judul_pengdiri" autofocus>
                </div>

                @error('judul_pengdiri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Lokasi --}}
            <div class="form-group row">
                <label for="lokasi_pengdiri" class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('lokasi_pengdiri') is-invalid @enderror"
                        id="lokasi_pengdiri" name="lokasi_pengdiri"
                        value="{{ old('lokasi_pengdiri', $pengembangan->lokasi_pengdiri) }}" required
                        autocomplete="lokasi_pengdiri">
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
                        name="periode_id" value="{{ old('periode_id', $pengembangan->periode_id) }}" required
                        autocomplete="periode_id">
                </div>

                @error('periode_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-user">
                    Update
                </button>
                <a href="{{ route('pengembangan.index') }}" type="button" class="btn btn-secondary btn-user">
                    Back
                </a>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
