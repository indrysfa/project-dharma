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
                <label for="jenis_pengdiri_id" class="col-sm-4 col-form-label">Jenis Peng. Diri</label>
                <div class="col-sm-8">
                    <select name="jenis_pengdiri_id" id="jenis_pengdiri_id" class="form-control">
                        @foreach ($jenis_pengdiri as $e)
                            <option value="{{ $e->id }}"
                                {{ old('jenis_pengdiri_id') == "$e->name" ? selected : '' }}>
                                {{ ucwords($e->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @error('jenis_pengdiri_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Judul Pengembangan Diri --}}
            <div class="form-group row">
                <label for="judul_pengdiri" class="col-sm-4 col-form-label">Judul</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('judul_pengdiri') is-invalid @enderror"
                        id="judul_pengdiri" name="judul_pengdiri" value="{{ old('judul_pengdiri') }}"
                        autocomplete="judul_pengdiri" autofocus>
                </div>

                @error('judul_pengdiri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Lokasi Pengembangan Diri --}}
            <div class="form-group row">
                <label for="lokasi_pengdiri" class="col-sm-4 col-form-label">Lokasi</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('lokasi_pengdiri') is-invalid @enderror"
                        id="lokasi_pengdiri" name="lokasi_pengdiri" value="{{ old('lokasi_pengdiri') }}"
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
                <label for="periode_id" class="col-sm-4 col-form-label">Periode</label>
                <div class="col-sm-8">
                    <select name="periode_id" id="periode_id" class="form-control">
                        @foreach ($periode as $d)
                            <option value="{{ $d->id }}" {{ old('periode_id') == "$d->tahun" ? selected : '' }}>
                                {{ $d->tahun . '-' . $d->semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @error('periode_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <a type="button" href="{{ route('pengembangan.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">
                    Tambah
                </button>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
