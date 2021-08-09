@extends('admin.layouts.app')
@section('title', 'Halaman Penelitian')
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
                    @can('create', App\Models\Penelitian::class)
                        <a href="{{ route('penelitian.add') }}" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Add</span>
                        </a>
                    @endcan
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Dosen</th>
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
                                    <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                    <td>{{ $item->m_dosen->name_dsn }}</td>
                                    <td>{{ $item->judul_penelitian }}</td>
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
                                    <td>{{ $item->jumlah_anggota }}</td>
                                    <td>{{ $item->m_periode->tahun }}</td>
                                    <td>
                                        <div class="btn-group-horizontal">
                                            @if ($item->m_status->code == 3)
                                                <a href="{{ route('penelitian.pdf', $item->id) }}"
                                                    class="btn btn-info btn-circle btn-sm"><i
                                                        class="fas fa-download"></i></a>
                                            @else
                                                {{ '' }}
                                            @endif
                                            @can('update', App\Models\Penelitian::class)
                                                <a href="{{ route('penelitian.edit', $item->id) }}"
                                                    class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                            @endcan
                                            @can('delete', App\Models\Penelitian::class)
                                                <form action="{{ route('penelitian.delete', $item->id) }}" method="post">
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
                        "targets": [2, 3, 4],
                        "searchable": true,
                    }
                ],
                "pageLength": 20
            });
        });
    </script>
@endprepend
