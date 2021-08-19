@extends('admin.layouts.app')
@section('title', 'Tambah Data Pengajaran Baru')
@section('content')
    @can('create', App\Models\Pengajaran::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            <form class="user" method="POST" action="{{ route('pengajaran.create') }}">
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
                        <div class="col-sm-10">
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

                {{-- Kode MK --}}
                <div class="form-group row">
                    <label for="kode_mk" class="col-sm-2 col-form-label">Kode MK</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control @error('kode_mk') is-invalid @enderror" id="kode_mk"
                            name="kode_mk" value="{{ old('kode_mk') }}" autocomplete="kode_mk" autofocus
                            placeholder="Masukan Kode Mata Kuliah">
                    </div>

                    @error('kode_mk')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Nama MK --}}
                <div class="form-group row">
                    <label for="nama_mk" class="col-sm-2 col-form-label">Nama MK</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('nama_mk') is-invalid @enderror" id="nama_mk"
                            name="nama_mk" value="{{ old('nama_mk') }}" autocomplete="nama_mk" autofocus
                            placeholder="Masukan Nama Mata Kuliah">
                    </div>

                    @error('nama_mk')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Kelas --}}
                <div class="form-group row">
                    <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                    <div class="col-sm-10">
                        <input type="kelas" class="form-control @error('kelas') is-invalid @enderror" id="kelas" name="kelas"
                            value="{{ old('kelas') }}" autocomplete="kelas" placeholder="Masukan kelas">
                    </div>

                    @error('kelas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- SKS --}}
                <div class="form-group row">
                    <label for="sks" class="col-sm-2 col-form-label">SKS</label>
                    <div class="col-sm-10">
                        <input type="sks" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks"
                            value="{{ old('sks') }}" autocomplete="sks" placeholder="Masukan SKS">
                    </div>


                    @error('sks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Periode --}}
                {{-- <div class="form-group row">
                <label for="periode_id" class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-10">
                    <select name="periode_id" id="periode_id" class="selectpicker" data-size="5"
                        data-live-search="true">
                        @foreach ($data as $d)
                            <option value="{{ $d->id }}"
                                {{ old('periode_id') == "$d->tahun" ? selected : '' }}>
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
                        Tambah
                    </button>
                    <a type="button" href="{{ route('pengajaran.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
