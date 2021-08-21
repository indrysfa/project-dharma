@extends('admin.layouts.app')
@section('title', 'Tambah Periode Baru')
@section('content')
    @can('create', App\Models\Periode::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
            @include('flash-message')

            <form class="user" method="POST" action="{{ route('periode.create') }}" enctype="multipart/form-data">
                @csrf

                {{-- Tahun Ajaran --}}
                <div class="form-group row">
                    <label for="tahun" class="col-sm-2 col-form-label">Tahun Akademik</label>
                    <div class="col-sm-6">
                        <input type="number" class="form-control @error('tahun') is-invalid @enderror" name="tahun"
                            value="{{ old('tahun') }}" autocomplete="tahun" autofocus placeholder="Masukan Tahun Ajaran Baru">
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
                        <input type="number" class="form-control @error('semester') is-invalid @enderror" name="semester"
                            value="{{ old('semester') }}" autocomplete="semester" autofocus
                            placeholder="Masukan Semester Baru">
                    </div>

                    @error('semester')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a type="button" href="{{ route('periode.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
