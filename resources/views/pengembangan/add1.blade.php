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

                {{-- Periode --}}
                <div class="form-group row">
                    <label for="periode_id" class="col-sm-2 col-form-label">Periode</label>
                    <div class="col-sm-2">
                        <select name="periode_id" id="periode_id" class="selectpicker" data-size="5" data-live-search="true">
                            @foreach ($periode as $d)
                                <option value="{{ $d->id }}" {{ old('periode_id') == "$d->tahun" ? selected : '' }}>
                                    @if ($d->semester == 1)
                                        {{ $d->tahun . ' - Ganjil' }}
                                    @else
                                        {{ $d->tahun . ' - Genap' }}
                                    @endif
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

                {{-- Nama Dosen --}}
                <div class="form-group row">
                    <label for="dosen_id" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-6">
                        <select name="dosen_id" id="dosen_id" class="form-control selectpicker" data-size="5"
                            data-live-search="true">
                            @foreach ($dosen as $d)
                                <option value="{{ $d->id }}" {{ old('dosen_id') == "$d->id" ? 'selected' : '' }}>
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

                {{-- Row --}}
                <div class="form-group row">
                    <label for="row" class="col-sm-2 col-form-label">Row</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control @error('row') is-invalid @enderror" id="row" name="row"
                            value="{{ old('row') }}" autocomplete="row" autofocus
                            placeholder="Masukan Berapa banyak data yang dibutuhkan">
                    </div>

                    @error('row')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

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
