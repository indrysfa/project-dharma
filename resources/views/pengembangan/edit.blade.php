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
                <label for="jenis_pengdiri_id" class="col-sm-2 col-form-label">Jenis Peng. Diri</label>
                <div class="col-sm-10">
                    {{-- <select name="jenis_pengdiri_id" id="jenis_pengdiri_id" class="form-control">
                        @foreach ($jenis_pengdiri as $e)
                            <option value="{{ $e->id }}"
                                {{ old('jenis_pengdiri_id') == "$e->name" ? selected : '' }}>
                                {{ ucwords($e->name) }}
                            </option>
                        @endforeach
                    </select> --}}

                    <select name="jenis_pengdiri_id" id="jenis_pengdiri_id" class="form-control">
                        @foreach ($jenis_pengdiri as $d)
                            <option value="{{ $d->id }}"
                                {{ old('jenis_pengdiri_id') == "$d->name" ? selected : '' }}>
                                {{ $d->name }}
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
                    <select name="periode_id" id="periode_id" class="form-control">
                        @foreach ($periode as $d)
                            <option value="{{ $d->id }}" {{ old('periode_id') == "$d->id" ? selected : '' }}>
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
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
                <a href="{{ route('pengembangan.index') }}" type="button" class="btn btn-secondary">
                    Back
                </a>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
