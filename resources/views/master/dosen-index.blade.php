@extends('admin.layouts.app')
@section('title', 'Halaman Dosen')
@section('content')
    @if (Auth::user()->role_id != 1)
        <h1 class="h3 mb-4 text-gray-800">Maaf, kamu tidak bisa mengakses halaman ini.</h1>
    @else
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
            @include('flash-message')

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                {{-- Fitur dimatikan karena udah jadi satu dengan user --}}
                {{-- @can('create', App\Models\Dosen::class)
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('dosen.add') }}" class="btn btn-success btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Add</span>
                            </a>
                        </h6>
                    </div>
                @endcan --}}
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Dosen</th>
                                    <th>Nama Dosen</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>JJA</th>
                                    <th>No Telepon</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
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
                                        {{-- @if ($item->picture == '')
                                            <td><img class="img-profile rounded-circle"
                                                    src="{{ asset('assets/sb-admin2/img/undraw_profile.svg') }}"></td>
                                        @else
                                            <td>
                                                <img src="{{ Storage::url('public/image/' . $item->picture) }}"
                                                    alt="gallery" class="img-responsive" width="80">
                                            </td>
                                        @endif --}}
                                        @if ($item->kode == 888888)
                                            <td><span class="badge badge-primary">New</span>
                                            @else
                                            <td>{{ $item->kode }}</td>
                                        @endif
                                        <td>{{ ucwords($item->name_dsn) }}</td>
                                        <td>{{ ucwords($item->tmptlahir) . ', ' . date('d F Y', strtotime($item->tgl_lahir)) }}
                                        <td>{{ $item->m_jja->name }}</td>
                                        <td>{{ $item->no_telepon }}</td>
                                        <td>{{ $item->email }}</td>
                                        </td>
                                        <td>{{ $item->alamat }}</td>
                                        {{-- Fitur dimatikan karena udah jadi satu dengan user --}}
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('dosen.detail', $item->id) }}"
                                                    class="btn btn-info btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                                @can('update', App\Models\Dosen::class)
                                                    <a href="{{ route('dosen.edit', $item->id) }}"
                                                        class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                @endcan
                                                @can('delete', App\Models\Dosen::class)
                                                    <form action="{{ route('dosen.delete', $item->id) }}" method="post">
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
    @endif
@endsection
@prepend('datatables')
    {{-- Datatables --}}
    <script src="{{ asset('assets/sb-admin2/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "columnDefs": [{
                        "targets": [0, 1, 2, 3, 4, 5, 6],
                        "orderable": false,
                    },
                    {
                        "targets": [1, 2, 3, 4, 5, 6, 7],
                        "searchable": true,
                    }
                ],
                "pageLength": 20
            });
        });
    </script>
@endprepend
