@extends('admin.layouts.app')
@section('title', 'Halaman Pengembangan Diri')
@section('content')
    @can('view', App\Models\Pengembangan::class)
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
                    <form action="{{ route('pengembangan.search') }}" method="GET">
                        <div class="form-group row">
                            <label for="search" class="col-sm-3 col-form-label">Periode</label>
                            <div class="col-sm-5">
                                <select name="search" id="search" class="form-control selectpicker show-tick" data-size="5"
                                    data-live-search="true" value="{{ old('search') }}">
                                    @foreach ($periode as $d)
                                        <option noneSelectedText value="{{ $d->id }}"
                                            {{ old('search') == "$d->id" ? 'selected' : '' }}>
                                            @if ($d->semester == 1)
                                                {{ $d->tahun . ' - Ganjil' }}
                                            @elseif ($d->semester == 2)
                                                {{ $d->tahun . ' - Genap' }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="icon text-white-50 btn btn-info">
                                    <span>
                                        <i class="fas fa-search"></i>
                                    </span>
                                </button>
                            </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                    <th>Nama Dosen</th>
                                    <th>Status Laporan</th>
                                    <th>Tanggal Pelaksanaan</th>
                                    <th>Jenis Peng. Diri</th>
                                    <th>Judul Peng. Diri</th>
                                    <th>Lokasi</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($uri == '/pengembangan' || $uri == '/pengembangan/')
                                    <td colspan="10" class="text-center">Select period first!</td>
                                @else
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->m_periode->tahun }}</td>
                                            @if ($item->m_periode->semester == 1)
                                                <td>Ganjil</td>
                                            @else
                                                <td>Genap</td>
                                            @endif
                                            <td>{{ $item->m_dosen->name_dsn }}</td>
                                            @if ($item->m_status->code == 1)
                                                <td><span
                                                        class="badge badge-primary">{{ ucwords($item->m_status->name) }}</span>
                                                </td>
                                            @elseif ($item->m_status->code == 2)
                                                <td><span
                                                        class="badge badge-info">{{ ucwords($item->m_status->name) }}</span>
                                                </td>
                                            @elseif ($item->m_status->code == 3)
                                                <td><span
                                                        class="badge badge-success">{{ ucwords($item->m_status->name) }}</span>
                                                </td>
                                            @elseif ($item->m_status->code == 4)
                                                <td><span
                                                        class="badge badge-danger">{{ ucwords($item->m_status->name) }}</span>
                                                </td>
                                            @endif
                                            @if ($item->tgl_pengembangan == null)
                                                <td>-</td>
                                            @else
                                                <td>{{ date('d F Y', strtotime($item->tgl_pengembangan)) }}</td>
                                            @endif
                                            @if ($item->m_jenis_pengdiri->id == 1)
                                                <td>-</td>
                                            @else
                                                <td>{{ ucwords($item->m_jenis_pengdiri->name_jp) }}</td>
                                            @endif
                                            <td>{{ $item->judul_pengdiri }}</td>
                                            <td>{{ ucwords($item->lokasi_pengdiri) }}</td>
                                            <td>
                                                <div class="btn-center">
                                                    {{-- issue button edit if approved is clear --}}

                                                    @if (Auth::user()->role_id == 1)
                                                        @can('update', App\Models\Pengembangan::class)
                                                            <a href="{{ route('pengembangan.edit', $item->id) }}"
                                                                class="btn btn-warning btn-circle btn-sm"><i
                                                                    class="fas fa-pen"></i></a>
                                                        @endcan
                                                        @if ($item->m_status->code == 3)
                                                            <a href="{{ route('pengembangan.pdf', $item->id) }}"
                                                                class="btn btn-info btn-circle btn-sm"><i
                                                                    class="fas fa-download"></i></a>
                                                        @endif
                                                    @elseif ($item->m_status->code == 1)
                                                        @can('update', App\Models\Pengembangan::class)
                                                            <a href="{{ route('pengembangan.edit', $item->id) }}"
                                                                class="btn btn-warning btn-circle btn-sm"><i
                                                                    class="fas fa-pen"></i></a>
                                                        @endcan
                                                    @elseif ($item->m_status->code == 3)
                                                        <a href="{{ route('pengembangan.pdf', $item->id) }}"
                                                            class="btn btn-info btn-circle btn-sm"><i
                                                                class="fas fa-download"></i></a>
                                                    @elseif ($item->m_status->code == 2 || $item->m_status->code == 4)
                                                        {{ '' }}
                                                    @endif
                                                    @can('delete', App\Models\Pengembangan::class)
                                                        <form action="{{ route('pengembangan.delete', $item->id) }}"
                                                            method="post">
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
                                @endif
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
                        "targets": [0, 1, 2, 3, 5, 6, 7],
                        "orderable": false,
                    },
                    {
                        "targets": [1, 2, 3, 4, 5],
                        "searchable": true,
                    }
                ],
                "pageLength": 10
            });
        });
    </script>
@endprepend
