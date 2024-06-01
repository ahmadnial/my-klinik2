@extends('pages.master')

@section('mytitle', 'Home')
@section('konten')
    <!-- Main content -->

    <div class="content">
        <div class="container-fluid">
            <div class="col">
                <div class="">
                    <div id="getMonthSales" class="mb-2 mt-2"></div>
                    <div id="getMonthPembelian" class="mb-2 mt-2"></div>
                    <div id="getObatTerlaris" class="mb-2 mt-2"></div>
                    <div id="kunjunganPasien" class="mb-2 mt-2"></div>
                    <div id="topTenDiagnosa" class="mb-2 mt-2"></div>
                </div>
            </div>
            {{-- <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- interactive chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        Interactive Area Chart
                                    </h3>

                                    <div class="card-tools">
                                        Real time
                                        <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                                            <button type="button" class="btn btn-default btn-sm active"
                                                data-toggle="on">On</button>
                                            <button type="button" class="btn btn-default btn-sm"
                                                data-toggle="off">Off</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="interactive" style="height: 300px;"></div>
                                </div>
                                <!-- /.card-body-->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Line chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        Line Chart
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="line-chart" style="height: 300px;"></div>
                                </div>
                                <!-- /.card-body-->
                            </div>
                            <!-- /.card -->

                            <!-- Area chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        Area Chart
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="area-chart" style="height: 338px;" class="full-width-chart"></div>
                                </div>
                                <!-- /.card-body-->
                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.col -->

                        <div class="col-md-6">
                            <!-- Bar chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        Bar Chart
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="bar-chart" style="height: 300px;"></div>
                                </div>
                                <!-- /.card-body-->
                            </div>
                            <!-- /.card -->

                            <!-- Donut chart -->
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="far fa-chart-bar"></i>
                                        Donut Chart
                                    </h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="donut-chart" style="height: 300px;"></div>
                                </div>
                                <!-- /.card-body-->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section> --}}
            <div class="row">

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
@push('scripts')
    <script>
        var getMonthSales = <?php echo json_encode($getMonthSales); ?>;
        var bulanPenjualan = <?php echo json_encode($bulanPenjualan); ?>;
        Highcharts.chart('getMonthSales', {
            title: {
                text: 'Grafik Penjualan Apotek'
            },
            subtitle: {
                text: 'Source: Trs Penjualan Apotek'
            },
            xAxis: {
                categories: bulanPenjualan
            },
            yAxis: {
                title: {
                    text: 'IDR'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Nilai Penj.',
                data: getMonthSales
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

        // chart pembelian barang

        var getMonthPembelian = <?php echo json_encode($getMonthPembelian); ?>;
        var bulanPembelian = <?php echo json_encode($bulanPembelian); ?>;
        Highcharts.chart('getMonthPembelian', {
            title: {
                text: 'Grafik Pembelian Apotek'
            },
            subtitle: {
                text: 'Source: Trs Pembelian Obat (DO)'
            },
            xAxis: {
                categories: bulanPembelian
            },
            yAxis: {
                title: {
                    text: 'IDR'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Nilai Pemb.',
                data: getMonthPembelian
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

        // Obat Terlaris TOP 10

        var obatTerlarisQty = <?php echo json_encode($obatTerlarisQty); ?>;
        var obatTerlarisName = <?php echo json_encode($obatTerlarisName); ?>;
        Highcharts.chart('getObatTerlaris', {
            title: {
                text: 'Grafik TOP 10 Obat Terlaris '
            },
            subtitle: {
                text: 'Source: Trs Penjualan Apotek'
            },
            xAxis: {
                categories: obatTerlarisName
            },
            yAxis: {
                title: {
                    text: 'IDR'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'QTY pnj.',
                data: obatTerlarisQty
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

        // Kunjungan Pasien Klinik

        var kunjunganPasien = <?php echo json_encode($kunjunganPasien); ?>;
        var bulanKunjungan = <?php echo json_encode($bulanKunjungan); ?>;
        Highcharts.chart('kunjunganPasien', {
            title: {
                text: 'Grafik Kunjungan Pasien Klinik'
            },
            subtitle: {
                text: 'Source: Trs Registrasi'
            },
            xAxis: {
                categories: bulanKunjungan
            },
            yAxis: {
                title: {
                    text: 'Pengunjung'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Total Pengunjung',
                data: kunjunganPasien
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });

        // TOP 10 Diagnosa

        var topTenDiagnosa = <?php echo json_encode($topTenDiagnosa); ?>;
        var topTenDiagnosaName = <?php echo json_encode($topTenDiagnosaName); ?>;
        Highcharts.chart('topTenDiagnosa', {
            title: {
                text: 'Grafik 10 Besar Penyakit'
            },
            subtitle: {
                text: 'Source: Trs SOAP (Bulan Ini)'
            },
            xAxis: {
                categories: topTenDiagnosaName
            },
            yAxis: {
                title: {
                    text: 'Diagnosa'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'Total diag.',
                data: topTenDiagnosa
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
        });
    </script>
@endpush
