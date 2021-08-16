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
                            <th>Judul Peng. Diri</th>
                            <th>Lokasi</th>
                            <th>Status Laporan</th>
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
                                <td>{{ $item->m_dosen->name_dsn }}</td>
                                <td>{{ ucwords($item->m_jenis_pengdiri->name_jp) }}</td>
                                <td>{{ $item->judul_pengdiri }}</td>
                                <td>{{ $item->lokasi_pengdiri }}</td>
                                @if ($item->m_status->code == 1)
                                    <td><span class="badge badge-primary">{{ ucwords($item->m_status->name) }}</span>
                                    </td>
                                @elseif ($item->m_status->code == 2)
                                    <td><span class="badge badge-info">{{ ucwords($item->m_status->name) }}</span>
                                    </td>
                                @elseif ($item->m_status->code == 3)
                                    <td><span class="badge badge-success">{{ ucwords($item->m_status->name) }}</span>
                                    </td>
                                @endif
                                @if ($item->m_periode->id == 1)
                                    <td>{{ '' }}</td>
                                    <td>{{ '' }}</td>
                                @else
                                    <td>{{ $item->m_periode->tahun }}</td>
                                    <td>{{ $item->m_periode->semester }}</td>
                                @endif
                                <td>
                                    <div class="btn-center">
                                        {{-- issue button edit if approved is clear --}}
                                        @if ($item->m_status->code == 2)
                                            @can('update', App\Models\Pengembangan::class)
                                                <a href="{{ route('pengembangan.edit', $item->id) }}"
                                                    class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                            @endcan
                                        @else
                                            {{ '' }}
                                        @endif
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
@prepend('datatables')
{{-- Datatables --}}
<script src="{{ asset('assets/sb-admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "columnDefs": [{
                    "targets": [0, 1, 2, 3, 5, 6, 7],
                    "orderable": false,
                },
                {
                    "targets": [1, 2, 3, 4, 5],
                    "searchable": true,
                }
            ],
            "pageLength": 20
        });
    });
</script>
@endprepend
