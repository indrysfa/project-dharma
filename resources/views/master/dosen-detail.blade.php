@extends('admin.layouts.app')
@section('title', 'Halaman Detail Dosen')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>
        <div class="accordion" id="accordionExample">
            {{-- Profile --}}
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Profile
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form class="form-horizontal">
                            <div class="card-body row">
                                <div class="col-sm-4">
                                    <div class="col-sm-8 pt-1">
                                        @if ($dosen->picture == '')
                                            <img class="img-profile rounded-circle"
                                                src="{{ asset('assets/sb-admin2/img/undraw_profile.svg') }}">
                                        @else
                                            <img src="{{ Storage::url('public/image/' . $dosen->picture) }}" alt="gallery"
                                                class="img-responsive" width="180">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group row">
                                        <label for="name_dsn" class="col-sm-4 col-form-label"><b>Name</b></label>
                                        <div class="col-sm-8 pt-1">
                                            {{ $dosen->name_dsn }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-4 col-form-label"><b>Username</b></label>
                                        <div class="col-sm-8 pt-1">
                                            {{ $dosen->user_id }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-4 col-form-label"><b>Email</b></label>
                                        <div class="col-sm-8 pt-1">
                                            {{ $dosen->email }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tmptlahir" class="col-sm-4 col-form-label"><b>Tempat Lahir</b></label>
                                        <div class="col-sm-8 pt-1">
                                            {{ $dosen->tmptlahir }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_telepon" class="col-sm-4 col-form-label"><b>No Telepon</b></label>
                                        <div class="col-sm-8 pt-1">
                                            {{ $dosen->no_telepon }}
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="alamat" class="col-sm-4 col-form-label"><b>Alamat</b></label>
                                        <div class="col-sm-8 pt-1">
                                            {{ $dosen->alamat }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                </div>
            </div>

            {{-- Pengajaran --}}
            <div class="card">
                <div class="card-header" id="headpengajaran">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#pengajaran" aria-expanded="false" aria-controls="pengajaran">
                            Pengajaran Tahun ini
                            @if ($pengajaran->isEmpty())
                                <span class="badge badge-danger">{{ ucwords('belum ada') }}</span>
                            @endif
                        </button>
                    </h2>
                </div>
                <div id="pengajaran" class="collapse" aria-labelledby="headpengajaran" data-parent="#accordionExample">
                    <div class="card-body">
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
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pengajaran as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->m_dosen->name_dsn }}</td>
                                        <td>{{ $item->kode_mk }}</td>
                                        <td>{{ $item->nama_mk }}</td>
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
                                        @if ($item->m_periode->id == 1)
                                            <td>{{ '' }}</td>
                                            <td>{{ '' }}</td>
                                        @else
                                            <td>{{ $item->m_periode->tahun }}</td>
                                            <td>{{ $item->m_periode->semester }}</td>
                                        @endif
                                        <td>{{ $item->kelas }}</td>
                                        <td>{{ $item->sks }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Penelitian --}}
            <div class="card">
                <div class="card-header" id="headpenelitian">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#penelitian" aria-expanded="false" aria-controls="penelitian">
                            Penelitian Tahun ini
                            @if ($penelitian->isEmpty())
                                <span class="badge badge-danger">{{ ucwords('belum ada') }}</span>
                            @endif
                        </button>
                    </h2>
                </div>
                <div id="penelitian" class="collapse" aria-labelledby="headpenelitian" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Dosen</th>
                                    <th>Judul Penelitian</th>
                                    <th>Status Laporan</th>
                                    <th>Jumlah Anggota</th>
                                    <th>Tahun Penelitian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($penelitian as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->m_dosen->name_dsn }}</td>
                                        <td>{{ $item->judul_penelitian }}</td>
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
                                        <td>{{ $item->jumlah_anggota }}</td>
                                        @if ($item->m_periode->id == 1)
                                            <td>{{ '' }}</td>
                                        @else
                                            <td>{{ $item->m_periode->tahun }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- PKM --}}
            <div class="card">
                <div class="card-header" id="headpkm">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#pkm" aria-expanded="false" aria-controls="pkm">
                            PKM Tahun ini
                            @if ($pengabdian->isEmpty())
                                <span class="badge badge-danger">{{ ucwords('belum ada') }}</span>
                            @endif
                        </button>
                    </h2>
                </div>
                <div id="pkm" class="collapse" aria-labelledby="headpkm" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dosen</th>
                                    <th>Judul PKM</th>
                                    <th>Nama Komunitas</th>
                                    <th>Lokasi PKM</th>
                                    <th>Status Laporan</th>
                                    <th>Tahun Ajaran</th>
                                    <th>Semester</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pengabdian as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->m_dosen->name_dsn }}</td>
                                        <td>{{ $item->judul_pkm }}</td>
                                        <td>{{ $item->nama_komunitas }}</td>
                                        <td>{{ $item->lokasi_pkm }}</td>
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
                                        @if ($item->m_periode->id == 1)
                                            <td>{{ '' }}</td>
                                            <td>{{ '' }}</td>
                                        @else
                                            <td>{{ $item->m_periode->tahun }}</td>
                                            <td>{{ $item->m_periode->semester }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Pengembangan --}}
            <div class="card">
                <div class="card-header" id="headpengembangan">
                    <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                            data-target="#pengembangan" aria-expanded="false" aria-controls="pengembangan">
                            Pengembangan Tahun ini
                            @if ($pengembangan->isEmpty())
                                <span class="badge badge-danger">{{ ucwords('belum ada') }}</span>
                            @endif
                        </button>
                    </h2>
                </div>
                <div id="pengembangan" class="collapse" aria-labelledby="headpengembangan" data-parent="#accordionExample">
                    <div class="card-body">
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
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($pengembangan as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->m_dosen->name_dsn }}</td>
                                        <td>{{ ucwords($item->m_jenis_pengdiri->name_jp) }}</td>
                                        <td>{{ $item->judul_pengdiri }}</td>
                                        <td>{{ ucwords($item->lokasi_pengdiri) }}</td>
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
                                        @if ($item->m_periode->id == 1)
                                            <td>{{ '' }}</td>
                                            <td>{{ '' }}</td>
                                        @else
                                            <td>{{ $item->m_periode->tahun }}</td>
                                            <td>{{ $item->m_periode->semester }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <div class="card-footer">
        <a class="btn btn-secondary" style="color: #060930" href="{{ route('dosen.index') }}">Back</a>
    </div>
    <!-- /.card-footer -->
@endsection
