<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Asla Med | @yield('mytitle')</title>

    <link rel="stylesheet" href="{{ asset('src/css/font-awesome.min.css') }}">
    <link href="{{ asset('src/css/select2.min.css') }}" rel="stylesheet" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="{{ asset('src/css/font.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('src/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('src/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- jsGrid -->
    <link rel="stylesheet" href="{{ asset('src/plugins/jsgrid/jsgrid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/jsgrid/jsgrid-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/toastr/toastr.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"> --}}
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('src/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('src/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('src/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('src/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('src/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('src/asset/uploadimg.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdn.metroui.org.ua/current/metro.css"> --}}
    <style>
        ::-webkit-scrollbar {
            width: 5px;

        }

        ::-webkit-scrollbar-track {
            background: #ffffff;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(#c2aefa, #ff7bf0);
            border-radius: 9px;
            width: 4px;
            height: 2px;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse">
    {{-- <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed"> --}}
    @include('sweetalert::alert')
    <div class="wrapper">

        <!-- Preloader -->
        {{-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="" alt="" height="60"
                width="60">
        </div> --}}

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-teal  navbar-light" id="nv">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-user">&nbsp;{{ Auth::user()->name }}</i>
                        {{-- <span class="badge navbar-badge">{{ Auth::user()->name }}</span> --}}
                    </a>
                    <div class="dropdown">
                        {{-- <a data-mdb-dropdown-init class="dropdown-toggle d-flex align-items-center hidden-arrow"
                            href="#" id="navbarDropdownMenuAvatar" role="button" aria-expanded="false">
                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle"
                                height="25" alt="Black and White Portrait of a Man" loading="lazy" />
                        </a> --}}
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                            <li>
                                <a class="dropdown-item" href="#">My profile</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Settings</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ url('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    Logout
                                </a>
                                <form id="frm-logout" action="{{ url('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary">
            <!-- Brand Logo -->
            <a href="" class="brand-link bg-purple">
                <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="brand-text font-weight-light"><i class=""></i>&nbsp;
                    <b>Asla</b>Med</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-2 d-flex">
                    <div class="image">
                        {{-- <img src="" class="img-circle elevation-2" alt=""> --}}
                    </div>
                    <div class="info"
                        style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size: 19px">
                        <b class="text-danger"><i class="fa fa-hospital"></i> KLINIK AULIA</b>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {{-- @if (Auth::check()) --}}
                        {{-- @if (auth()->user()->role_id == '1') --}}
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link">
                                {{-- <i class="nav-icon fa fa-syringe"></i> --}}
                                <i class="nav-icon fa fa-regular fa-home"></i>
                                <p>
                                    Home
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{-- <i class="nav-icon fas fa-bed"></i> --}}
                                <i class="nav-icon fa fa-light fa-notes-medical"></i>
                                <p>
                                    Registrasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/registrasi') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Registrasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/data-sosial') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Data Sosial</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="pages/charts/inline.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inline</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/charts/uplot.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>uPlot</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>
                        {{-- @if (auth()->user()->role_id == '2' || '1') --}}
                        {{-- <li class="nav-item">
                            <a href="{{ url('antrian') }}" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Antrian
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ url('assesment-awal') }}" class="nav-link">
                                {{-- <i class="nav-icon fa fa-syringe"></i> --}}
                                <i class="nav-icon fa fa-regular fa-book-medical"></i>
                                <p>
                                    Assesment Awal
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/tindakan-medis') }}" class="nav-link">
                                {{-- <i class="nav-icon fa fa-syringe"></i> --}}
                                <i class="nav-icon fa fa-stethoscope"></i>
                                <p>
                                    Medical Chart
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('/arsip') }}" class="nav-link">
                                {{-- <i class="nav-icon fa fa-syringe"></i> --}}
                                <i class="nav-icon fa fa-archive"></i>
                                <p>
                                    Arsip RM
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>
                        {{-- @endif --}}

                        {{-- @if (auth()->user()->role_id == '4' || '1') --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{-- <i class="nav-icon fas fa-bed"></i> --}}
                                <i class="nav-icon fa fa-light fa-pills"></i>
                                <p>
                                    Farmasi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                {{-- <li class="nav-item">
                                    <a href="{{ url('/purchase-order') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Purchase Order</p>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a href="{{ url('/delivery-order') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delivery Order</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/penjualan') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Penjualan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/adjusment-stock') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Adjusment Stock</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/buku-stok-rekap') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Info Stok</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/kartu-stok') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kartu Stok</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/pembelian-detail') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Info Pembelian Detail</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{-- <i class="nav-icon fas fa-bed"></i> --}}
                                <i class="nav-icon fa fa-money"></i>
                                <p>
                                    Kassa
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/kasir-poli') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kasir Poliklinik</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                            <a href="{{ url('/kasir-apotek') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Kasir Apotek</p>
                                            </a>
                                        </li> --}}
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{-- <i class="nav-icon fas fa-bed"></i> --}}
                                <i class="nav-icon fa fa-donate"></i>
                                <p>
                                    Accounting
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('info-hutang') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Info Hutang Rekap</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/pelunasan-hutang') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pelunasan Hutang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/laporan-laba') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Laporan Laba Rugi</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ url('#') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jurnal Umum</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('#') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buku Besar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('#') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Arus Kas</p>
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rekap Hutang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rekap Pelunasan Hutang</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                {{-- <i class="nav-icon fas fa-bed"></i> --}}
                                <i class="nav-icon fas fa-chart-line"></i>
                                <p>
                                    Laporan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/laporan-penjualan-farmasi-rekap') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Penjualan Apotek Rekap</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/laporan-penjualan-farmasi-detail') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Penjualan Apotek Detail</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/laporan-registrasi-masuk') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Registrasi Masuk</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/pendapatan-klinik-rekap') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pendapatan Klinik Rekap</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/info-tindakan') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Info Tindakan</p>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a href="{{ url('/delivery-order') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delivery Order</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/adjusment-stock') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Adjusment Stock</p>
                                    </a>
                                </li> --}}
                            </ul>
                        </li>

                        @if (auth()->user()->role_id == '1' || auth()->user()->role_id == '4')
                            <li class="nav-header">DATA MASTER APOTEK</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-pills"></i>
                                    <p>
                                        Master Apotek
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-kategori-produk') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Kategori Produk</p>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a href="{{ url('/mstr-golongan-obat') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Golongan Obat</p>
                                        </a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-satuan') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Satuan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-lokasi-stock') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Lokasi Stok</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-jenis-obat') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Golongan Obat</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-obat') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Obat</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-supplier') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Supplier</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- @endif --}}

                            <li class="nav-header">DATA MASTER KLINIK</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-wheelchair"></i>
                                    <p>
                                        Master
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-layanan') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Layanan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-medis') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Medis</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-jaminan') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Jaminan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-tindakan') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Tindakan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/mstr-nilai-tindakan') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Nilai Tindakan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/template-order-resep') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Template Resep</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-header">TOOLS</li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-gear"></i>
                                    <p>
                                        Setting
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ url('/hak-akses') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Hak Akses</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('/pricelist') }}" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Pricelist Barang</p>
                                        </a>
                                    </li>
                                    {{-- <li class="nav-item">
                                    <a href="{{ url('/mstr-medis') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Medis</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/mstr-jaminan') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jaminan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/mstr-tindakan') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tindakan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/mstr-nilai-tindakan') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nilai Tindakan</p>
                                    </a>
                                </li> --}}
                                </ul>
                            </li>
                        @endif
                        {{-- @endif --}}
                        {{-- <li class="nav-item">
                            <a href="pages/calendar.html" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right">2</span>
                                </p>
                            </a>
                        </li> --}}

                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content mb-2">
                {{-- <div class="container-fluid">
                    <div class="row" style="padding-top: 0px">
                    </div>
                </div> --}}
            </div>

            <!-- Main content -->
            <section class="content text-xs">
                <div class="container-fluid">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @yield('konten')
                </div>
            </section>
        </div>
    </div>
    </section>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <strong>&copy; 2024 <a href="">Asla Med</a>.</strong>
        All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    </div>


    <!-- Bootstrap 4 -->
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/dist/js/ajax.min.js') }}"></script>
    <script src="{{ asset('src/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{ asset('src/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
    <script src="{{ asset('src/dist/js/select2.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> --}}
    <script src="{{ asset('src/plugins/jsgrid/jsgrid.min.js') }}"></script>
    {{-- <script src="https://cdn.metroui.org.ua/current/metro.js"></script> --}}
    {{-- <script src="{{ asset('srcplugins/jsgrid/demos/db.js') }}"></script> --}}
    <!-- ChartJS -->
    <script src="{{ asset('src/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('src/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ asset('src/asset/uploadimg.js') }}"></script>

    {{-- <script src="{{ asset('src/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('src/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
    <!-- jQuery Knob Chart -->
    {{-- <script src="{{ asset('src/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
    <!-- daterangepicker -->
    <script src="{{ asset('src/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('src/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    {{-- <script src="{{ asset('src/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}

    <script src="{{ asset('src/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('src/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('src/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('src/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('src/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('src/plugins/Assesment/signature_pad.min.js') }}"></script>
    <script src="{{ asset('src/plugins/Assesment/pencoretan.v3.min.js') }}"></script>
    @stack('scripts')
    @if (Session::has('message'))
        <script>
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}", {
                        timeOut: 600,
                        positionClass: 'toast-top-right',
                    });
                    break;

                case 'warning':
                    toastr.warning("{{ Session::get('message') }}", {
                        timeOut: 600,
                        positionClass: 'toast-top-right',
                    });
                    break;

                case 'success':
                    toastr.success("{{ Session::get('message') }}", {
                        timeOut: 600,
                        positionClass: 'toast-top-right',
                    });
                    break;

                case 'error':
                    toastr.error("{{ Session::get('message') }}", {
                        timeOut: 600,
                        positionClass: 'toast-top-right',
                    });
                    break;
            }
        </script>
    @endif
    <script>
        var url = window.location;

        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).addClass('active');

        // for treeview
        $('ul.nav-treeview a').filter(function() {
            return this.href == url;
        }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "paging": true,
                "searching": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#penjualan').DataTable({
                "responsive": true,
                "paging": true,
                "searching": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#penjualan_wrapper .col-md-6:eq(0)');
            $('#exm2').DataTable({
                // "keys": true,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": false,
            });
        });

        // $('#penjualanX').DataTable({
        //     dom: 'Bfrtip',
        //     buttons: [
        //         'colvis',
        //         'excel',
        //         'print'
        //     ]
        // });

        function menuToggle() {
            const toggleMenu = document.querySelector(".menu");
            toggleMenu.classList.toggle("active");
        }
    </script>
</body>

</html>
