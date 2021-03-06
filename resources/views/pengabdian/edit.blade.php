@extends('admin.layouts.app')
@section('title', 'Ubah Data Pengabdian Kepada Masyarakat')
@section('content')
    @can('update', App\Models\Pengabdian::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            @include('flash-message')

            <form class="user" method="POST" action="{{ route('pengabdian.update', $pengabdian->id) }}"
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
                                value="{{ old('periode_id', $pengabdian->periode_id) }}">
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
                    <div class="form-group row">
                        <label for="periode_id" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-2 pt-1">
                            @if ($pengabdian->m_periode->semester == 1)
                                {{ $semester = $pengabdian->m_periode->tahun . ' - Ganjil' }}
                                <input name="periode_id" value="{{ old('periode_id', $pengabdian->m_periode->id) }}" hidden>
                            @else
                                {{ $semester = $pengabdian->m_periode->tahun . ' - Genap' }}
                                <input name="periode_id" value="{{ old('periode_id', $pengabdian->m_periode->id) }}" hidden>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Nama Dosen --}}
                <div class="form-group row">
                    <label for="dosen_id" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-6 pt-1">
                        {{ $pengabdian->m_dosen->name_dsn }}
                        <input name="dosen_id" value="{{ old('dosen_id', $pengabdian->m_dosen->id) }}" hidden>
                    </div>
                </div>

                {{-- Tanggal --}}
                <div class="form-group row">
                    <label for="tgl_pengabdian" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-4 pt-1">
                        <input type="date" class="form-control @error('tgl_pengabdian') is-invalid @enderror"
                            id="tgl_pengabdian" name="tgl_pengabdian"
                            value="{{ old('tgl_pengabdian', $pengabdian->tgl_pengabdian) }}" autocomplete="tgl_pengabdian"
                            autofocus>
                    </div>

                    @error('tgl_pengabdian')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

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
                        <textarea type="text" class="form-control @error('lokasi_pkm') is-invalid @enderror" id="lokasi_pkm"
                            name="lokasi_pkm" required
                            autocomplete="lokasi_pkm">{{ old('lokasi_pkm', $pengabdian->lokasi_pkm) }}</textarea>
                    </div>

                    @error('lokasi_pkm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @if (Auth::user()->role_id == 1)
                    {{-- Status PKM --}}
                    <div class="form-group row">
                        <label for="status_id" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-2">
                            <select id="status_id" class="form-control selectpicker @error('status_id') is-invalid @enderror"
                                name="status_id" value="{{ old('status_id', $pengabdian->status_id) }}" required>
                                @foreach ($status as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $pengabdian->status_id == $item->id ? 'selected' : '' }}>
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
                    <a href="{{ route('pengabdian.index') }}" type="button" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
