@extends('pages.master')
@section('mytitle', 'Produk Terlaris')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-book">&nbsp;</i>Penjualan Produk Terlaris</h3>
            </div>

            <div class="card-body">
                <div class="col-5 mb-4 input-group input-daterange">
                    <input type="date" id="date1" class="form-control">
                    <div class="input-group-addon">&nbsp; s.d&nbsp;</div>
                    <input type="date" id="date2" class="form-control">
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="user" class="form-control" disabled>
                        <option value="">Select User</option>
                        @foreach ($isUser as $iu)
                            <option value="{{ $iu->name }}">{{ $iu->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="tipeTarif" class="form-control" disabled>
                        <option value="">Tipe Tarif</option>
                        <option value="Reguler">Reguler</option>
                        <option value="Resep">Resep</option>
                        <option value="Nakes">Nakes</option>
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button class="btn btn-success btn-sm" onclick="getDataPenjualan()" id="btnProses">Proses</button>
                    <div class="spinLoad d-flex align-items-center ml-4">
                        {{-- <strong>Loading...</strong> --}}
                        <div class="spinLoad spinner-border text-success ms-auto" role="status" aria-hidden="true"
                            id="spinLoad">
                        </div>
                    </div>
                </div>
                <div>
                    <table id="penjualan" class="table table-hover table-striped">
                        <thead class="bg-nial">
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Satuan Jual</th>
                                <th>QTY</th>
                                <th>Harga Satuan(HNA)</th>
                                <th>Harga Satuan(Jual)</th>
                                <th>Sub ttl HNA</th>
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
                                <th></th>
                                <th id="HNA"></th>
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
                var user = $('#user').val();
                var tipeTarif = $('#tipeTarif').val();

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
                        url: "{{ url('getLaporanProdukTerlaris') }}",
                        type: 'GET',
                        data: {
                            date1: date1,
                            date2: date2,
                            user: user,
                            tipeTarif: tipeTarif
                        },
                        success: function(isDataLaporanDetail) {
                            $('#HNA').empty();
                            $('#grandTTL').empty();
                            var sumall = 0;
                            var sumallHna = 0;
                            var table = $('#penjualan').DataTable();
                            var rows = table
                                .rows()
                                .remove()
                                .order(3, 'dsc')
                                .draw();
                            $.each(isDataLaporanDetail, function(key, datavalue) {
                                const table = $('#penjualan').DataTable();

                                var hrg_obatC = parseFloat(datavalue.hrg_obat);

                                var hrg_obatShow = hrg_obatC.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                var hrg_obatHnaRaw = parseFloat(datavalue.fm_hrg_beli_detail);

                                var hrg_obatHnaShow = hrg_obatHnaRaw.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                var dataRaw = datavalue.total * datavalue.hrg_obat;

                                var hnaRaw = parseFloat(datavalue.fm_hrg_beli_detail * datavalue.total);

                                var hna = hnaRaw.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                var subtotal = dataRaw.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                const dataBaru = [
                                    [datavalue.kd_obat,
                                        datavalue.nm_obat, datavalue.satuan, datavalue.total,
                                        hrg_obatHnaShow,
                                        hrg_obatShow, hna, subtotal
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
                                        ]).draw(false)
                                    }
                                }

                                injectDataBaru()

                                var ttlIntHna = parseFloat(hnaRaw);
                                sumallHna += ttlIntHna;

                                var numberHna = sumallHna;
                                var formattedNumberHna = numberHna.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                var ttlInt = parseFloat(dataRaw);
                                sumall += ttlInt;

                                var number = sumall;
                                var formattedNumber = number.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                document.getElementById("HNA").innerHTML = formattedNumberHna;
                                document.getElementById("grandTTL").innerHTML = formattedNumber;

                                toastr.success('Data Load Complete!', 'Complete!', {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                                // $('#date1').val('');
                                // $('#date2').val('');
                                $('#user').val('');
                            })
                            $('#spinLoad').hide();
                        }
                    })
                }
            }
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
