@extends('admin.layouts.app')
@section('title', 'Halaman Periode')
@section('content')
    @can('view', App\Models\Periode::class)
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
            @include('flash-message')

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                @can('create', App\Models\Periode::class)
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('periode.add') }}" class="btn btn-success btn-icon-split">
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
                                    <th>Tahun Akademik</th>
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
                                        @if ($item->tahun == 2000)
                                            <td></td>
                                            <td></td>
                                        @else
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->tahun }}</td>
                                        @endif
                                        @if ($item->semester == 1)
                                            <td>Ganjil</td>
                                        @elseif ($item->semester == 2)
                                            <td>Genap</td>
                                        @elseif ($item->tahun == 2000)
                                            <td></td>
                                        @endif
                                        @if ($item->tahun == 2000)
                                            <td></td>
                                        @else
                                            <td>
                                                @can('delete', App\Models\Periode::class)
                                                    <div class="btn-center">
                                                        <form action="{{ route('periode.delete', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-danger btn-circle btn-sm"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                @endcan
                                            </td>
                                        @endif

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
                "pageLength": 20
            });
        });
    </script>
@endprepend
