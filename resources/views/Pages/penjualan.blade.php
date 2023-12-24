@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#addPenjualan"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                <h3 class="card-title"><i class="fa fa-money">&nbsp;</i>Transaksi Penjualan</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example1" class="table table-hover">
                        <thead class="" style="background-color:rgb(242, 231, 255)">
                            <tr>
                                {{-- <th>Tanggal</th> --}}
                                <th>Tanggal Transaksi</th>
                                <th>No Transaksi</th>
                                <th>Layanan Penjualan</th>
                                <th>Pasien</th>
                                <th>No.RM</th>
                                <th>Tipe Tarif</th>
                                <th>Total Penjualan</th>
                                <th>Act</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($isListPenjualan as $lp)
                                <tr>
                                    <td id="">{{ $lp->created_at->format('d M Y h:i A') }}</td>
                                    {{-- <td id="">{{ $lp->created_at }}</td> --}}
                                    <td id="">{{ $lp->kd_trs }}</td>
                                    <td id="">
                                        @if ($lp->no_mr == null)
                                            <span class="badge badge-danger">Apotek</span>
                                        @else
                                            <span class="badge badge-primary">Resep Klinik</span>
                                        @endif
                                    </td>
                                    <td id="">{{ $lp->no_mr }}</td>
                                    <td id="">{{ $lp->nm_pasien }}</td>
                                    <td id="">{{ $lp->tipe_tarif }}</td>
                                    <td id="">@currency($lp->total_penjualan)</td>
                                    <td><button class="btn btn-xs btn-info" data-toggle="modal" data-target="#EditObat"
                                            onclick="getDetailPen(this)" data-kd_trs={{ $lp->kd_trs }}>Detail</button>
                                        {{-- <a class="btn btn-default" href="{{ url('nota') }}" target="_blank"><i
                                                class="fa fa-print"></i> Cetak PDF</a> --}}
                                        <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#EditObat"
                                            onclick="cetakNota(this)" data-kd_trsc={{ $lp->kd_trs }} target="_blank"> <i
                                                class="fa fa-print"></i>Print </button>
                                        {{-- <button class="btn btn-xs btn-danger" data-toggle="modal"
                                            data-target="#DeleteSupplier">Hapus</button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <style>
        .modal {
            padding: 0 !important; // override inline padding-right added from js
        }

        #addPenjualan .fullmodal {
            width: 100%;
            max-width: 98%;
            height: auto;
            margin: 40;
        }

        .scrollable-table {
            /* overflow-y: initial !important */
            max-height: 300px;
            overflow-y: auto;
        }

        .modal-footer {
            position: sticky;
            bottom: 0;
            background-color: #f8f9fa;
            padding: 10px;
            padding-right: 10px;
        }
    </style>
    <!-- The modal Create -->
    <div class="modal fade" id="addPenjualan" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable fullmodal">
            <div class="modal-content" role="document">
                <div class="modal-header bg-nial">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Transaksi Penjualan</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('add-penjualan') }}" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="">kd trs</label>
                                <input type="text" class="form-control" name="tp_kd_trs" id="tp_kd_trs"
                                    value="{{ $noRef }}" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">kd Reg</label>
                                <select class="form-control" id="tp_kd_order" style="width: 100%;" name="tp_kd_order"
                                    onchange="acMapResep()">
                                    <option value="">--Select--</option>
                                    @foreach ($isListRegResep as $lrp)
                                        <option value="{{ $lrp->kd_trs }}">{{ $lrp->kd_reg . '-' . $lrp->nm_pasien }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tgl Transaksi</label>
                                <input type="date" class="form-control" name="tgl_trs" id="tgl_trs"
                                    value="{{ $dateNow }}">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Resep Dari</label>
                                <input type="text" class="form-control" name="tp_layanan" id="tp_layanan" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Dokter</label>
                                <input type="text" class="form-control" name="tp_dokter" id="tp_dokter" value=""
                                    readonly>
                            </div>
                            {{-- <div class="form-group col-sm-2">
                                <label for="">Lokasi Stock</label>
                                <select class="form-control-pasien" id="tp_lokasi_stock" style="width: 100%;"
                                    name="tp_lokasi_stock">
                                    <option value="">--Select--</option>

                                </select>
                            </div> --}}
                            <br>
                            <hr>
                            <div class="form-group col-sm-2">
                                <label for="">kd.Registrasi</label>
                                <input type="text" class="form-control" name="tp_kd_reg" id="tp_kd_reg" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">No.RM</label>
                                <input type="text" class="form-control" name="tp_no_mr" id="tp_no_mr"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="tp_nama" id="tp_nama" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Alamat</label>
                                <textarea type="text" class="form-control" name="tp_alamat" id="tp_alamat" value="" readonly></textarea>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="tp_jenis_kelamin" id="tp_jenis_kelamin"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tgl Lahir</label>
                                <input type="text" class="form-control" name="tp_tgl_lahir" id="tp_tgl_lahir"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tipe Tarif</label>
                                <select class="form-control-pasien" onchange="getTipeTarif()" id="tp_tipe_tarif"
                                    style="width: 100%;" name="tp_tipe_tarif">
                                    <option value="">--Select--</option>
                                    <option value="Reguler">Reguler</option>
                                    <option value="Resep">Resep</option>
                                    <option value="Nakes">Nakes</option>
                                </select>
                            </div>
                            <input type="hidden" id="user" name="user" value="tes">
                        </div>
                        <div class="">
                            <button type="button" id="obatSearch" onClick="searchObatShow()"
                                class="btn btn-info float-right"><i class="fa fa-plus">&nbsp;Item</i></button>
                        </div>
                    </div>

                    {{-- <hr> --}}
                    <div class="scrollable-table">
                        <table class="table table-scroll table-stripped table-bordered" id="">
                            <thead>
                                <tr>
                                    <th width="130px">kd obat</th>
                                    <th width="350px">Nama Obat</th>
                                    {{-- <th>Dosis</th> --}}
                                    <th width="110px">Satuan</th>
                                    <th width="110px">Harga</th>
                                    <th width="100px">Qty</th>
                                    <th width="110px">Cara Pakai</th>
                                    <th width="110px">Disc(Rp.)</th>
                                    <th width="90px">Tuslah</th>
                                    <th width="90px">Embalase</th>
                                    <th width="200px">Sub Total</th>
                                    <th width="50px"></th>
                                </tr>
                            </thead>

                            <tbody class="ListObatJual" id="ListObatJual">

                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="float-right col-4">
                        <input type="hidden" class="form-control float-right" name="total_penjualan"
                            id="total_penjualan">
                        <div class="float-right col-4">
                            <input type="text" class="form-control float-right" name="total_penjualan_show_only"
                                id="total_penjualan_show_only" value="" readonly>
                        </div>
                        {{-- <div class="float-right">
                        <button class="btn btn-xs btn-info" id="addRow">Tambah Barang</button>
                    </div> --}}
                    </div>
                    <br>
                    <br>
                    {{-- <hr> --}}
                    <div class="modal-footer">
                        <button type="submit" id="buat" class="btn btn-success float-right"><i
                                class="fa fa-save"></i>&nbsp;Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- The modal View -->
    <div class="modal fade" id="viewPenjualan">
        <div class="modal-dialog modal-xl">
            <div class="modal-content document">
                <div class="modal-header bg-nial">
                    <h4 class="modal-title"><i class="fa fa-note">&nbsp;</i>Detail Penjualan Item</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input class="btn btn-xs btn-outline-info mb-3" id="kd_trs_viewDetailItem"> <input
                            class="btn btn-xs btn-outline-info mb-3 ml-2" id="view_kd_reg">
                        <table class="table table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th width="130px">kd obat</th>
                                    <th width="350px">Nama Obat</th>
                                    {{-- <th>Dosis</th> --}}
                                    <th width="110px">Satuan</th>
                                    <th width="110px">Harga</th>
                                    <th width="100px">Qty</th>
                                    <th width="110px">Cara Pakai</th>
                                    <th width="110px">Disc(Rp.)</th>
                                    <th width="90px">Tuslah</th>
                                    <th width="90px">Embalase</th>
                                    <th width="200px">Sub Total</th>
                                    {{-- <th width="50px"></th> --}}
                                </tr>
                            </thead>

                            <tbody id="viewDetailJual">

                            </tbody>
                        </table>
                        <hr>
                        {{-- <div class="float-right col-4">
                            <div class="float-right col-4">
                                <input type="text" class="form-control float-right" name="total_penjualan"
                                    id="total_penjualan" value="" readonly>
                            </div>
                        </div> --}}
                        <br>
                        <br>
                        {{-- <hr> --}}
                        <div class="modal-footer">
                            {{-- <button type="submit" id="buat" class="btn btn-success float-right"><i
                                    class="fa fa-save"></i>&nbsp;Save
                            </button> --}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal view --}}

    <div class="modal fade" id="obatSearchShow">
        <div class="modal-dialog modal-lg">
            <div class="modal-content document">
                <div class="modal-header bg-">
                    <h4 class="modal-title">Tambah Barang / Obat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    {{-- <div class="row"> --}}
                    <table class="table table-hover table-stripped" id="exm2" style="width: 100%">
                        <thead>
                            <tr>
                                <th>KD OBAT</th>
                                <th>Nama Obat</th>
                                <th>Satuan Jual</th>
                                <th>Harga Jual <i id="HrgJualView"></i></th>
                                <th>QTY Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="getListObatx" id="getListObatx">

                        </tbody>
                    </table>

                    <input type="hidden" id="user" name="user" value="tes">
                    {{-- </div> --}}
                    <div class="modal-footer">
                        {{-- <button type="" class=""></button> --}}
                        {{-- <button type="button" id="buat" class="btn btn-success float-right"><i
                                class="fa fa-save"></i>
                            &nbsp;
                            Save</button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal --}}

        {{-- modal cetak --}}
        <!-- Modal -->
        <div class="modal fade" id="printNota">
            <div class="modal-dialog modal-lg">
                <div class="modal-content document">
                    <div class="modal-header bg-">
                        <h4 class="modal-title">Tambah Barang / Obat</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body table-responsive">
                        {{-- <div class="row"> --}}
                        <table class="table table-hover table-stripped" id="exm2" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>KD OBAT</th>
                                    <th>Nama Obat</th>
                                    <th>Satuan Jual</th>
                                    <th>Harga Jual <i id="HrgJualView"></i></th>
                                    <th>QTY Stock</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="getListObatx" id="getListObatx">

                            </tbody>
                        </table>

                        <input type="hidden" id="user" name="user" value="tes">
                        {{-- </div> --}}
                        <div class="modal-footer">
                            {{-- <button type="" class=""></button> --}}
                            {{-- <button type="button" id="buat" class="btn btn-success float-right"><i
                                class="fa fa-save"></i>
                            &nbsp;
                            Save</button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal cetak --}}

        @push('scripts')
            <script>
                $('#tp_kd_order').select2({
                    placeholder: 'Search E-Resep',
                });

                $('#tp_lokasi_stock').select2({
                    placeholder: 'Search Lokasi Stock',
                });

                $('#tp_tipe_tarif').select2({
                    placeholder: 'Select Tipe Tarif',
                });

                // $("#obatSearch").on("click", function() {
                //     $('#obatSearchShow').modal('show');

                // });

                function searchObatShow() {
                    $('#obatSearchShow').modal('show');
                }


                function acMapResep() {
                    var kd_trs = $('#tp_kd_order').val();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('getListOrderResep') }}/" + kd_trs,
                        type: 'GET',
                        data: {
                            kd_trs: kd_trs
                        },
                        success: function(isListOrderResep) {
                            $("#ListObatJual").empty();
                            var getValues = isListOrderResep;
                            for (var getVals = 0; getVals < getValues.length; getVals++) {

                                $('#tp_layanan').val(getValues[getVals].layanan);
                                $('#tp_dokter').val(getValues[getVals].dokter);
                                $('#tp_kd_reg').val(getValues[getVals].kd_reg);
                                $('#tp_no_mr').val(getValues[getVals].mr_pasien);
                                $('#tp_nama').val(getValues[getVals].nm_pasien);
                                $('#tp_alamat').val(getValues[getVals].fs_alamat);
                                $('#tp_jenis_kelamin').val(getValues[getVals].fs_jenis_kelamin);
                                $('#tp_tgl_lahir').val(getValues[getVals].fs_tgl_lahir);
                                $('#tp_tipe_tarif').val();

                                var hrg_resep = getValues[getVals].ch_hrg_jual;
                                var qty_resep = getValues[getVals].ch_qty_obat;

                                var sub_total = hrg_resep * qty_resep;
                                // console.log(sub_total);


                                $("#ListObatJual").append(`
                                <tr>
                                    <td>
                                        <input class="searchObat form-control" style="border: none"
                                            id="kd_obat" name="kd_obat[]" placeholder="kode obat" readonly
                                            style="border: none;" value="${getValues[getVals].ch_kd_obat}">
                                    </td>
                                    <td>
                                        <input class="searchObat form-control" id="nm_obat"
                                            name="nm_obat[]" ondblclick="getListObat()" aria-placeholder="Search" value="${getValues[getVals].ch_nm_obat}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="do_satuan_pembelian form-control"
                                            id="satuan" name="satuan[]" readonly
                                            value="${getValues[getVals].ch_satuan_obat}">
                                    </td>
                                    <td>
                                        <input type="text" class="hrg_obatr form-control" readonly style="border: none;" id="hrg_obatr" name="hrg_obat[]" value="${getValues[getVals].ch_hrg_jual}">
                                    </td>
                                    <td>
                                        <input type="text" class="qtyr form-control" id="qtyr" name="qty[]" onClick="getQTYResep(this)" value="${getValues[getVals].ch_qty_obat}">
                                    </td>
                                    <td>
                                        <input type="text" class="cara_pakai form-control" id="cara_pakai" name="cara_pakai[]" value="${getValues[getVals].ch_cara_pakai}">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="diskon"
                                            name="diskon[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="tuslah"
                                            name="tuslah[]">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="embalase"
                                            name="embalase[]">
                                    </td>
                                    <td>
                                        <input type="text" class="sub_totalr form-control" id="sub_totalr"
                                            name="sub_total[]" readonly style="border: none;" value="${sub_total}">
                                    </td>

                                    <input type="hidden" name="user" id="user" value="tes user">
                                    <td>
                                        <button type="button" class="remove btn btn-xs btn-danger"><i
                                                class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                                    </td>
                                </tr>
                    
                                `);
                            }
                            GrandTotalResep();

                        }
                    })
                }

                function deleteRow(btn) {
                    var row = btn.parentNode.parentNode.parentNode;
                    row.parentNode.removeChild(row);
                }

                function GrandTotalResep() {
                    var sum = 0;

                    $('.sub_totalr').each(function() {
                        sum += Number($(this).val());
                    });
                    var result = sum.toFixed(2);

                    $('#total_penjualan').val(result);
                }


                function getTipeTarif() {
                    var tes = $('#tp_tipe_tarif').val();

                    if (tes == 'Reguler') {
                        toastr.info('Harga Reguler Selected!', {
                            timeOut: 600,
                            // preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        $('#HrgJualView').val('Reguler');
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('getListObatReguler') }}",
                            type: 'GET',
                            // data: {
                            //     chart_mr: dataObject
                            // },
                            success: function(isObatReguler) {
                                var table = $('#exm2').DataTable();
                                var rows = table
                                    .rows()
                                    .remove()
                                    .draw();
                                // $("#getListObatx").empty();
                                var getValue = isObatReguler;
                                for (var getVal = 0; getVal < getValue.length; getVal++) {

                                    const table = $('#exm2').DataTable();
                                    var btnBtn =
                                        `<button class="SelectItemObat btn btn-success btn-xs" id="SelectItemObat" onClick="SelectItemObat(this)" data-fm_kd_obat="${getValue[getVal].fm_kd_obat}" data-fm_nm_obat="${getValue[getVal].fm_nm_obat}" data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}" data-fm_hrg_jual="${getValue[getVal].fm_hrg_jual_non_resep}">Select</button>`
                                    const dataBaru = [
                                        [getValue[getVal].fm_kd_obat, getValue[getVal].fm_nm_obat, getValue[getVal]
                                            .fm_satuan_jual, getValue[getVal].fm_hrg_jual_non_resep, getValue[
                                                getVal]
                                            .qty, btnBtn
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
                                    // $(".getListObatx").append(`
                        // <tr>
                        //     <td><input class="getItemObat col-6" style="border: none" readonly value="${getValue[getVal].fm_kd_obat}"></td>
                        //     <td id="kd_obatToadd">${getValue[getVal].fm_nm_obat}</td>
                        //     <td>${getValue[getVal].fm_satuan_jual}</td>
                        //     <td>${getValue[getVal].fm_hrg_jual_non_resep}</td>
                        //     <td>${getValue[getVal].qty}</td>
                        //     <td><button type="button" onClick="SelectItemObat(this)" class="btn btn-info btn-xs" id="SelectItemObatxxx"
                        //             data-fm_kd_obat="${getValue[getVal].fm_kd_obat}"
                        //             data-fm_nm_obat="${getValue[getVal].fm_nm_obat}"
                        //             data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}"
                        //             data-fm_hrg_jual="${getValue[getVal].fm_hrg_jual_non_resep}">Select</button>
                        //     </td>
                        // </tr>`)
                                }

                            }
                        })

                    } else if (tes == 'Resep') {
                        $("#getListObatx").empty();
                        toastr.info('Harga Resep Selected!', {
                            timeOut: 600,
                            // preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('getListObatResep') }}",
                            type: 'GET',
                            // data: {
                            //     chart_mr: dataObject
                            // },
                            success: function(isObatResep) {
                                var table = $('#exm2').DataTable();
                                var rows = table
                                    .rows()
                                    .remove()
                                    .draw();
                                // $("#getListObatx").empty();
                                var getValue = isObatResep;
                                for (var getVal = 0; getVal < getValue.length; getVal++) {

                                    const table = $('#exm2').DataTable();
                                    var btnBtn =
                                        `<button class="SelectItemObat btn btn-success btn-xs" id="SelectItemObat" onClick="SelectItemObat(this)" data-fm_kd_obat="${getValue[getVal].fm_kd_obat}" data-fm_nm_obat="${getValue[getVal].fm_nm_obat}" data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}" data-fm_hrg_jual="${getValue[getVal].fm_hrg_jual_resep}">Select</button>`
                                    const dataBaru = [
                                        [getValue[getVal].fm_kd_obat, getValue[getVal].fm_nm_obat, getValue[getVal]
                                            .fm_satuan_jual, getValue[getVal].fm_hrg_jual_resep, getValue[getVal]
                                            .qty, btnBtn
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
                                    // $(".getListObatx").append(`
                        // <tr>
                        //     <td><input class="getItemObat col-4" style="border: none" readonly value="${getValue[getVal].fm_kd_obat}"></td>
                        //     <td>${getValue[getVal].fm_nm_obat}</td>
                        //     <td>${getValue[getVal].fm_satuan_jual}</td>
                        //     <td>${getValue[getVal].fm_hrg_jual_resep}</td>
                        //     <td><button type="button" class="SelectItemObat btn btn-info btn-xs" id="SelectItemObat" onClick="SelectItemObat(this)"
                        //             data-fm_kd_obat="${getValue[getVal].fm_kd_obat}"
                        //             data-fm_nm_obat="${getValue[getVal].fm_nm_obat}"
                        //             data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}"
                        //             data-fm_hrg_jual="${getValue[getVal].fm_hrg_jual_resep}">Select</button>
                        //     </td>
                        // </tr>`)
                                }
                            }
                        })
                    } else {
                        toastr.info('Harga Nakes Selected!', {
                            timeOut: 600,
                            // preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        $("#getListObatx").empty();
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('getListObatNakes') }}",
                            type: 'GET',
                            // data: {
                            //     chart_mr: dataObject
                            // },
                            success: function(isObatNakes) {
                                var table = $('#exm2').DataTable();
                                var rows = table
                                    .rows()
                                    .remove()
                                    .draw();
                                // $("#getListObatx").empty();
                                var getValue = isObatNakes;
                                for (var getVal = 0; getVal < getValue.length; getVal++) {

                                    const table = $('#exm2').DataTable();
                                    var btnBtn =
                                        `<button class="SelectItemObat btn btn-success btn-xs" id="SelectItemObat" onClick="SelectItemObat(this)" data-fm_kd_obat="${getValue[getVal].fm_kd_obat}" data-fm_nm_obat="${getValue[getVal].fm_nm_obat}" data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}" data-fm_hrg_jual="${getValue[getVal].fm_hrg_jual_nakes}">Select</button>`
                                    const dataBaru = [
                                        [getValue[getVal].fm_kd_obat, getValue[getVal].fm_nm_obat, getValue[getVal]
                                            .fm_satuan_jual, getValue[getVal].fm_hrg_jual_nakes, getValue[getVal]
                                            .qty, btnBtn
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
                                    //             $(".getListObatx").append(`
                        // <tr>
                        //     <td><input class="getItemObat col-4" style="border: none" readonly value="${getValue[getVal].fm_kd_obat}"></td>
                        //     <td>${getValue[getVal].fm_nm_obat}</td>
                        //     <td>${getValue[getVal].fm_satuan_jual}</td>
                        //     <td>${getValue[getVal].fm_hrg_jual_nakes}</td>
                        //     <td><button type="button" class="SelectItemObat btn btn-info btn-xs" id="SelectItemObat" onClick="SelectItemObat(this)"
                        //             data-fm_kd_obat="${getValue[getVal].fm_kd_obat}"
                        //             data-fm_nm_obat="${getValue[getVal].fm_nm_obat}"
                        //             data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}"
                        //             data-fm_hrg_jual="${getValue[getVal].fm_hrg_jual_nakes}">Select</button>
                        //     </td>
                        // </tr>`)
                                }
                            }
                        })
                    }
                };

                function getListObat() {
                    $('#obatSearchShow').modal('show');
                }

                function SelectItemObat(f) {
                    // $("#SelectItemObatxxx").on("click", function() {
                    var getKdObat = $(f).data('fm_kd_obat');
                    var getNmObat = $(f).data('fm_nm_obat');
                    var getSatJual = $(f).data('fm_satuan_jual');
                    var getHrg = $(f).data('fm_hrg_jual');

                    // console.log(getKdObat);

                    $("#ListObatJual").append(`
                    <tr>
                        <td>
                            <input class="searchObat form-control" style="border: none"
                                id="kd_obat" name="kd_obat[]" placeholder="kode obat" readonly
                                style="border: none;" value="${getKdObat}">
                        </td>
                        <td>
                            <input class="searchObat form-control" id="nm_obat"
                                name="nm_obat[]" ondblclick="getListObat()" aria-placeholder="Search" value="${getNmObat}" readonly>
                        </td>
                        <td>
                            <input type="text" class="do_satuan_pembelian form-control"
                                id="satuan" name="satuan[]" readonly
                                value="${getSatJual}">
                        </td>
                        <td>
                            <input type="text" class="form-control" readonly style="border: none;" id="hrg_obat" name="hrg_obat[]" value=${getHrg}>
                        </td>
                        <td>
                            <input type="text" class="qty form-control" id="qty" name="qty[]" onKeyUp="getQTY(this)">
                        </td>
                        <td>
                            <input type="text" class="cara_pakai form-control" id="cara_pakai" name="cara_pakai[]">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="diskon"
                                name="diskon[]">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="tuslah"
                                name="tuslah[]" onKeyUp="getTuslah(this)">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="embalase"
                                name="embalase[]" onKeyUp="getEmbalase(this)">
                        </td>
                        <td>
                            <input type="text" class="sub_total form-control" id="sub_total"
                                name="sub_total[]" readonly style="border: none;">
                        </td>
                        <input type="hidden" class="sub_total_hidden form-control" id="sub_total_hidden"
                        name="sub_total_hidden[]">
                        <input type="hidden" class="sub_total_hidden_after_tuslah form-control" id="sub_total_hidden_after_tuslah"
                        name="sub_total_hidden_after_tuslah[]">
                        <input type="hidden" name="user" id="user" value="tes user">
                        <td>
                            <button type="button" class="remove btn btn-xs btn-danger"><i class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                        </td>
                    </tr>
                    
                    `);
                    $('#obatSearchShow').modal('hide');

                };

                function getQTY(q) {
                    // $('#calculation').on("keyup", ".do_hrg_beli", function() {
                    var parent = q.parentElement.parentElement;
                    var quant = $(parent).find('#qty').val();
                    var price = $(parent).find('#hrg_obat').val();
                    // console.log(quant);
                    var x = quant * price;
                    var result = x.toFixed(2);
                    $(parent).find('#sub_total').val(result);
                    $(parent).find('#sub_total_hidden').val(result);
                    GrandTotal();
                    // });

                };

                function getTuslah(q) {
                    // alert('0');
                    let parentT = q.parentElement.parentElement;
                    let tuslah = $(parentT).find('#tuslah').val();
                    // console.log(tuslah);
                    let subtotalsementara = $(parentT).find('#sub_total_hidden').val();
                    let hsl = parseFloat(tuslah) + parseFloat(subtotalsementara);
                    let resultT = hsl.toFixed(2);
                    console.log(hsl);
                    $(parentT).find('#sub_total').val(resultT);
                    $(parentT).find('#sub_total_hidden_after_tuslah').val(resultT);

                    GrandTotal();
                };

                function getEmbalase(q) {
                    // alert('0');
                    let parentE = q.parentElement.parentElement;
                    let embalase = $(parentE).find('#embalase').val();
                    // console.log(tuslah);
                    let subtotalsementaratuslah = $(parentE).find('#sub_total_hidden_after_tuslah').val();
                    let subtotalsementara = $(parentE).find('#sub_total_hidden').val();
                    if (subtotalsementaratuslah) {
                        let hsl = parseFloat(embalase) + parseFloat(subtotalsementaratuslah);
                        let resultE = hsl.toFixed(2);
                        // console.log(hsl);
                        $(parentE).find('#sub_total').val(resultE);
                    } else {
                        let hsl = parseFloat(embalase) + parseFloat(subtotalsementara);
                        let resultE = hsl.toFixed(2);
                        // console.log(hsl);
                        $(parentE).find('#sub_total').val(resultE);
                    }
                    GrandTotal();
                };

                function GrandTotal() {
                    var sum = 0;

                    $('.sub_total').each(function() {
                        sum += Number($(this).val());
                    });
                    var result = sum.toFixed(2);

                    $('#total_penjualan').val(result);

                    var ttlInt = parseFloat(result);

                    var formattedNumber = ttlInt.toLocaleString('id-ID', {
                        style: 'currency',
                        currency: 'IDR'
                    });

                    $('#total_penjualan_show_only').val(formattedNumber);
                }
                // shortcut.add("F12", function() {
                //     alert("F12 pressed");
                // });

                function getDetailPen(tx) {
                    $('#viewPenjualan').modal('show');

                    var kd_trs = $(tx).data('kd_trs');
                    // alert(kd_trs);
                    $('#viewDetailJual').empty();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('getDetailPenjualan') }}/" + kd_trs,
                        type: "GET",
                        data: {
                            kd_trs: kd_trs
                        },
                        success: function(isViewDetailPenjualan) {
                            $.each(isViewDetailPenjualan, function(key, datavalue) {
                                $('#kd_trs_viewDetailItem').val(datavalue.kd_trs);
                                $('#view_kd_reg').val(datavalue.kd_reg);
                                var caraPakai = datavalue.cara_pakai ?? '';

                                $("#viewDetailJual").append(`
                                         <tr>
                                            <td>
                                                <input class="searchObat form-control" style="border: none"
                                                    id="kd_obat" name="kd_obat[]" placeholder="kode obat" readonly
                                                    style="border: none;" value="${datavalue.kd_obat}">
                                            </td>
                                            <td>
                                                <input class="searchObat form-control" id="nm_obat"
                                                    name="nm_obat[]" ondblclick="getListObat()" aria-placeholder="Search" value="${datavalue.nm_obat}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="do_satuan_pembelian form-control"
                                                    id="satuan" name="satuan[]" readonly
                                                    value="${datavalue.satuan}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" readonly style="border: none;" id="hrg_obat" name="hrg_obat[]" value=${datavalue.hrg_obat}>
                                            </td>
                                            <td>
                                                <input type="text" class="qty form-control" id="qty" name="qty[]" onKeyUp="getQTY(this)" value="${datavalue.qty}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="cara_pakai form-control" id="cara_pakai" name="cara_pakai[]" value="${caraPakai}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="diskon"
                                                    name="diskon[]" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="tax"
                                                    name="tax[]" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="sub_total form-control" id="sub_total"
                                                    name="sub_total[]" readonly style="border: none;" value="${datavalue.sub_total}">
                                            </td>

                                            <input type="hidden" name="user" id="user" value="tes user">
                                        </tr>
                                        `);
                            })
                            // return window.location.href = "{{ url('mstr-obat') }}";
                        }

                    });
                };

                function cetakNota(cn) {
                    var kodetrs = $(cn).data('kd_trsc');
                    // alert(kodetrs);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('nota') }}",
                        type: 'get',
                        data: {
                            kd_trs: kodetrs
                        },
                        success: function(response) {
                            toastr.success('success!', 'PrintOut', {
                                timeOut: 2000,
                                preventDuplicates: true,
                                positionClass: 'toast-top-right',
                            });
                            w = window.open(window.location.href, "_blank");
                            w.document.open();
                            w.document.write(response);
                            // // w.document.close();
                            w.window.print();

                        },
                        error: function(xhr, status, error) {
                            toastr.error(status, error, {
                                timeOut: 2000,
                                preventDuplicates: true,
                                positionClass: 'toast-top-right',
                            });
                        }
                    })
                }
            </script>
        @endpush
    @endsection
