@extends('admin.layouts.app')
@section('title', 'Halaman Pengabdian Kepada Masyarakat')
@section('content')
    @can('view', App\Models\Pengabdian::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            @include('flash-message')

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                @can('create', App\Models\Pengabdian::class)
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('pengabdian.add') }}" class="btn btn-success btn-icon-split">
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
                                    <th>Nama Dosen</th>
                                    <th>Status Laporan</th>
                                    <th>Tanggal Pelaksanaan</th>
                                    <th>Judul PKM</th>
                                    <th>Nama Komunitas</th>
                                    <th>Lokasi PKM</th>
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
                                        @if ($item->m_periode->id == 1)
                                            <td>{{ '' }}</td>
                                            <td>{{ '' }}</td>
                                        @else
                                            <td>{{ $item->m_periode->tahun }}</td>
                                            <td>{{ $item->m_periode->semester }}</td>
                                        @endif
                                        <td>{{ $item->m_dosen->name_dsn }}</td>
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
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->judul_pkm }}</td>
                                        <td>{{ $item->nama_komunitas }}</td>
                                        <td>{{ $item->lokasi_pkm }}</td>
                                        <td>
                                            <div class="btn-center">
                                                @if ($item->m_status->code == 3)
                                                    <a href="{{ route('pengabdian.pdf', $item->id) }}"
                                                        class="btn btn-info btn-circle btn-sm"><i
                                                            class="fas fa-download"></i></a>
                                                @else
                                                    {{ '' }}
                                                @endif
                                                @can('update', App\Models\Pengabdian::class)
                                                    @if (Auth::user()->role_id == 1)
                                                        <a href="{{ route('pengabdian.edit', $item->id) }}"
                                                            class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                    @elseif ($item->m_status->code == 3 && Auth::user()->role_id == 3 ||
                                                        Auth::user()->role_id == 2)
                                                        {{ '' }}
                                                    @endif
                                                @endcan
                                                @can('delete', App\Models\Pengabdian::class)
                                                    <form action="{{ route('pengabdian.delete', $item->id) }}" method="post">
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
                        "targets": [0, 6],
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
