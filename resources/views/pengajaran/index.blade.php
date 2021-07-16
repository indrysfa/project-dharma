@extends('admin.layouts.app')
@section('title', 'Halaman Pengajaran')
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
                    <a href="{{ route('pengajaran.add') }}" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Add</span>
                    </a>
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode MK</th>
                                <th>Nama MK</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Kelas</th>
                                <th>SKS</th>
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
                                    <td>{{ $item->kode_mk }}</td>
                                    <td>{{ $item->nama_mk }}</td>
                                    <td>{{ $item->m_periode->tahun }}</td>
                                    <td>{{ $item->m_periode->semester }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->sks }}</td>
                                    <td>
                                        <div class="btn-center">
                                            <a href="{{ route('pengajaran.edit', $item->id) }}"
                                                class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                            <form action="{{ route('pengajaran.delete', $item->id) }}" method="post">
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
