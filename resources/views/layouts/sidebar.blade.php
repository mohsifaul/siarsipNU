<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">PR. IPNU IPPNU BLABAK</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">NU</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('/') ? 'active' : '' }}">
                <a href="/" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Data Master</li>
            <li class="{{ request()->is('data-anggota*') ? 'active' : '' }}">
                <a class="nav-link" href="/data-anggota"><i class="far fa-user"></i> <span>Data Anggota</span></a>
            </li>
            <li class="{{ request()->is('data-keuangan*') ? 'active' : '' }}">
                <a class="nav-link" href="/data-keuangan"><i class="fas fa-chart-line"></i> <span>Data Keuangan</span></a>
            </li>
            <li class="dropdown {{ request()->is('surat*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-envelope"></i> <span>Arsip
                        Surat</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link {{ request()->routeIs('surat.masuk*') ? 'active' : '' }}"
                            href="{{ route('surat.masuk') }}">Surat Masuk</a></li>
                    <li><a class="nav-link {{ request()->routeIs('surat.keluar*') ? 'active' : '' }}"
                            href="{{ route('surat.keluar') }}">Surat Keluar</a></li>
                </ul>
            </li>
            <li class="menu-header">Organisasi</li>
            <li class="{{ request()->is('data-proker*') ? 'active' : '' }}">
                <a class="nav-link" href="/data-proker"><i class="fas fa-list"></i> <span>Program Kerja</span></a>
            </li>
            <li class="{{ request()->is('data-inventaris*') ? 'active' : '' }}">
                <a class="nav-link" href="/data-inventaris"><i class="fas fa-boxes"></i> <span>Invetaris</span></a>
            </li>
        </ul>
    </aside>
</div>
