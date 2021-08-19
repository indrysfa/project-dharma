@extends('admin.layouts.app')
@section('title', 'Edit Jenis Pengembangan Diri')
@section('content')
    @can('update', App\Models\jenis_pengdiri::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            <form class="user" method="POST" action="{{ route('jenis_pengdiri.update', $jenis_pengdiri->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="form-group row">
                    <label for="name_jp" class="col-sm-3 col-form-label">Name Jenis Peng. Diri</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('name_jp') is-invalid @enderror" id="name_jp"
                            name="name_jp" value="{{ old('name_jp', $jenis_pengdiri->name_jp) }}" required
                            autocomplete="name_jp" autofocus>
                    </div>

                    @error('name_jp')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('jenis_pengdiri.index') }}" type="button" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
