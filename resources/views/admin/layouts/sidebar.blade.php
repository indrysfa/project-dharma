<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-rocket"></i>
        </div>
        {{-- <x-application-logo class="sidebar-brand-text mx-3" /> --}}

        <div class="sidebar-brand-text mx-3">
            {{-- <img style="width: 110px" src="{{ asset('assets/images/logo-binus3.png') }}" alt=""> --}}
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Master Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Components:</h6>
                @can('view', App\Models\User::class)
                    <a class="collapse-item" href="{{ route('user.index') }}">User</a>
                @endcan
                @can('view', App\Models\Periode::class)
                    <a class="collapse-item" href="{{ route('periode.index') }}">Periode</a>
                @endcan
                @can('view', App\Models\Dosen::class)
                    <a class="collapse-item" href="{{ route('dosen.index') }}">Dosen</a>
                @endcan
                @can('view', App\Models\Jenis_pengdiri::class)
                    <a class="collapse-item" href="{{ route('jenis_pengdiri.index') }}">Jenis Peng. Diri</a>
                @endcan
                @can('view', App\Models\Jenis_penelitian::class)
                    <a class="collapse-item" href="{{ route('jenis_penelitian.index') }}">Jenis Penelitian</a>
                @endcan
            </div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pengajaran Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengajaran"
            aria-expanded="true" aria-controls="collapsePengajaran">
            <i class="fas fa-fw fa-book"></i>
            <span>Pengajaran</span>
        </a>
        <div id="collapsePengajaran" class="collapse" aria-labelledby="headingPengajaran"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('pengajaran.index') }}">Data</a>
                {{-- Fitur dimatikan belum dibutuhkan --}}
                {{-- @can('viewReport', App\Models\Pengajaran::class)
                    <a class="collapse-item" href="{{ route('pengajaran.report') }}">Report</a>
                @endcan --}}
            </div>
        </div>
    </li>

    <!-- Nav Item - Penelitian Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePenelitian"
            aria-expanded="true" aria-controls="collapsePenelitian">
            <i class="fas fa-fw fa-flask"></i>
            <span>Penelitian</span>
        </a>
        <div id="collapsePenelitian" class="collapse" aria-labelledby="headingPenelitian"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('penelitian.index') }}">Data</a>
                {{-- Fitur dimatikan belum dibutuhkan --}}
                {{-- @can('viewReport', App\Models\Penelitian::class)
                    <a class="collapse-item" href="{{ route('penelitian.report') }}">Report</a>
                @endcan --}}
            </div>
        </div>
    </li>

    <!-- Nav Item - Pengabdian Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengabdian"
            aria-expanded="true" aria-controls="collapsePengabdian">
            <i class="fas fa-fw fa-users"></i>
            <span>PKM</span>
        </a>
        <div id="collapsePengabdian" class="collapse" aria-labelledby="headingPengabdian"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('pengabdian.index') }}">Data</a>
                {{-- Fitur dimatikan belum dibutuhkan --}}
                {{-- @can('viewReport', App\Models\Pengabdian::class)
                    <a class="collapse-item" href="{{ route('pengabdian.report') }}">Report</a>
                @endcan --}}
            </div>
        </div>
    </li>

    <!-- Nav Item - Pengembangan Diri Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengembangan"
            aria-expanded="true" aria-controls="collapsePengembangan">
            <i class="fas fa-fw fa-cube"></i>
            <span>Pengembangan Diri</span>
        </a>
        <div id="collapsePengembangan" class="collapse" aria-labelledby="headingPengembangan"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('pengembangan.index') }}">Data</a>
                {{-- Fitur dimatikan belum dibutuhkan --}}
                {{-- @can('viewReport', App\Models\Pengembangan::class)
                    <a class="collapse-item" href="{{ route('pengembangan.report') }}">Report</a>
                @endcan --}}
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
