@extends('admin.layouts.app')
@section('title', 'Tambah Dosen Baru')
@section('content')
    @can('create', App\Models\Dosen::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
            @include('flash-message')

            <form class="user" method="POST" action="{{ route('dosen.create') }}" enctype="multipart/form-data">
                @csrf

                {{-- Nama --}}
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name Dosen</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" autocomplete="name" autofocus>
                    </div>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="form-group row">
                    <label for="user_id" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control @error('user_id') is-invalid @enderror" name="user_id"
                            value="{{ old('user_id') }}" autocomplete="user_id" autofocus>
                    </div>

                    @error('user_id')
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
    @endif
@endsection
