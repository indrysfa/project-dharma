@extends('admin.layouts.app')
@section('title', 'Tambah Data Penelitian Baru')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('penelitian.create') }}">
            @csrf

            {{-- Judul Penelitian --}}
            <div class="form-group row">
                <label for="judul_penelitian" class="col-sm-4 col-form-label">Judul Penelitian</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('judul_penelitian') is-invalid @enderror"
                        id="judul_penelitian" name="judul_penelitian" value="{{ old('judul_penelitian') }}"
                        autocomplete="judul_penelitian" autofocus placeholder="Masukan Judul Penelitian">
                </div>

                @error('judul_penelitian')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Status Penelitian --}}
            <div class="form-group row">
                <label for="status_id" class="col-sm-4 col-form-label">Status Penelitian</label>
                <div class="col-sm-8">
                    <select name="status_id" id="status_id" class="form-control">
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
            </div>

            {{-- Jumlah Anggota --}}
            <div class="form-group row">
                <label for="jumlah_anggota" class="col-sm-4 col-form-label">Jumlah Anggota</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control @error('jumlah_anggota') is-invalid @enderror"
                        id="jumlah_anggota" name="jumlah_anggota" value="{{ old('jumlah_anggota') }}"
                        autocomplete="jumlah_anggota" placeholder="Masukan Jumlah Anggota">
                </div>

                @error('jumlah_anggota')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Tahun Penelitian --}}
            <div class="form-group row">
                <label for="periode_id" class="col-sm-4 col-form-label">Tahun Penelitian</label>
                <div class="col-sm-8">
                    <select name="periode_id" id="periode_id" class="form-control">
                        @foreach ($periode as $d)
                            <option value="{{ $d->id }}" {{ old('periode_id') == "$d->tahun" ? selected : '' }}>
                                {{ $d->tahun }}
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
                <a type="button" href="{{ route('penelitian.index') }}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary">
                    Tambah
                </button>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
