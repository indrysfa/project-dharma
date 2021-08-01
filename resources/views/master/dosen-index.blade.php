@extends('admin.layouts.app')
@section('title', 'Halaman Dosen')
@section('content')
    @if (Auth::user()->role_id != 1)
        <h1 class="h3 mb-4 text-gray-800">Maaf, kamu tidak bisa mengakses halaman ini.</h1>
    @else
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
            @include('flash-message')

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                {{-- Fitur dimatikan karena udah jadi satu dengan user --}}
                {{-- @can('create', App\Models\Dosen::class)
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('dosen.add') }}" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add</span>
                            </a>
                        </h6>
                    </div>
                @endcan --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Join Date</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Status</th>
                                    {{-- Fitur dimatikan karena udah jadi satu dengan user --}}
                                    {{-- @can('delete', App\Models\Dosen::class)
                                        <th></th>
                                    @endcan --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        @if ($item->picture == '')
                                            <td><img class="img-profile rounded-circle"
                                                    src="{{ asset('assets/sb-admin2/img/undraw_profile.svg') }}"></td>
                                        @else
                                            <td>
                                                <img src="{{ Storage::url('public/image/' . $item->picture) }}"
                                                    alt="gallery" class="img-responsive" width="80">
                                            </td>
                                        @endif
                                        <td>{{ $item->user_id }}</td>
                                        <td>{{ ucwords($item->name) }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->email_verified_at }}</td>
                                        <td>{{ $item->tmptlahir }}</td>
                                        <td>{{ date('d F Y', strtotime($item->tgl_lahir)) }}</td>
                                        <td>{{ ucwords($item->status) }}</td>
                                        {{-- Fitur dimatikan karena udah jadi satu dengan user --}}
                                        {{-- <td>
                                            <div class="btn-center">
                                                @can('delete', App\Models\Dosen::class)
                                                    <a href="{{ route('user.detail', $item->id) }}"
                                                        class="btn btn-info btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                                    <a href="{{ route('user.edit', $item->id) }}"
                                                        class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                    <form action="{{ route('dosen.delete', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger btn-circle btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
    @endif
@endsection
