@extends('admin.layouts.app')
@section('title', 'Ubah Data Pengabdian Masyarakat')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('pengabdian.update', $pengabdian->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul PKM --}}
            <div class="form-group row">
                <label for="judul_pkm" class="col-sm-2 col-form-label">Judul PKM</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('judul_pkm') is-invalid @enderror" id="judul_pkm"
                        name="judul_pkm" value="{{ old('judul_pkm', $pengabdian->judul_pkm) }}" required
                        autocomplete="judul_pkm" autofocus>
                </div>

                @error('judul_pkm')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Nama Komunitas --}}
            <div class="form-group row">
                <label for="nama_komunitas" class="col-sm-2 col-form-label">Nama Komunitas</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('nama_komunitas') is-invalid @enderror"
                        id="nama_komunitas" name="nama_komunitas"
                        value="{{ old('nama_komunitas', $pengabdian->nama_komunitas) }}" required
                        autocomplete="nama_komunitas" autofocus>
                </div>

                @error('nama_komunitas')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Lokasi PKM --}}
            <div class="form-group row">
                <label for="lokasi_pkm" class="col-sm-2 col-form-label">Lokasi PKM</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('lokasi_pkm') is-invalid @enderror" id="lokasi_pkm"
                        name="lokasi_pkm" value="{{ old('lokasi_pkm', $pengabdian->lokasi_pkm) }}" required
                        autocomplete="lokasi_pkm">
                </div>

                @error('lokasi_pkm')
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
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
                <a href="{{ route('pengabdian.index') }}" type="button" class="btn btn-secondary">
                    Back
                </a>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
