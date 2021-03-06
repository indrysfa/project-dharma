@extends('admin.layouts.app')
@section('title', 'Halaman User')
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
                @can('create', App\Models\User::class)
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <a href="{{ route('user.add') }}" class="btn btn-success btn-icon-split">
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
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
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
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->m_role->name_r }}</td>
                                        <td>
                                            <div class="btn-center">
                                                <a href="{{ route('user.detail', $item->id) }}"
                                                    class="btn btn-info btn-circle btn-sm"><i class="fas fa-eye"></i></a>
                                                @can('update', App\Models\User::class)
                                                    <a href="{{ route('user.edit', $item->id) }}"
                                                        class="btn btn-warning btn-circle btn-sm"><i class="fas fa-pen"></i></a>
                                                @endcan
                                                @can('delete', App\Models\User::class)
                                                    <form action="{{ route('user.delete', $item->id) }}" method="post">
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
                        "targets": [],
                        "orderable": false,
                    },
                    {
                        "targets": [1, 2, 3, 4],
                        "searchable": true,
                    }
                ],
                "pageLength": 20
            });
        });
    </script>
@endprepend
