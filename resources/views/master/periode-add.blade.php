@extends('admin.layouts.app')
@section('title', 'Tambah Periode Baru')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        <form class="user" method="POST" action="{{ route('periode.create') }}">
            @csrf

            {{-- Tahun Ajaran --}}
            <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun Ajaran</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun"
                        name="tahun" value="{{ old('tahun') }}" required autocomplete="tahun" autofocus
                        placeholder="Masukan Tahun Ajaran Baru">
                </div>

                @error('tahun')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

             {{-- Semester --}}
             <div class="form-group row">
                <label for="semester" class="col-sm-2 col-form-label">Semester</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control @error('semester') is-invalid @enderror" id="semester"
                        name="semester" value="{{ old('semester') }}" required autocomplete="semester" autofocus
                        placeholder="Masukan Semester Baru">
                </div>

                @error('semester')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-user">
                    Save
                </button>
            </div>
        </form>

    </div>
    <!-- /.container-fluid -->
@endsection
