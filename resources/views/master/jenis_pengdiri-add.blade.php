@extends('admin.layouts.app')
@section('title', 'Tambah Jenis Pengembangan Diri Baru')
@section('content')
    @can('create', App\Models\Jenis_pengdiri::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
            @include('flash-message')

            <form class="user" method="POST" action="{{ route('jenis_pengdiri.create') }}" enctype="multipart/form-data">
                @csrf

                {{-- Name Jenis Peng. Diri --}}
                <div class="form-group row">
                    <label for="name_jp" class="col-sm-3 col-form-label">Nama Jenis Peng. Diri</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('name_jp') is-invalid @enderror" name="name_jp"
                            value="{{ old('name_jp') }}" autocomplete="name_jp" autofocus>
                    </div>

                    @error('name_jp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a type="button" href="{{ route('jenis_pengdiri.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
