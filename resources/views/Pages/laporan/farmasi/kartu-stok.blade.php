@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-phills">&nbsp;</i>Kartu Stok Barang</h3>
            </div>

            <div class="card-body">
                <div class="col-4 mb-4 input-group input-daterange">
                    <input type="date" id="date1" class="form-control">
                    <div class="input-group-addon">&nbsp; s.d&nbsp;</div>
                    <input type="date" id="date2" class="form-control">
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button class="btn btn-success" onclick="getDataPenjualan()" id="btnProses">Proses</button>
                </div>

                <div id="accordion" class="cardItems">
                    {{-- <div class="card-outline card-danger">
                        <div class="card-header">
                            <h4 class="card-title w-100">
                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                    Nama Obat
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
                            <div class="card-body">
                                <div>
                                    <table id="penjualan" class="table table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Kode Ref</th>
                                                <th>Supplier/Pelanggan</th>
                                                <th>Batch No.</th>
                                                <th>Exp. Date</th>
                                                <th>Qty Awal</th>
                                                <th>Qty Masuk</th>
                                                <th>Qty Keluar</th>
                                                <th>Qty Akhir</th>
                                                <th>HPP</th>
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
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th id="grandTTL"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                        url: "{{ url('getKartuStok') }}",
                        type: 'GET',
                        data: {
                            date1: date1,
                            date2: date2
                        },
                        success: function(isKartuStock) {
                            $.each(isKartuStock, function(key, datavalueHdr) {
                                var itemHdr = datavalueHdr.ksh_kd_obat;
                                $('.cardItems').append(
                                    ` <div class="card-outline card-danger">
                                        <div class="card-header">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne" aria-expanded="true">
                                                    ${datavalueHdr.ksh_nm_obat}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordion" style="">
                                            <div class="card-body">
                                                <div>
                                                    <table id="penjualan" class="kartustok table table-hover table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Tanggal</th>
                                                                <th>Kode Ref</th>
                                                                <th>Supplier/Pelanggan</th>
                                                                <th>Batch No.</th>
                                                                <th>Exp. Date</th>
                                                                <th>Qty Awal</th>
                                                                <th>Qty Masuk</th>
                                                                <th>Qty Keluar</th>
                                                                <th>Qty Akhir</th>
                                                                <th>HPP</th>
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
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th id="grandTTL"></th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                                )
                            });
                            var sumall = 0;
                            var table = $('#penjualan').DataTable();
                            var rows = table
                                .rows()
                                .remove()
                                .draw();
                            $.each(isKartuStock, function(key, datavalue) {
                                const table = $('#penjualan').DataTable();
                                // const itemHdr = datavalue.ksh_kd_obat;
                                const itemDetail = datavalue.kd_obat;
                                if (itemHdr == itemDetail) {
                                    const dataBaru = [
                                        [datavalue.tanggal_trs, datavalue.kd_trs, datavalue.supplier,
                                            datavalue.no_batch, datavalue.expired_date, datavalue
                                            .qty_awal,
                                            datavalue.qty_masuk, datavalue.qty_keluar, datavalue
                                            .qty_akhir,
                                            datavalue.hpp_satuan,
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
                                                data[6],
                                                data[7],
                                                data[8],
                                                data[9],
                                            ]).draw(false)
                                        }
                                    }

                                    injectDataBaru()
                                } else {
                                    // const dataBaru = '';
                                }


                                // var ttlInt = parseFloat(datavalue.total_penjualan);
                                // sumall += ttlInt;

                                // var number = sumall;
                                // var formattedNumber = number.toLocaleString('id-ID', {
                                //     style: 'currency',
                                //     currency: 'IDR'
                                // });

                                // document.getElementById("grandTTL").innerHTML = formattedNumber;

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
            }
        </script>
    @endpush
@endsection
