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
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        @can('create', App\Models\Pengajaran::class)
                            <a href="{{ route('pengajaran.add') }}" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add</span>
                            </a>
                        @endcan
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('pengajaran.search') }}" method="GET">
                        <div class="form-group row">
                            <label for="search" class="col-sm-3 col-form-label">Periode</label>
                            <div class="col-sm-5">
                                <select name="search" id="search" class="form-control selectpicker show-tick" data-size="5"
                                    data-live-search="true">
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Nama Dosen</th>
                                <th>Kode MK</th>
                                <th>Nama MK</th>
                                <th>Kelas</th>
                                <th>SKS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($uri == '/pengajaran' || $uri == '/pengajaran/')
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
                                        <td>{{ $item->m_dosen->name_dsn }}</td>
                                        <td>{{ $item->kode_mk }}</td>
                                        <td>{{ $item->nama_mk }}</td>
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
                                                    @if (($item->m_status->code == 3 && Auth::user()->role_id == 3) || Auth::user()->role_id == 2)
                                                        {{ '' }}
                                                    @elseif ($item->m_status->code == 1 && Auth::user()->role_id == 3)
                                                        <a href="{{ route('pengajaran.edit', $item->id) }}"
                                                            class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                    @elseif (Auth::user()->role_id == 1)
                                                        <a href="{{ route('pengajaran.edit', $item->id) }}"
                                                            class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                    @endif
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
                            @endif
                        </tbody>
                    </table>

                </div>
                {{-- {{ $data->links() }}
                    {{ 'Total of ' . $data->total() . ' entries' }} --}}
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
                "pageLength": 10
            });
        });
    </script>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $("#dataTable").DataTable({
                processing: true,
                serverSide: true,
                order: [],
                ajax: {
                    url: "{{ route('pengajaran.index') }}",
                    type: 'GET'
                },
                columnDefs: [{
                        "targets": [0, 1, 4, 5],
                        "orderable": false,
                    },
                    {
                        "targets": [1, 2, 3, 4, 5, 6],
                        "searchable": true,
                    }
                ],
                columns: [{
                    data: 'periode_id',
                    name: 'periode_id'
                }, {
                    data: 'status_id',
                    name: 'status_id'
                }, {
                    data: 'name_dsn',
                    name: 'name_dsn'
                }, {
                    data: 'kode_mk',
                    name: 'kode_mk'
                }, {
                    data: 'nama_mk',
                    name: 'nama_mk'
                }, {
                    data: 'kelas',
                    name: 'kelas'
                }, {
                    data: 'sks',
                    name: 'sks'
                }, ]
                pageLength: 5,
                fnInfoCallback: function(oSettings, iStart, iEnd, iMax, iTotal, sPre) {
                    return "Showing " + iStart + " to " + iEnd + " of " + iTotal + " entries";
                }
            })
            $('#dataTable_length').hide()
        })
    </script> --}}
@endprepend
