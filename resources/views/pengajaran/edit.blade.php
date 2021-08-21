@extends('admin.layouts.app')
@section('title', 'Ubah Data Pengajaran')
@section('content')
    @can('update', App\Models\Pengajaran::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            @include('flash-message')

            <form class="user" method="POST" action="{{ route('pengajaran.update', $pengajaran->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @if (Auth::user()->role_id == 1)
                    {{-- Periode --}}
                    <div class="form-group row">
                        <label for="periode_id" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-3">
                            <select id="periode_id" class="form-control selectpicker @error('periode_id') is-invalid @enderror"
                                data-size="5" data-live-search="true" name="periode_id"
                                value="{{ old('periode_id', $pengabdian->periode_id) }}" required>
                                @foreach ($periode as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $pengabdian->periode_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->tahun . '-' . $item->semester }}</option>
                                @endforeach
                            </select>
                        </div>

                        @error('periode_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                @else
                    {{-- Periode --}}
                    <div class="form-group row">
                        <label for="periode_id" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-2 pt-1">
                            @if ($pengajaran->m_periode->semester == 1)
                                {{ $semester = $pengajaran->m_periode->tahun . ' - Ganjil' }}
                                <input name="periode_id" value="{{ old('periode_id', $pengajaran->m_periode->id) }}" hidden>
                            @else
                                {{ $semester = $pengajaran->m_periode->tahun . ' - Genap' }}
                                <input name="periode_id" value="{{ old('periode_id', $pengajaran->m_periode->id) }}" hidden>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Nama Dosen --}}
                <div class="form-group row">
                    <label for="dosen_id" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-10 mt-1">
                        {{ $pengajaran->m_dosen->name_dsn }}
                    </div>
                </div>

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

                @if (Auth::user()->role_id == 1)
                    {{-- Status --}}
                    <div class="form-group row">
                        <label for="status_id" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-2">
                            <select id="status_id" class="form-control selectpicker @error('status_id') is-invalid @enderror"
                                name="status_id" value="{{ old('status_id', $pengajaran->status_id) }}" required>
                                @foreach ($status as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $pengajaran->status_id == $item->id ? 'selected' : '' }}>
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
                @else
                    {{ '' }}
                @endif

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Report
                    </button>
                    <a href="{{ route('pengajaran.index') }}" type="button" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
