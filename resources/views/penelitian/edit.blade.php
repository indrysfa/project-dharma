@extends('admin.layouts.app')
@section('title', 'Ubah Data Penelitian')
@section('content')
    @can('update', App\Models\Penelitian::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            @include('flash-message')

            <form class="user" method="POST" action="{{ route('penelitian.update', $penelitian->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama Dosen --}}
                <div class="form-group row">
                    <label for="dosen_id" class="col-sm-4 col-form-label">Nama Dosen</label>
                    <div class="col-sm-4 pt-1">
                        {{ $penelitian->m_dosen->name_dsn }}
                    </div>

                    @error('dosen_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @if (Auth::user()->role_id == 2)
                    {{-- Judul Penelitian --}}
                    <div class="form-group row">
                        <label for="judul_penelitian" class="col-sm-4 col-form-label">Judul Penelitian</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control @error('judul_penelitian') is-invalid @enderror"
                                id="judul_penelitian" name="judul_penelitian"
                                value="{{ old('judul_penelitian', $penelitian->judul_penelitian) }}" readonly
                                autocomplete="judul_penelitian" autofocus>
                        </div>

                        @error('judul_penelitian')
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
                                value="{{ old('jumlah_anggota', $penelitian->jumlah_anggota) }}" readonly
                                autocomplete="jumlah_anggota">
                        </div>

                        @error('jumlah_anggota')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @elseif (Auth::user()->role_id == 1)
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

                    {{-- Status Penelitian --}}
                    <div class="form-group row">
                        <label for="status_id" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-4">
                            <select id="status_id" class="form-control selectpicker @error('status_id') is-invalid @enderror"
                                name="status_id" value="{{ old('status_id', $penelitian->status_id) }}" required>
                                @foreach ($status as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $penelitian->status_id == $item->id ? 'selected' : '' }}>
                                        {{ ucwords($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('status_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @endif


                {{-- Tahun Penelitian --}}
                <div class="form-group row">
                    <label for="periode_id" class="col-sm-4 col-form-label">Tahun Penelitian</label>
                    <div class="col-sm-4">
                        <select id="periode_id" class="form-control selectpicker @error('periode_id') is-invalid @enderror"
                            data-size="5" data-live-search="true" name="periode_id"
                            value="{{ old('periode_id', $penelitian->periode_id) }}" required>
                            @foreach ($periode as $item)
                                <option value="{{ $item->id }}"
                                    {{ $penelitian->periode_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->tahun }}</option>
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
    @endcan
@endsection
