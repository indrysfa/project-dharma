@extends('admin.layouts.app')
@section('title', 'Halaman Pengajaran')
@section('content')
    @can('view', App\Models\Pengajaran::class)
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
                                    <th>Status</th>
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
                                        <td>{{ $item->m_dosen->name_dsn }}</td>
                                        <td>{{ $item->kode_mk }}</td>
                                        <td>{{ $item->nama_mk }}</td>
                                        @if ($item->m_status->code == 1)
                                            <td><span class="badge badge-primary">{{ ucwords($item->m_status->name) }}</span>
                                            </td>
                                        @elseif ($item->m_status->code == 2)
                                            <td><span class="badge badge-info">{{ ucwords($item->m_status->name) }}</span>
                                            </td>
                                        @elseif ($item->m_status->code == 3)
                                            <td><span class="badge badge-success">{{ ucwords($item->m_status->name) }}</span>
                                            </td>
                                        @elseif ($item->m_status->code == 4)
                                            <td><span class="badge badge-danger">{{ ucwords($item->m_status->name) }}</span>
                                            </td>
                                        @endif
                                        @if ($item->m_periode->id == 1)
                                            <td>{{ '' }}</td>
                                            <td>{{ '' }}</td>
                                        @else
                                            <td>{{ $item->m_periode->tahun }}</td>
                                            <td>{{ $item->m_periode->semester }}</td>
                                        @endif
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->sks }}</td>
                                        <td>
                                            <div class="btn-center">
                                                @if ($item->m_status->code == 3)
                                                    <a href="{{ route('pengajaran.pdf', $item->id) }}"
                                                        class="btn btn-info btn-circle btn-sm"><i
                                                            class="fas fa-download"></i></a>
                                                @else
                                                    {{ '' }}
                                                @endif
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
    @endcan
@endsection
@prepend('datatables')
    {{-- Datatables --}}
    <script src="{{ asset('assets/sb-admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "columnDefs": [{
                        "targets": [0, 1, 4, 5],
                        "orderable": false,
                    },
                    {
                        "targets": [1, 2, 3, 4, 5, 6],
                        "searchable": true,
                    }
                ],
                "pageLength": 20
            });
        });
    </script>
@endprepend
