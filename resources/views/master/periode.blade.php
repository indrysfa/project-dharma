@extends('admin.layouts.app')
@section('title', 'Halaman Periode')
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
                @can('create', App\Models\Periode::class)
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('periode.add') }}" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add</span>
                            </a>
                        </h6>
                    </div>
                @endcan
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tahun }}</td>
                                        <td>{{ $item->semester }}</td>
                                        <td>
                                            @can('delete', App\Models\Periode::class)
                                                <div class="btn-center">
                                                    <form action="{{ route('periode.delete', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger btn-circle btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            @endcan
                                        </td>
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
