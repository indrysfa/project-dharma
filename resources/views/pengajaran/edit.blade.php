@extends('admin.layouts.app')
@section('title', 'Ubah Data Pengajaran')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('pengajaran.update', $pengajaran->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Kode MK --}}
            <div class="form-group row">
                <label for="kode_mk" class="col-sm-2 col-form-label">Kode MK</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('kode_mk') is-invalid @enderror" id="kode_mk"
                        name="kode_mk" value="{{ old('kode_mk', $pengajaran->kode_mk) }}" required autocomplete="kode_mk"
                        autofocus>
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
                        name="nama_mk" value="{{ old('nama_mk', $pengajaran->nama_mk) }}" required autocomplete="nama_mk"
                        autofocus>
                </div>

                @error('nama_mk')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Periode --}}
            <div class="form-group row">
                <label for="periode_id" class="col-sm-2 col-form-label">Periode</label>
                <div class="col-sm-10">
                    <input type="periode_id" class="form-control @error('periode_id') is-invalid @enderror" id="periode_id"
                        name="periode_id" value="{{ old('periode_id', $pengajaran->periode_id) }}" required
                        autocomplete="periode_id">
                </div>

                @error('periode_id')
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
                        value="{{ old('kelas', $pengajaran->kelas) }}" required autocomplete="kelas">
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
                        value="{{ old('sks', $pengajaran->sks) }}" required autocomplete="sks">
                </div>


                @error('sks')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-user">
                    Update
                </button>
                <a href="{{ route('user.index') }}" type="button" class="btn btn-secondary btn-user">
                    Back
                </a>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
