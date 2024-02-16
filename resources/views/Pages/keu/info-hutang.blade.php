@extends('pages.master')
@section('mytitle', 'Info Tindakan')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user">&nbsp;</i>Info Hutang Rekap</h3>
            </div>

            <div class="card-body">
                <div class="col-8 mb-3 input-group input-daterange">
                    <input type="date" id="date1" class="form-control">
                    <div class="input-group-addon">&nbsp; s.d&nbsp;</div>
                    <input type="date" id="date2" class="form-control">
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="Supplier" class="form-control">
                        <option value=""></option>
                        @foreach ($isSupplier as $dr)
                            <option value="{{ $dr->hs_supplier }}">{{ $dr->hs_supplier }}</option>
                        @endforeach
                    </select>
                    {{-- <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="tindakan" class="form-control">
                        <option value="">Tindakan</option>
                        @foreach ($isMstrTdk as $tdk)
                            <option value="{{ $tdk->id }}">{{ $tdk->nm_tindakan }}</option>
                        @endforeach
                    </select> --}}
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button class="btn btn-success" onclick="getInfoTdk()" id="btnProses">Proses</button>
                </div>
                <div>
                    <table id="penjualan" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Trs</th>
                                <th>Tanggal</th>
                                <th>No.Faktur</th>
                                <th>Supplier</th>
                                <th>Tanggal tempo</th>
                                <th>Jumlah Hutang</th>
                                <th>jumlah Bayar</th>
                                <th>Potongan</th>
                                <th>Sisa Hutang</th>
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                        {{-- <tfoot align="">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td><b><input type="text" id="grandTTL" class="form-control" style="border: none"
                                            readonly></b>
                                </td>
                                <th id="grandTTL"></th>
                            </tr>
                        </tfoot> --}}
                    </table>
                    {{-- <input type="text" class="form-control col-4" id="grandttl"> --}}
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            $('#Supplier').select2({
                placeholder: 'Search Supplier',
            });

            function getInfoTdk() {
                var date1 = $('#date1').val();
                var date2 = $('#date2').val();
                var supplier = $('#Supplier').val();

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
                        url: "{{ url('getinfohutang') }}",
                        type: 'GET',
                        data: {
                            date1: date1,
                            date2: date2,
                            supplier: supplier,
                        },
                        success: function(isDataHutang) {
                            var sumall = 0;
                            var table = $('#penjualan').DataTable();
                            var rows = table
                                .rows()
                                .remove()
                                .draw();
                            $.each(isDataHutang, function(key, datavalue) {
                                const table = $('#penjualan').DataTable();

                                const dateToConvert = datavalue.hs_tanggal_trs;
                                const dateObject = new Date(dateToConvert);
                                const options = {
                                    dateStyle: 'full'
                                };
                                const formattedDate = dateObject.toLocaleDateString('id-ID', options);

                                const dateToConvertTmp = datavalue.hs_tanggal_tempo;
                                const dateObjectTmp = new Date(dateToConvertTmp);
                                const optionsTmp = {
                                    dateStyle: 'full'
                                };
                                const formattedDateTmp = dateObjectTmp.toLocaleDateString('id-ID',
                                    optionsTmp);


                                var jmlHutang = parseFloat(datavalue.hs_nilai_hutang);

                                var jmlHtgCurrency = jmlHutang.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                var jmlBayar = parseFloat(datavalue.hs_pembayaran);

                                var jmlByrCurrency = jmlBayar.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                var jmlPot = parseFloat(datavalue.hs_potongan);

                                var jmlPotCurrency = jmlPot.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                var akhirInt = parseFloat(datavalue.hs_hutang_akhir);

                                var akhirCurrency = akhirInt.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                const dataBaru = [
                                    [datavalue.hs_kd_hutang, formattedDate, datavalue.hs_no_faktur,
                                        datavalue.hs_supplier, formattedDateTmp,
                                        jmlHtgCurrency, jmlByrCurrency, jmlPotCurrency,
                                        akhirCurrency,
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
                                            // data[9]
                                        ]).draw(false)
                                    }
                                }

                                injectDataBaru();

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


            // var someTableDT = $("#penjualan").on("draw.dt", function() {
            //     $(this).find(".dataTables_empty").parents('tbody').empty();
            // }).DataTable
        </script>
    @endpush
@endsection
