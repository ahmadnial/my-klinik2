@extends('pages.master')

@section('mytitle', 'Laboratorium Trs')
@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#addPenjualan"><i class="far fa-plus-square"></i>&nbsp;Add Trs</button>
                <h3 class="card-title"><i class="fas fa-pills"></i>&nbsp;</i>Transaksi Laboratorium</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <div class="mb-3">
                        {{-- <select name="" id="" class="form-control form-control-sm col-2">
                            <option value=""></option>
                        </select> --}}
                        <input type="month" name="monthSales" id="monthSales" onchange="getMonthSale()"
                            class="form-control form-control-sm col-2">
                    </div>
                    <table id="example1" class="table table-hover">
                        <thead class="" style="background-color:rgb(242, 231, 255)">
                            <tr>
                                {{-- <th>Tanggal</th> --}}
                                <th>Tanggal Transaksi</th>
                                <th>No Transaksi</th>
                                <th>Layanan Penjualan</th>
                                <th>No.RM</th>
                                <th>Nama Pasien</th>
                                <th>Tipe Tarif</th>
                                <th>Total Penjualan</th>
                                <th>Act</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>

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

        #EditPenjualan .fullmodal {
            width: 100%;
            max-width: 98%;
            height: auto;
            margin: 40;
        }

        .scrollable-table {
            /* overflow-y: initial !important */
            max-height: 250px;
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
                    <h4 class="modal-title"><i class="fab fa-cc-amazon-pay"></i>&nbsp;Transaksi Laboratorium</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('add-penjualan') }}" onkeydown="return event.key != 'Enter';"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="">kd trs</label>
                                <input type="text" class="form-control" name="tl_kd_trs" id="tl_kd_trs"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">kd Reg</label>
                                <select class="form-control" id="tl_kd_order" style="width: 100%;" name="tl_kd_order"
                                    onchange="acMapResep()">
                                    <option value="">--Select--</option>
                                    @foreach ($isListOrderLab as $odrl)
                                        <option value="{{ $odrl->kd_trs }}">{{ $odrl->kd_reg . '-' . $odrl->nm_pasien }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tgl Transaksi</label>
                                <input type="date" class="form-control" name="tgl_trs" id="tgl_trs"
                                    value="">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Diagnosa</label>
                                <input type="text" class="form-control" name="tl_diagnosa" id="tl_diagnosa" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Dokter Pengirim</label>
                                <input type="text" class="form-control" name="tl_dokter" id="tl_dokter" value=""
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
                                <input type="text" class="form-control" name="tl_kd_reg" id="tl_kd_reg" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">No.RM</label>
                                <input type="text" class="form-control" name="tl_no_mr" id="tl_no_mr" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="tl_nama" id="tl_nama" value="">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Alamat</label>
                                <textarea type="text" class="form-control" name="tl_alamat" id="tl_alamat" value=""></textarea>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="tl_jenis_kelamin" id="tl_jenis_kelamin"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tgl Lahir</label>
                                <input type="text" class="form-control" name="tl_tgl_lahir" id="tl_tgl_lahir"
                                    value="" readonly>
                            </div>
                            {{-- <div class="form-group col-sm-2">
                                <label for="">Tipe Tarif <span class="text-danger">*</span></label>
                                <select class="form-control" onchange="getTipeTarif()" id="tp_tipe_tarif"
                                    style="width: 100%;" name="tp_tipe_tarif">
                                    <option value="">--Select--</option>
                                    <option value="Reguler">Reguler</option>
                                    <option value="Resep">Resep</option>
                                    <option value="Nakes">Nakes</option>
                                </select>
                                <div class="invalid-feedback">Please..dont let me blank</div>
                            </div> --}}
                            <div class="isResepActive form-inline col-sm-9 mb-2">
                                <input type="hidden" id="user" name="user" value="tes">
                            </div>
                        </div>
                        <div class="">
                            <button type="button" id="obatSearch" onClick="searchObatShow()"
                                class="btn btn-info float-right"><i class="fa fa-plus">&nbsp;Item</i></button>
                            <i class="text-danger text-sm">
                                {{-- *Tipe Tarif Wajib DIpilih <br> --}}
                                {{-- *Tekan F9 untuk membuka List Obat/Klik Tombol +Item --}}
                            </i>
                        </div>
                    </div>

                    {{-- <hr> --}}
                    <div class="scrollable-table">
                        <table class="table table-scroll table-stripped table-bordered" id="">
                            <thead>
                                <tr>
                                    <th width="130px">kd Trs</th>
                                    <th width="350px">Nama Pemeriksaan</th>
                                    <th width="110px">Hasil</th>
                                    <th width="110px">Satuan Hasil</th>
                                    <th width="110px">Nilai Rujukan</th>
                                    {{-- <th width="100px">Nilai Normal</th> --}}
                                    <th width="200px">Sub Total</th>
                                    <th width="50px"></th>
                                </tr>
                            </thead>

                            <tbody class="listPemeriksaan" id="listPemeriksaan">

                            </tbody>
                        </table>
                    </div>
                    {{-- <hr>
                    <div class="float-right col-4">
                    </div>
                    <br>
                    <br> --}}
                    {{-- <hr> --}}
                    <div class="modal-footer">
                        <div class="float-right col-2">
                            <input type="hidden" class="form-control float-right" name="total_penjualan"
                                id="total_penjualan">
                            <input type="text" class="form-control float-right" name="total_penjualan_show_only"
                                id="total_penjualan_show_only" value="" readonly>
                        </div>
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
                        <input class="btn btn-xs btn-outline-info mb-3 ml-2" id="createdby" disabled>
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
                                    <th width="90px">Tuslah</th>
                                    <th width="90px">Embalase</th>
                                    <th width="110px">Disc(Rp.)</th>
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



    {{-- modal cetak --}}
    <!-- Modal -->
    {{-- <div class="modal fade" id="printNota">
            <div class="modal-dialog modal-lg">
                <div class="modal-content document">
                    <div class="modal-header bg-">
                        <h4 class="modal-title">Tambah Barang / Obat</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body table-responsive">
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
                                <tr></tr>
                            </tbody>
                        </table>

                        <input type="hidden" id="user" name="user" value="tes">
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    {{-- end modal cetak --}}

    <!-- The modal Edit -->
    <div class="modal fade" id="EditPenjualan">
        <div class="modal-dialog modal-dialog-scrollable fullmodal">
            <div class="modal-content" role="document">
                <div class="modal-header bg-nial">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Transaksi Laboratorium</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('update-penjualan') }}" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="modal-body">
                        <div class="row" id="EditPenjualanHdr">
                            <div class="form-group col-sm-2">
                                <label for="">kd trs</label>
                                <input type="text" class="form-control" name="tp_kd_trse" id="tp_kd_trse"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">kd Reg</label>
                                <input class="form-control" id="tp_kd_ordere" style="width: 100%;" name="tp_kd_ordere"
                                    @readonly(true)>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tgl Transaksi</label>
                                <input type="date" class="form-control" name="tgl_trse" id="tgl_trse"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Resep Dari</label>
                                <input type="text" class="form-control" name="tp_layanane" id="tp_layanane"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Dokter</label>
                                <input type="text" class="form-control" name="tp_doktere" id="tp_doktere"
                                    value="" readonly>
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
                                <input type="text" class="form-control" name="tp_kd_rege" id="tp_kd_rege"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">No.RM</label>
                                <input type="text" class="form-control" name="tp_no_mre" id="tp_no_mre"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="tp_namae" id="tp_namae"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Alamat</label>
                                <textarea type="text" class="form-control" name="tp_alamate" id="tp_alamate" value="" readonly></textarea>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="tp_jenis_kelamine"
                                    id="tp_jenis_kelamine" value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tgl Lahir</label>
                                <input type="text" class="form-control" name="tp_tgl_lahire" id="tp_tgl_lahire"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tipe Tarif <span class="text-danger">*</span></label>
                                <select class="tp_tipe_tarife form-control" onchange="getTipeTarifE()"
                                    id="tp_tipe_tarife" style="width: 100%;" name="tp_tipe_tarife">
                                    <option value="">--Select--</option>
                                    <option value="Reguler">Reguler</option>
                                    <option value="Resep">Resep</option>
                                    <option value="Nakes">Nakes</option>
                                </select>
                            </div>
                            <div class="isResepActive form-inline col-sm-9 mb-2">

                                <input type="hidden" id="user" name="user" value="tes">
                            </div>
                        </div>
                        <div class="">
                            <button type="button" id="obatSearch" onClick="searchObatShow()"
                                class="btn btn-info float-right"><i class="fa fa-plus">&nbsp;Item</i></button>
                            <i class="text-danger text-sm">
                                *Tipe Tarif Wajib DIpilih <br>
                                *Tekan F9 untuk membuka List Obat/Klik Tombol +Item
                            </i>
                        </div>
                    </div>

                    {{-- <hr> --}}
                    <div class="scrollable-table">
                        <table class="table table-scroll table-stripped table-bordered">
                            <thead>
                                <tr>
                                    <th width="130px">kd obat</th>
                                    <th width="350px">Nama Obat</th>
                                    {{-- <th>Dosis</th> --}}
                                    <th width="110px">Satuan</th>
                                    <th width="110px">Harga</th>
                                    <th width="100px">Qty</th>
                                    <th width="110px">Cara Pakai</th>
                                    <th width="90px">Tuslah</th>
                                    <th width="90px">Embalase</th>
                                    <th width="110px">Disc(Rp.)</th>
                                    <th width="200px">Sub Total</th>
                                    <th width="50px"></th>
                                </tr>
                            </thead>

                            <tbody class="EditPenjualanList" id="EditPenjualanList">

                            </tbody>
                        </table>
                    </div>
                    {{-- <hr>
                    <div class="float-right col-4">
                    </div>
                    <br>
                    <br> --}}
                    {{-- <hr> --}}
                    <div class="modal-footer">
                        <div class="float-right col-2">
                            <input type="hidden" class="form-control float-right" name="total_penjualanE"
                                id="total_penjualanE">
                            <input type="text" class="form-control float-right" name="total_penjualan_show_onlyE"
                                id="total_penjualan_show_onlyE" value="" readonly>
                        </div>
                        <button type="submit" id="updateTrs" onclick="updateTrs()"
                            class="btn btn-success float-right"><i class="fa fa-save"></i>&nbsp;Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="obatSearchShow">
        <div class="modal-dialog modal-lg">
            <div class="modal-content document">
                <div class="modal-header bg-">
                    <h4 class="modal-title">Tambah Barang / Obat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <input type="text" name="" id="showTipeTarif"
                    class="col-4 col-md-4 form-control float-right mt-2 ml-1 text-danger" style="border: none">

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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="getListObatx" id="getListObatx">
                            {{-- <tr></tr> --}}
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
    {{-- End Modal --}}

    {{-- modal popup delete --}}
    <div class="modal fade" id="confirmDelete" aria-hidden="true" aria-labelledby="exampleModalToggleLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Konfirmasi Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('delete-trs-penjualan') }}" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="modal-body">
                        Delete Transaksi Penjualan <input type="text" class="text-danger" name="nomorTrs"
                            id="nomorTrs" style="border: none;">
                    </div>
                    <input type="hidden" name="tgl_trsD" id="tgl_trsD">
                    <div class="" id="ListDeleteItem">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end --}}


    @push('scripts')
        <script>
            getMonthSale()

            $('#tp_kd_order').select2({
                placeholder: 'Search E-Resep',
            });

            $('#tp_tipe_tarife').select2({
                placeholder: 'Select Tipe Tarif',
            });

             function acMapResep() {
                var kd_trs = $('#tl_kd_order').val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getListOrderLab') }}/" + kd_trs,
                    type: 'GET',
                    data: {
                        kd_trs: kd_trs
                    },
                    success: function(isListOrderLab) {
                        $("#listPemeriksaan").empty();
                        var getValues = isListOrderLab;
                        for (var getVals = 0; getVals < getValues.length; getVals++) {

                            $('#tl_layanan').val(getValues[getVals].layanan);
                            $('#tl_dokter').val(getValues[getVals].nm_dokter_jm);
                            $('#tl_kd_reg').val(getValues[getVals].kd_reg);
                            $('#tl_no_mr').val(getValues[getVals].mr_pasien);
                            $('#tl_nama').val(getValues[getVals].nm_pasien);
                            $('#tl_alamat').val(getValues[getVals].fs_alamat);
                            $('#tl_jenis_kelamin').val(getValues[getVals].fs_jenis_kelamin);
                            $('#tl_tgl_lahir').val(getValues[getVals].fs_tgl_lahir);


                            $("#listPemeriksaan").append(`
                                <tr>
                                    <td>
                                        <input class="searchObat form-control" style="border: none"
                                            id="kd_obat" name="kd_trs[]" placeholder="kode obat" readonly
                                            style="border: none;" value="${getValues[getVals].kd_trs}">
                                    </td>
                                    <td>
                                        <input class="searchObat form-control" id="nm_obat"
                                            name="nm_obat[]" ondblclick="getListObat()" aria-placeholder="Search" value="${getValues[getVals].nm_tarif}" readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="do_satuan_pembelian form-control"
                                            id="satuan" name="satuan[]"
                                            value="">
                                    </td>
                                    <td>
                                        <input type="text" class="satuan_hasil form-control" readonly style="border: none;" id="satuan_hasil" name="satuan_hasil[]" value="${getValues[getVals].satuan_hasil}">
                                    </td>
                                    <td>
                                        <input type="text" class="ket_normal form-control" id="ket_normal" name="ket_normal[]" onKeyUp="getQTY(this)" value="${getValues[getVals].ket_normal}" readonly>
                                    </td>
                                    
                                    <td>
                                        <input type="text" class="sub_total form-control" id="sub_total"
                                            name="sub_total[]" readonly style="border: none;" value="${getValues[getVals].nilai_tarif}">
                                    </td>
                                    <input type="hidden" class="sub_total_hidden form-control" id="sub_total_hidden"
                                        name="sub_total_hidden[]" value="">
                                        <input type="hidden" class="sub_total_hidden_after_tuslah form-control" id="sub_total_hidden_after_tuslah"
                                        name="sub_total_hidden_after_tuslah[]">
                                    <input type="hidden" name="hrgHPP[]" id="hrgHPP" value="-">
                                    <td>
                                        <button type="button" class="remove btn btn-xs btn-danger"><i
                                                class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                                    </td>
                                </tr>
                    
                                `);
                        }
                        // GrandTotal();

                    }
                })
            }

            (function() {
                'use strict'

                var forms = document.querySelectorAll('.needs-validation')

                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()
        </script>
    @endpush
@endsection
