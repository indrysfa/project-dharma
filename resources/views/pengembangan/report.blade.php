@extends('admin.layouts.app')
@section('title', 'Laporan Pengembangan Diri')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="GET" action="{{ route('pengembangan.export') }}">
            @csrf
            {{-- Nama Dosen --}}
            {{-- <div class="form-group row">
                <label for="dosen_id" class="col-sm-2 col-form-label">Nama Dosen</label>
                <div class="col-sm-6">
                    <select name="dosen_id" id="dosen_id" class="form-control selectpicker" data-size="5"
                        data-live-search="true">
                        @foreach ($dosen as $d)
                            <option value="{{ $d->id }}" {{ old('dosen_id') == "$d->name" ? 'selected' : '' }}>
                                {{ ucwords($d->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                @error('dosen_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div> --}}

            {{-- Range --}}
            <div class="form-group row">
                <label for="from" class="col-sm-2 col-form-label">From</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control @error('from') is-invalid @enderror" id="from" name="from"
                        value="{{ old('from') }}" autocomplete="from">
                </div>

                @error('from')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <label for="to" class="col-sm-2 col-form-label">To</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control @error('to') is-invalid @enderror" id="to" name="to"
                        value="{{ old('to') }}" autocomplete="to">
                </div>

                @error('to')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Download
                </button>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
