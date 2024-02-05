@extends('pages.master')
@section('mytitle', 'Laporan Apotek')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-truck">&nbsp;</i>Laporan Penjualan Apotek Detail Item</h3>
            </div>

            <div class="card-body">
                <div class="col-5 mb-4 input-group input-daterange">
                    <input type="date" id="date1" class="form-control">
                    <div class="input-group-addon">&nbsp; s.d&nbsp;</div>
                    <input type="date" id="date2" class="form-control">
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="user" class="form-control">
                        <option value="">Select User</option>
                        @foreach ($isUser as $iu)
                            <option value="{{ $iu->name }}">{{ $iu->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button class="btn btn-success" onclick="getDataPenjualan()" id="btnProses">Proses</button>
                </div>
                <div>
                    <table id="penjualan" class="table table-hover table-striped">
                        <thead class="bg-nial">
                            <tr>
                                {{-- <th>kode Transaksi</th> --}}
                                {{-- <th>Tanggal Transaksi</th> --}}
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>QTY</th>
                                <th>Satuan</th>
                                <th>Harga Satuan</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                        <tfoot align="">
                            <tr>
                                <th></th>
                                <th></th>
                                <th id="totalQty"></th>
                                {{-- <td><b><input type="text" id="grandTTL" class="form-control" style="border: none"
                                            readonly></b>
                                </td> --}}
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
                var user = $('#user').val();

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
                        url: "{{ url('getLaporanPenjualanDetail') }}",
                        type: 'GET',
                        data: {
                            date1: date1,
                            date2: date2,
                            user: user
                        },
                        success: function(isDataLaporanDetail) {
                            var sumall = 0;
                            var table = $('#penjualan').DataTable();
                            var rows = table
                                .rows()
                                .remove()
                                .draw();
                            $.each(isDataLaporanDetail, function(key, datavalue) {
                                const table = $('#penjualan').DataTable();

                                var hrg_obatC = datavalue.hrg_obat;
                                var hrg_obatShow = hrg_obatC.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                var perkalian = datavalue.total * datavalue.hrg_obat;

                                const dataBaru = [
                                    [datavalue.kd_obat,
                                        datavalue.nm_obat, datavalue.total, datavalue.satuan,
                                        hrg_obatShow, perkalian
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
                                            // data[6],
                                            // data[7],
                                        ]).draw(false)
                                    }
                                }

                                injectDataBaru()

                                var ttlInt = parseFloat(perkalian);
                                sumall += ttlInt;

                                var number = sumall;
                                var formattedNumber = number.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                document.getElementById("grandTTL").innerHTML = formattedNumber;

                                toastr.success('Data Load Complete!', 'Complete!', {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                                $('#date1').val('');
                                $('#date2').val('');
                                $('#user').val('');
                            })
                        }
                    })
                }

                // drawCallback: function() {
                // var sum = $('#penjualan').DataTable().column(3).data().sum();
                // $('#grandttl').html(sum);
                // }
            }


            // var someTableDT = $("#penjualan").on("draw.dt", function() {
            //     $(this).find(".dataTables_empty").parents('tbody').empty();
            // }).DataTable
        </script>
    @endpush
@endsection
