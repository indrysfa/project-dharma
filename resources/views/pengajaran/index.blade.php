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
            @can('create', App\Models\Pengajaran::class)
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
            @endcan
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Dosen</th>
                                <th>Kode MK</th>
                                <th>Nama MK</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Kelas</th>
                                <th>SKS</th>
                                @can('view', App\Models\Pengajaran::class)
                                    <th>Status</th>
                                @endcan
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
                                    <td>{{ $item->m_dosen->name_dsn }}</td>
                                    <td>{{ $item->kode_mk }}</td>
                                    <td>{{ $item->nama_mk }}</td>
                                    {{-- @php
                                        $period = Illuminate\Support\Facades\DB::table('periodes')
                                            ->join('pengajarans', 'periodes.id', '=', 'pengajarans.periode_id')
                                            ->get();
                                    @endphp --}}
                                    {{-- <td>{{ $period[0]->tahun }}</td>
                                    <td>{{ $period[0]->semester }}</td> --}}
                                    <td>{{ $item->m_periode->tahun }}</td>
                                    <td>{{ $item->m_periode->semester }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->sks }}</td>
                                    @can('view', App\Models\Pengajaran::class)
                                        @if (Auth::user()->role_id == 3)
                                            {{ '' }}
                                        @else
                                            <td>{{ ucwords($item->m_status->name) }}</td>
                                        @endif
                                    @endcan
                                    {{-- @can('view', App\Models\Pengajaran::class)
                                        @if ($item->status_id == 1)
                                            <td>{{ 'Aktif' }}</td>
                                        @else
                                            <td>{{ 'Nonaktif' }}</td>
                                        @endif
                                    @endcan --}}
                                    <td>
                                        <div class="btn-center">
                                            @can('update', App\Models\Pengajaran::class)
                                                <a href="{{ route('pengajaran.edit', $item->id) }}"
                                                    class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                            @endcan
                                            @can('delete', App\Models\Pengajaran::class)
                                                <form action="{{ route('pengajaran.delete', $item->id) }}" method="post">
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
