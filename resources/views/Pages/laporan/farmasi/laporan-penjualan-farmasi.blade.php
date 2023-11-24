@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-truck">&nbsp;</i>Laporan Penjualan Apotek Rekap</h3>
            </div>

            <div class="card-body">
                <div class="col-4 mb-4 input-group input-daterange">
                    <input type="date" id="date1" class="form-control">
                    <div class="input-group-addon">&nbsp; s.d&nbsp;</div>
                    <input type="date" id="date2" class="form-control">
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button class="btn btn-success" onclick="getDataPenjualan()" id="btnProses">Proses</button>
                </div>
                <div>
                    <table id="penjualan" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>kode Transaksi</th>
                                <th>Jenis Penjualan</th>
                                <th>Sub Total</th>
                                {{-- <th>Alasan</th>
                                <th>Dibuat Oleh</th>
                                <th></th> --}}
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                        <tfoot align="">
                            <tr>
                                <th></th>
                                <th></th>
                                <th id="grandTTL"></th>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- <input type="text" class="form-control col-4" id="grandttl"> --}}
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function getDataPenjualan() {
                var date1 = $('#date1').val();
                var date2 = $('#date2').val();

                if (date1 == '') {
                    toastr.info('Pilih Range Tanggal', 'Info!', {
                        timeOut: 2000,
                        preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                } else {
                    // $('#result').empty();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('getLaporanPenjualan') }}",
                        type: 'GET',
                        data: {
                            date1: date1,
                            date2: date2
                        },
                        success: function(isDataLaporan) {
                            $.each(isDataLaporan, function(key, datavalue) {
                                const table = $('#penjualan').DataTable();
                                const dataBaru = [
                                    [datavalue.kd_trs, datavalue.tipe_tarif, datavalue.total_penjualan],
                                ]

                                function injectDataBaru() {
                                    for (const data of dataBaru) {
                                        table.row.add([
                                            data[0],
                                            data[1],
                                            data[2],
                                        ]).draw(false)
                                    }
                                }
                                injectDataBaru()

                                toastr.success('Data Load Complete!', 'Complete!', {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                                $('#date1').val('');
                                $('#date2').val('');
                            })
                        }
                    })
                }

                // drawCallback: function() {
                // var sum = $('#penjualan').DataTable().column(3).data().sum();
                // $('#grandttl').html(sum);
                // }
            }

            new DataTable('#penjualan', {
                footerCallback: function(row, data, start, end, display) {
                    let api = this.api();

                    // Remove the formatting to get integer data for summation
                    let intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i :
                            0;
                    };

                    // Total over all pages
                    total = api
                        .column(4)
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);

                    // Total over this page
                    pageTotal = api
                        .column(4, {
                            page: 'current'
                        })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);

                    // Update footer
                    api.column(4).footer().innerHTML =
                        '$' + pageTotal + ' ( $' + total + ' total)';
                }
                // "bDestroy": true;
            });
            // var someTableDT = $("#penjualan").on("draw.dt", function() {
            //     $(this).find(".dataTables_empty").parents('tbody').empty();
            // }).DataTable
        </script>
    @endpush
@endsection
