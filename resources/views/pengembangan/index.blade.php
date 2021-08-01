@extends('admin.layouts.app')
@section('title', 'Halaman Pengembangan Diri')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        @include('flash-message')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            @can('create', App\Models\Pengembangan::class)
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <a href="{{ route('pengembangan.add') }}" class="btn btn-success btn-icon-split">
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
                                <th>Nama Dosen</th>
                                <th>Jenis Peng. Diri</th>
                                <th>Status Peng. Diri</th>
                                <th>Lokasi</th>
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
                                    <td>{{ $item->m_dosen->name }}</td>
                                    <td>{{ ucwords($item->m_jenis_pengdiri->name) }}</td>
                                    <td>{{ $item->judul_pengdiri }}</td>
                                    <td>{{ $item->lokasi_pengdiri }}</td>
                                    <td>{{ $item->m_periode->tahun }}</td>
                                    <td>{{ $item->m_periode->semester }}</td>
                                    <td>
                                        <div class="btn-center">
                                            @can('update', App\Models\Pengembangan::class)
                                                <a href="{{ route('pengembangan.edit', $item->id) }}"
                                                    class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                            @endcan
                                            @can('delete', App\Models\Pengembangan::class)
                                                <form action="{{ route('pengembangan.delete', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-circle btn-sm"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            @endcan
                                        </div>
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
@endsection
