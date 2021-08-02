@extends('admin.layouts.app')
@section('title', 'Tambah Data Pengabdian Masyarakat Baru')
@section('content')
    @can('create', App\Models\Pengabdian::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            <form class="user" method="POST" action="{{ route('pengabdian.create') }}">
                @csrf

                {{-- Nama Dosen --}}
                <div class="form-group row">
                    <label for="dosen_id" class="col-sm-4 col-form-label">Nama Dosen</label>
                    <div class="col-sm-8">
                        <select name="dosen_id" id="dosen_id" class="form-control selectpicker" data-size="5"
                            data-live-search="true">
                            @foreach ($dosen as $d)
                                <option value="{{ $d->id }}" {{ old('dosen_id') == "$d->name" ? 'selected' : '' }}>
                                    {{ ucwords($d->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @error('dosen_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Judul PKM --}}
                <div class="form-group row">
                    <label for="judul_pkm" class="col-sm-4 col-form-label">Judul PKM</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('judul_pkm') is-invalid @enderror" id="judul_pkm"
                            name="judul_pkm" value="{{ old('judul_pkm') }}" autocomplete="judul_pkm" autofocus
                            placeholder="Masukan Judul PKM">
                    </div>

                    @error('judul_pkm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Nama Komunitas --}}
                <div class="form-group row">
                    <label for="nama_komunitas" class="col-sm-4 col-form-label">Nama Komunitas</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control @error('nama_komunitas') is-invalid @enderror"
                            id="nama_komunitas" name="nama_komunitas" value="{{ old('nama_komunitas') }}"
                            autocomplete="nama_komunitas" autofocus placeholder="Masukan Nama Komunitas">
                    </div>

                    @error('nama_komunitas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Lokasi PKM --}}
                <div class="form-group row">
                    <label for="lokasi_pkm" class="col-sm-4 col-form-label">Lokasi PKM</label>
                    <div class="col-sm-8">
                        <textarea type="text" class="form-control @error('lokasi_pkm') is-invalid @enderror" id="lokasi_pkm"
                            name="lokasi_pkm" autocomplete="lokasi_pkm"
                            placeholder="Masukan Lokasi PKM">{{ old('lokasi_pkm') }}</textarea>
                    </div>

                    @error('lokasi_pkm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Periode --}}
                <div class="form-group row">
                    <label for="periode_id" class="col-sm-4 col-form-label">Periode</label>
                    <div class="col-sm-4">
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
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Tambah
                    </button>
                    <a type="button" href="{{ route('pengabdian.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
