@extends('admin.layouts.app')
@section('title', 'Tambah Data Pengabdian Kepada Masyarakat Baru')
@section('content')
    @can('create', App\Models\Pengabdian::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            <form class="user" method="POST" action="{{ route('pengabdian.create') }}">
                @csrf

                {{-- Nama Dosen --}}
                @if (Auth::user()->role_id === 3)
                    <div class="form-group row">
                        <label for="dosen_id" class="col-sm-3 col-form-label">Nama Dosen</label>
                        <div class="col-sm-6 pt-1">
                            <input type="text" name="dosen_id" value="{{ $dosen->id }}" hidden>
                            {{ $dosen->name_dsn }}
                        </div>
                    </div>
                @else
                    <div class="form-group row">
                        <label for="dosen_id" class="col-sm-3 col-form-label">Nama Dosen</label>
                        <div class="col-sm-9">
                            <select name="dosen_id" id="dosen_id" class="form-control selectpicker" data-size="5"
                                data-live-search="true">
                                @foreach ($dosen as $d)
                                    <option value="{{ $d->id }}" {{ old('dosen_id') == "$d->name" ? 'selected' : '' }}>
                                        {{ ucwords($d->name_dsn) }}
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
                @endif

                {{-- Tanggal --}}
                <div class="form-group row">
                    <label for="tgl_pengabdian" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control @error('tgl_pengabdian') is-invalid @enderror"
                            id="tgl_pengabdian" name="tgl_pengabdian" value="{{ old('tgl_pengabdian') }}"
                            autocomplete="tgl_pengabdian" autofocus>
                    </div>

                    @error('tgl_pengabdian')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>


                {{-- Judul PKM --}}
                <div class="form-group row">
                    <label for="judul_pkm" class="col-sm-3 col-form-label">Judul PKM</label>
                    <div class="col-sm-9">
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
                    <label for="nama_komunitas" class="col-sm-3 col-form-label">Nama Komunitas</label>
                    <div class="col-sm-9">
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
                    <label for="lokasi_pkm" class="col-sm-3 col-form-label">Lokasi PKM</label>
                    <div class="col-sm-9">
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
                {{-- <div class="form-group row">
                <label for="periode_id" class="col-sm-3 col-form-label">Periode</label>
                <div class="col-sm-3">
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

                {{-- Status PKM --}}
                {{-- <div class="form-group row">
                    <label for="status_id" class="col-sm-3 col-form-label">Status PKM</label>
                    <div class="col-sm-2">
                        <select name="status_id" id="status_id" class="form-control selectpicker">
                            @foreach ($status as $d)
                                <option value="{{ $d->id }}" {{ old('status_id') == "$d->name" ? selected : '' }}>
                                    {{ ucwords($d->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @error('status_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> --}}

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
