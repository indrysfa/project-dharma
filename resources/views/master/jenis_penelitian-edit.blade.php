@extends('admin.layouts.app')
@section('title', 'Edit Jenis Penelitian')
@section('content')
    @can('update', App\Models\Jenis_penelitian::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            <form class="user" method="POST" action="{{ route('jenis_penelitian.update', $jenis_penelitian->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div class="form-group row">
                    <label for="name_jns_penelitian" class="col-sm-3 col-form-label">Name Jenis Penelitian</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control @error('name_jns_penelitian') is-invalid @enderror"
                            id="name_jns_penelitian" name="name_jns_penelitian"
                            value="{{ old('name_jns_penelitian', $jenis_penelitian->name_jns_penelitian) }}" required
                            autocomplete="name_jns_penelitian" autofocus>
                    </div>

                    @error('name_jns_penelitian')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('jenis_penelitian.index') }}" type="button" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </form>

        </div>
        <!-- /.container-fluid -->
    @endcan
@endsection
