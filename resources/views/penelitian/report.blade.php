@extends('admin.layouts.app')
@section('title', 'Laporan Penelitian')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

        @include('flash-message')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <a href="{{ route('penelitian.add') }}" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add</span>
                    </a>
                    <a href="{{ route('penelitian.export') }}" class="btn btn-info btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="text">Export</span>
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Penelitian</th>
                                <th>Status Penelitian</th>
                                <th>Jumlah Anggota</th>
                                <th>Tahun Penelitian</th>
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
                                    <td>{{ $item->judul_penelitian }}</td>
                                    <td>{{ ucwords($item->m_status->name) }}</td>
                                    <td>{{ $item->jumlah_anggota }}</td>
                                    <td>{{ $item->m_periode->tahun }}</td>
                                    {{-- <td>{{ $periode->tahun }}</td> --}}
                                    <td>
                                        <div class="btn-center">
                                            <a href="{{ route('penelitian.edit', $item->id) }}"
                                                class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('penelitian.delete', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-circle btn-sm"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
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
