@extends('admin.layouts.app')
@section('title', 'Ubah Data Penelitian')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('penelitian.update', $penelitian->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Judul Penelitian --}}
            <div class="form-group row">
                <label for="judul_penelitian" class="col-sm-4 col-form-label">Judul Penelitian</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control @error('judul_penelitian') is-invalid @enderror"
                        id="judul_penelitian" name="judul_penelitian"
                        value="{{ old('judul_penelitian', $penelitian->judul_penelitian) }}" required
                        autocomplete="judul_penelitian" autofocus>
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
                    <select name="status_id" class="form-control">
                        @foreach ($status as $e)
                            <option value="{{ $e->id }}" {{ "old('status_id') == $e->id" ? 'selected' : '' }}>
                                {{ ucwords($e->name) }}
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
                        id="jumlah_anggota" name="jumlah_anggota"
                        value="{{ old('jumlah_anggota', $penelitian->jumlah_anggota) }}" required
                        autocomplete="jumlah_anggota">
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
                    <select name="periode_id" class="form-control">
                        @foreach ($periode as $d)
                            <option value="{{ $d->id }}" {{ old('periode_id') == "$d->id" ? 'selected' : '' }}>
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
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
                <a href="{{ route('penelitian.index') }}" type="button" class="btn btn-secondary">
                    Back
                </a>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
