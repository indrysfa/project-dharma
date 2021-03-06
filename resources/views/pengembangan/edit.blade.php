@extends('admin.layouts.app')
@section('title', 'Pengajuan Data Pengembangan Diri')
@section('content')
    @can('update', App\Models\Pengembangan::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            @include('flash-message')

            <form class="user" method="POST" action="{{ route('pengembangan.update', $pengembangan->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')


                @if (Auth::user()->role_id == 1)
                    {{-- Periode --}}
                    <div class="form-group row">
                        <label for="periode_id" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-2">
                            <select id="periode_id" class="form-control selectpicker @error('periode_id') is-invalid @enderror"
                                data-size="5" data-live-search="true" name="periode_id"
                                value="{{ old('periode_id', $pengembangan->periode_id) }}" required>
                                @foreach ($periode as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $pengembangan->periode_id == $item->id ? 'selected' : '' }}>
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
                            @if ($pengembangan->m_periode->semester == 1)
                                {{ $semester = $pengembangan->m_periode->tahun . ' - Ganjil' }}
                                <input name="periode_id" value="{{ old('periode_id', $pengembangan->m_periode->id) }}" hidden>
                            @else
                                {{ $semester = $pengembangan->m_periode->tahun . ' - Genap' }}
                                <input name="periode_id" value="{{ old('periode_id', $pengembangan->m_periode->id) }}" hidden>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Nama Dosen --}}
                <div class="form-group row">
                    <label for="dosen_id" class="col-sm-2 col-form-label">Nama Dosen</label>
                    <div class="col-sm-6 pt-1">
                        {{ $pengembangan->m_dosen->name_dsn }}
                        <input name="dosen_id" value="{{ old('dosen_id', $pengembangan->m_dosen->id) }}" hidden>
                    </div>
                </div>

                {{-- Tanggal --}}
                <div class="form-group row">
                    <label for="tgl_pengembangan" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-4 pt-1">
                        <input type="date" class="form-control @error('tgl_pengembangan') is-invalid @enderror"
                            id="tgl_pengembangan" name="tgl_pengembangan"
                            value="{{ old('tgl_pengembangan', $pengembangan->tgl_pengembangan) }}"
                            autocomplete="tgl_pengembangan" autofocus>
                    </div>

                    @error('tgl_pengembangan')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Jenis --}}
                <div class="form-group row">
                    <label for="jenis_pengdiri_id" class="col-sm-2 col-form-label">Jenis Peng. Diri</label>
                    <div class="col-sm-4">
                        <select class="form-control selectpicker @error('periode_id') is-invalid @enderror" data-size="5"
                            data-live-search="true" name="jenis_pengdiri_id" id="jenis_pengdiri_id">
                            @foreach ($jenis_pengdiri as $e)
                                <option value="{{ $e->id }}"
                                    {{ "old('jenis_pengdiri_id') == $e->id" ? 'selected' : '' }}>
                                    {{ ucwords($e->name_jp) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @error('jenis_pengdiri_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Judul --}}
                <div class="form-group row">
                    <label for="judul_pengdiri" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('judul_pengdiri') is-invalid @enderror"
                            id="judul_pengdiri" name="judul_pengdiri"
                            value="{{ old('judul_pengdiri', $pengembangan->judul_pengdiri) }}" required
                            autocomplete="judul_pengdiri" autofocus>
                    </div>

                    @error('judul_pengdiri')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Lokasi --}}
                <div class="form-group row">
                    <label for="lokasi_pengdiri" class="col-sm-2 col-form-label">Lokasi</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control @error('lokasi_pengdiri') is-invalid @enderror"
                            id="lokasi_pengdiri" name="lokasi_pengdiri" required
                            autocomplete="lokasi_pengdiri">{{ old('lokasi_pengdiri', $pengembangan->lokasi_pengdiri) }}</textarea>
                    </div>

                    @error('lokasi_pengdiri')
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
                                name="status_id" value="{{ old('status_id', $pengembangan->status_id) }}" required>
                                @foreach ($status as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $pengembangan->status_id == $item->id ? 'selected' : '' }}>
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
                    <a href="{{ route('pengembangan.index') }}" type="button" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
