@extends('pages.master')

@section('mytitle', 'Home')
@section('konten')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Soon</h3>
                                <a href="javascript:void(0);">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">000</span>
                                    <span>Soon</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 12.5%
                                    </span>
                                    <span class="text-muted">Soon</span>
                                </p>
                            </div>
                            <div class="position-relative mb-4">
                                <canvas id="visitors-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i>Soon
                                </span>

                                <span>
                                    <i class="fas fa-square text-gray"></i>Soon
                                </span>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Informasi Jatuh Tempo Supplier</h3>
                                <a href="javascript:void(0);">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">$18,230.00</span>
                                    <span>Sales Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 33.1%
                                    </span>
                                    <span class="text-muted">Since last month</span>
                                </p>
                            </div> --}}
                            <!-- /.d-flex -->

                            <table id="exm2" class="table table-striped table-bordered table-responsive">
                                <thead class="bg-nial">
                                    <tr>
                                        <th>Kode DO</th>
                                        <th>No.Faktur</th>
                                        <th>Supplier/Distributor</th>
                                        <th>Tgl tempo</th>
                                        <th>Nilai Hutang</th>
                                        <th>Pembayaran</th>
                                        <th>Hutang Akhir</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($isFakturTempo as $isft)
                                        <tr>
                                            <td>{{ $isft->hs_kd_hutang_buat }}</td>
                                            <td>{{ $isft->hs_no_faktur }}</td>
                                            <td>{{ $isft->hs_supplier }}</td>
                                            <td>{{ date('D,d-M-Y', strtotime($isft->hs_tanggal_tempo)) }}</td>
                                            <td>@currency($isft->hs_nilai_hutang)</td>
                                            <td>@currency($isft->hs_pembayaran)</td>
                                            <td>@currency($isft->hs_hutang_akhir)</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> This year
                                </span>

                                <span>
                                    <i class="fas fa-square text-gray"></i> Last year
                                </span>
                            </div> --}}
                        </div>
                    </div>
                    <!-- /.card -->

                    {{-- <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Soon</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-sm btn-tool">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-tool">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-success text-xl">
                                    <i class="ion ion-ios-refresh-empty"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="ion ion-android-arrow-up text-success"></i> 12%
                                    </span>
                                    <span class="text-muted">SOON </span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                                    </span>
                                    <span class="text-muted">Soon</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <p class="text-danger text-xl">
                                    <i class="ion ion-ios-people-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="ion ion-android-arrow-down text-danger"></i> 1%
                                    </span>
                                    <span class="text-muted">Soon</span>
                                </p>
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Informasi Obat Defacta</h3>
                                <a href="javascript:void(0);">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">$18,230.00</span>
                                    <span>Sales Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> 33.1%
                                    </span>
                                    <span class="text-muted">Since last month</span>
                                </p>
                            </div> --}}
                            <!-- /.d-flex -->

                            <table id="" class="table table-striped table-bordered">
                                <thead class="bg-nial">
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Stock</th>
                                        <th>Kebutuhan /Bulan</th>
                                        <th>Satuan Beli</th>
                                        <th>Satuan Jual</th>
                                        {{-- <th>Supplier</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($isDefacta as $defacta)
                                        <tr>
                                            <td>{{ $defacta->fm_kd_obat }}</td>
                                            <td>{{ $defacta->fm_nm_obat }}</td>
                                            <td>{{ $defacta->qty }}</td>
                                            <td></td>
                                            <td>{{ $defacta->fm_satuan_pembelian }}</td>
                                            <td>{{ $defacta->fm_satuan_jual }}</td>
                                            {{-- <td>{{ $defacta->fm_kd_obat }}</td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> This year
                                </span>

                                <span>
                                    <i class="fas fa-square text-gray"></i> Last year
                                </span>
                            </div> --}}
                        </div>
                    </div>
                    <!-- /.card -->

                    {{-- <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Soon</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-sm btn-tool">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-tool">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-success text-xl">
                                    <i class="ion ion-ios-refresh-empty"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="ion ion-android-arrow-up text-success"></i> 12%
                                    </span>
                                    <span class="text-muted">SOON </span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                <p class="text-warning text-xl">
                                    <i class="ion ion-ios-cart-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                                    </span>
                                    <span class="text-muted">Soon</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->
                            <div class="d-flex justify-content-between align-items-center mb-0">
                                <p class="text-danger text-xl">
                                    <i class="ion ion-ios-people-outline"></i>
                                </p>
                                <p class="d-flex flex-column text-right">
                                    <span class="font-weight-bold">
                                        <i class="ion ion-android-arrow-down text-danger"></i> 1%
                                    </span>
                                    <span class="text-muted">Soon</span>
                                </p>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
@endsection
