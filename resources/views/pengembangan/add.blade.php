@extends('admin.layouts.app')
@section('title', 'Tambah Data Pengembangan Diri Baru')
@section('content')
@can('create', App\Models\Pengembangan::class)
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('pengembangan.create') }}">
            @csrf

            {{-- Nama Dosen --}}
            @if (Auth::user()->role_id === 3)
                <div class="form-group row">
                    <label for="dosen_id" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-6 pt-1">
                        <input type="text" name="dosen_id" value="{{ $dosen->id }}" hidden>
                        {{ $dosen->name_dsn }}
                    </div>
                </div>
            @else
                <div class="form-group row">
                    <label for="dosen_id" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-6 pt-1">
                        <select name="dosen_id" id="dosen_id"
                            class="form-control selectpicker @error('periode_id') is-invalid @enderror" data-size="5"
                            data-live-search="true">
                            @foreach ($dosen as $e)
                                <option value="{{ $e->id }}" {{ old('dosen_id') == "$e->id" ? 'selected' : '' }}>
                                    {{ ucwords($e->name_dsn) }}
                                </option>
                            @endforeach
                        </select>

                        @error('dosen_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            @endif

            {{-- Jenis Pengembangan Diri --}}
            <div class="form-group row">
                <label for="jenis_pengdiri_id" class="col-sm-2 col-form-label">Jenis Peng. Diri</label>
                <div class="col-sm-4">
                    <select name="jenis_pengdiri_id" id="jenis_pengdiri_id"
                        class="form-control selectpicker @error('periode_id') is-invalid @enderror" data-size="5"
                        data-live-search="true">
                        @foreach ($jenis_pengdiri as $e)
                            <option value="{{ $e->id }}"
                                {{ old('jenis_pengdiri_id') == "$e->id" ? 'selected' : '' }}>
                                {{ ucwords($e->name_jp) }}
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
                <label for="judul_pengdiri" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
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
                <label for="lokasi_pengdiri" class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control @error('lokasi_pengdiri') is-invalid @enderror"
                        id="lokasi_pengdiri" name="lokasi_pengdiri"
                        autocomplete="lokasi_pengdiri">{{ old('lokasi_pengdiri') }}</textarea>
                </div>

                @error('lokasi_pengdiri')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Periode --}}
            {{-- <div class="form-group row">
                <label for="periode_id" class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-2">
                    <select name="periode_id" id="periode_id" class="form-control selectpicker" data-size="5"
                        data-live-search="true">
                        @foreach ($periode as $d)
                            <option value="{{ $d->id }}"
                                {{ old('periode_id') == "$d->tahun" ? 'selected' : '' }}>
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
            </div> --}}

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
                <a type="button" href="{{ route('pengembangan.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endcan
@endsection
