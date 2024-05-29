@extends('pages.master')

@section('mytitle', 'Home')
@section('konten')
    <!-- Main content -->

    <div class="content">
        <div class="container-fluid">
            <div id="getMonthSales" class="mb-3 mt-2"></div>
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
                text: 'Laporan Penjualan Apotek'
            },
            subtitle: {
                text: 'Source: Apotek Aulia'
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

        // $(function() {
        //     /*
        //      * Flot Interactive Chart
        //      * -----------------------
        //      */
        //     // We use an inline data source in the example, usually data would
        //     // be fetched from a server
        //     var data = [],
        //         totalPoints = 100

        //     function getRandomData() {

        //         if (data.length > 0) {
        //             data = data.slice(1)
        //         }

        //         // Do a random walk
        //         while (data.length < totalPoints) {

        //             var prev = data.length > 0 ? data[data.length - 1] : 50,
        //                 y = prev + Math.random() * 10 - 5

        //             if (y < 0) {
        //                 y = 0
        //             } else if (y > 100) {
        //                 y = 100
        //             }

        //             data.push(y)
        //         }

        //         // Zip the generated y values with the x values
        //         var res = []
        //         for (var i = 0; i < data.length; ++i) {
        //             res.push([i, data[i]])
        //         }

        //         return res
        //     }

        //     var interactive_plot = $.plot('#interactive', [{
        //         data: getRandomData(),
        //     }], {
        //         grid: {
        //             borderColor: '#f3f3f3',
        //             borderWidth: 1,
        //             tickColor: '#f3f3f3'
        //         },
        //         series: {
        //             color: '#3c8dbc',
        //             lines: {
        //                 lineWidth: 2,
        //                 show: true,
        //                 fill: true,
        //             },
        //         },
        //         yaxis: {
        //             min: 0,
        //             max: 100,
        //             show: true
        //         },
        //         xaxis: {
        //             show: true
        //         }
        //     })

        //     var updateInterval = 500 //Fetch data ever x milliseconds
        //     var realtime = 'on' //If == to on then fetch data every x seconds. else stop fetching
        //     function update() {

        //         interactive_plot.setData([getRandomData()])

        //         // Since the axes don't change, we don't need to call plot.setupGrid()
        //         interactive_plot.draw()
        //         if (realtime === 'on') {
        //             setTimeout(update, updateInterval)
        //         }
        //     }

        //     //INITIALIZE REALTIME DATA FETCHING
        //     if (realtime === 'on') {
        //         update()
        //     }
        //     //REALTIME TOGGLE
        //     $('#realtime .btn').click(function() {
        //         if ($(this).data('toggle') === 'on') {
        //             realtime = 'on'
        //         } else {
        //             realtime = 'off'
        //         }
        //         update()
        //     })
        //     /*
        //      * END INTERACTIVE CHART
        //      */


        //     /*
        //      * LINE CHART
        //      * ----------
        //      */
        //     //LINE randomly generated data

        //     var sin = [],
        //         cos = []
        //     for (var i = 0; i < 14; i += 0.5) {
        //         sin.push([i, Math.sin(i)])
        //         cos.push([i, Math.cos(i)])
        //     }
        //     var line_data1 = {
        //         data: sin,
        //         color: '#3c8dbc'
        //     }
        //     var line_data2 = {
        //         data: cos,
        //         color: '#00c0ef'
        //     }
        //     $.plot('#line-chart', [line_data1, line_data2], {
        //         grid: {
        //             hoverable: true,
        //             borderColor: '#f3f3f3',
        //             borderWidth: 1,
        //             tickColor: '#f3f3f3'
        //         },
        //         series: {
        //             shadowSize: 0,
        //             lines: {
        //                 show: true
        //             },
        //             points: {
        //                 show: true
        //             }
        //         },
        //         lines: {
        //             fill: false,
        //             color: ['#3c8dbc', '#f56954']
        //         },
        //         yaxis: {
        //             show: true
        //         },
        //         xaxis: {
        //             show: true
        //         }
        //     })
        //     //Initialize tooltip on hover
        //     $('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
        //         position: 'absolute',
        //         display: 'none',
        //         opacity: 0.8
        //     }).appendTo('body')
        //     $('#line-chart').bind('plothover', function(event, pos, item) {

        //         if (item) {
        //             var x = item.datapoint[0].toFixed(2),
        //                 y = item.datapoint[1].toFixed(2)

        //             $('#line-chart-tooltip').html(item.series.label + ' of ' + x + ' = ' + y)
        //                 .css({
        //                     top: item.pageY + 5,
        //                     left: item.pageX + 5
        //                 })
        //                 .fadeIn(200)
        //         } else {
        //             $('#line-chart-tooltip').hide()
        //         }

        //     })
        //     /* END LINE CHART */

        //     /*
        //      * FULL WIDTH STATIC AREA CHART
        //      * -----------------
        //      */
        //     var areaData = [
        //         [2, 88.0],
        //         [3, 93.3],
        //         [4, 102.0],
        //         [5, 108.5],
        //         [6, 115.7],
        //         [7, 115.6],
        //         [8, 124.6],
        //         [9, 130.3],
        //         [10, 134.3],
        //         [11, 141.4],
        //         [12, 146.5],
        //         [13, 151.7],
        //         [14, 159.9],
        //         [15, 165.4],
        //         [16, 167.8],
        //         [17, 168.7],
        //         [18, 169.5],
        //         [19, 168.0]
        //     ]
        //     $.plot('#area-chart', [areaData], {
        //         grid: {
        //             borderWidth: 0
        //         },
        //         series: {
        //             shadowSize: 0, // Drawing is faster without shadows
        //             color: '#00c0ef',
        //             lines: {
        //                 fill: true //Converts the line chart to area chart
        //             },
        //         },
        //         yaxis: {
        //             show: false
        //         },
        //         xaxis: {
        //             show: false
        //         }
        //     })

        //     /* END AREA CHART */

        //     /*
        //      * BAR CHART
        //      * ---------
        //      */

        //     var bar_data = {
        //         data: [
        //             [1, 10],
        //             [2, 8],
        //             [3, 4],
        //             [4, 13],
        //             [5, 17],
        //             [6, 9]
        //         ],
        //         bars: {
        //             show: true
        //         }
        //     }
        //     $.plot('#bar-chart', [bar_data], {
        //         grid: {
        //             borderWidth: 1,
        //             borderColor: '#f3f3f3',
        //             tickColor: '#f3f3f3'
        //         },
        //         series: {
        //             bars: {
        //                 show: true,
        //                 barWidth: 0.5,
        //                 align: 'center',
        //             },
        //         },
        //         colors: ['#3c8dbc'],
        //         xaxis: {
        //             ticks: [
        //                 [1, 'January'],
        //                 [2, 'February'],
        //                 [3, 'March'],
        //                 [4, 'April'],
        //                 [5, 'May'],
        //                 [6, 'June']
        //             ]
        //         }
        //     })
        //     /* END BAR CHART */

        //     /*
        //      * DONUT CHART
        //      * -----------
        //      */

        //     var donutData = [{
        //             label: 'Series2',
        //             data: 30,
        //             color: '#3c8dbc'
        //         },
        //         {
        //             label: 'Series3',
        //             data: 20,
        //             color: '#0073b7'
        //         },
        //         {
        //             label: 'Series4',
        //             data: 50,
        //             color: '#00c0ef'
        //         }
        //     ]
        //     $.plot('#donut-chart', donutData, {
        //         series: {
        //             pie: {
        //                 show: true,
        //                 radius: 1,
        //                 innerRadius: 0.5,
        //                 label: {
        //                     show: true,
        //                     radius: 2 / 3,
        //                     formatter: labelFormatter,
        //                     threshold: 0.1
        //                 }

        //             }
        //         },
        //         legend: {
        //             show: false
        //         }
        //     })
        //     /*
        //      * END DONUT CHART
        //      */

        // })

        // /*
        //  * Custom Label formatter
        //  * ----------------------
        //  */
        // function labelFormatter(label, series) {
        //     return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">' +
        //         label +
        //         '<br>' +
        //         Math.round(series.percent) + '%</div>'
        // }
    </script>
@endpush
