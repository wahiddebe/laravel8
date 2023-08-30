<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/Logo.svg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Yogasmara</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa fa-home"></i>
                            <p>
                                Home
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.hero') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hero</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.lingkup') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lingkup Kegiatan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.nilai') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nilai Utama</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-laptop"></i>
                            <p>
                                Tentang Kami
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.tentang-kami') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Hero & Visi-Misi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.tentang-kami.layanan') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Layanan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-newspaper"></i>
                            <p>
                                Informasi
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ " /admin/informasi/1" }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Autisme</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ " /admin/informasi/2" }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Disabilitas </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-newspaper"></i>
                            <p>
                                Berita & Artikel
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.kategori') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.berita') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Berita & Artikel</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.artikel') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Perkumpulan Pemuda/i Autisma Yogasmara</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-shopping-bag"></i>
                            <p>
                                Yogasmarahop
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.shop') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Yogasmarashop</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-list"></i>
                            <p>
                                Kuisioner
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.kuisioner.kategori') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.kuisioner.subkategori') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sub Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hasil.kategori') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kunci Jawaban</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.kuisioner') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List Pertanyaan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.hasil.kuisioner') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Kuisioner Terisi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-share"></i>
                            <p>
                                Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.setting') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sosial Media & Contact</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header"></li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="nav-link">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
