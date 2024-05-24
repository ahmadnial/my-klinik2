@extends('pages.master')
@section('mytitle', 'Info Stok')
@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-truck">&nbsp;</i>Buku Stok Barang</h3>
            </div>

            <div class="card-body">
                <div class="col-2 mb-4 input-group input-daterange" id="buttonGetStok">
                    <select id="kondisiStock" class="form-control">
                        <option value="">Kondisi Stock</option>
                        <option value="ada">Stock Ada</option>
                        <option value="kosong">Stock Kosong</option>
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button class="btn btn-success" onclick="getDataPenjualan()" id="btnProses">Proses</button>
                    <div class="spinLoad d-flex align-items-center ml-4">
                        {{-- <strong>Loading...</strong> --}}
                        <div class="spinLoad spinner-border text-success ms-auto" role="status" aria-hidden="true"
                            id="spinLoad">
                        </div>
                    </div>
                </div>
                <div>
                    <table id="example1" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Qty Stok</th>
                                <th>Satuan</th>
                                <th>Harga Beli Satuan</th>
                                <th>Nilai Persediaan</th>
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                        <tfoot align="">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
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
                $('#spinLoad').show();
                var date1 = $('#date1').val();
                var date2 = $('#date2').val();
                var kondisiStock = $('#kondisiStock').val();

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
                        url: "{{ url('getBukuStok') }}",
                        type: 'GET',
                        data: {
                            date1: date1,
                            date2: date2,
                            kondisiStock: kondisiStock
                        },
                        success: function(isDataBukuStok) {
                            var sumall = 0;
                            $('#spinLoad').hide();

                            // $('#buttonGetStok').hide();

                            $.each(isDataBukuStok, function(key, datavalue) {
                                const table = $('#example1').DataTable();
                                var nilai_persediaan = datavalue.qty * datavalue.fm_hrg_beli_detail;

                                var number = nilai_persediaan;
                                var formattedNumber = number.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                var hrg_beli = Number(datavalue.fm_hrg_beli_detail);
                                var hrg_beli_currency = hrg_beli.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                const dataBaru = [
                                    [datavalue.kd_obat, datavalue.nm_obat, datavalue.qty, datavalue
                                        .satuan, hrg_beli_currency, formattedNumber
                                    ],
                                ]

                                function injectDataBaru() {
                                    for (const data of dataBaru) {
                                        table.row.add([
                                            data[0],
                                            data[1],
                                            data[2],
                                            data[3],
                                            data[4],
                                            data[5],
                                        ]).draw(false)
                                    }
                                }
                                injectDataBaru()

                                var ttlInt = parseFloat(nilai_persediaan);
                                sumall += ttlInt;

                                var number2 = sumall;
                                var formattedNumber2 = number2.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                document.getElementById("grandTTL").innerHTML = formattedNumber2;

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
            $('.spinLoad')
                .hide() // Hide it initially
                .ajaxStart(function() {
                    $(this).show();
                })
                .ajaxStop(function() {
                    $(this).hide();
                });
        </script>
    @endpush
@endsection
