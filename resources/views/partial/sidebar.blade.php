<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Kasirku</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="/transaksi">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>
    @if (auth()->user()->role_user_id == 1)
        <!-- Nav Item - Data User -->
        <li class="nav-item">
            <a class="nav-link" href="/user">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Data User</span>
            </a>
        </li>
        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="/barang">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Data Barang</span>
            </a>
        </li>
    @endif
    <!-- Nav Item - Data User -->
    <li class="nav-item">
        <a class="nav-link" href="/transaksi">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Pencatatan Transaksi</span>
        </a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->
    @if (auth()->user()->role_user_id == 1)
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Cari Transaksi</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Cari Berdasar:</h6>
                    <a class="collapse-item" href="/transaksi-cari/tanggal">Tanggal</a>
                    <a class="collapse-item" href="/transaksi-cari/totalharga">Total Harga</a>
                    <a class="collapse-item" href="/transaksi-cari/kombinasi">Kombinasi Barang</a>
                </div>
            </div>
        </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-cog"></i> <span> Logout </span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>