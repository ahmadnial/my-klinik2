@extends('pages.master')

@section('mytitle', 'Penjualan')
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
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Transaksi Penjualan</h4>
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
                                <input type="text" class="form-control" name="tp_no_mr" id="tp_no_mr" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="tp_nama" id="tp_nama" value="">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Alamat</label>
                                <textarea type="text" class="form-control" name="tp_alamat" id="tp_alamat" value=""></textarea>
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
                                <label for="">Tipe Tarif <span class="text-danger">*</span></label>
                                <select class="form-control" onchange="getTipeTarif()" id="tp_tipe_tarif"
                                    style="width: 100%;" name="tp_tipe_tarif">
                                    <option value="">--Select--</option>
                                    <option value="Reguler">Reguler</option>
                                    <option value="Resep">Resep</option>
                                    <option value="Nakes">Nakes</option>
                                </select>
                                <div class="invalid-feedback">Please..dont let me blank</div>
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
                                    <th width="90px">Tuslah</th>
                                    <th width="90px">Embalase</th>
                                    <th width="110px">Disc(Rp.)</th>
                                    <th width="200px">Sub Total</th>
                                    <th width="50px"></th>
                                </tr>
                            </thead>

                            <tbody class="ListObatJual" id="ListObatJual">

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
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Transaksi Penjualan</h4>
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

            $('#tp_lokasi_stock').select2({
                placeholder: 'Search Lokasi Stock',
            });

            $('#tp_tipe_tarif').select2({
                placeholder: 'Select Tipe Tarif',
            });

            $('#tp_tipe_tarife').select2({
                placeholder: 'Select Tipe Tarif',
            });


            function searchObatShow() {
                $('#obatSearchShow').modal('show');
            }

            function getMonthSale() {
                const dataBulan = $('#monthSales').val();
                $.ajax({
                    success: function() {
                        $('#example1').DataTable({
                            processing: true,
                            serverSide: true,
                            dom: 'lBfrtip',
                            responsive: true,
                            "bDestroy": true,
                            "order": [
                                [1, "dsc"]
                            ],
                            ajax: {
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "{{ url('getMonthSales') }}",
                                type: 'GET',
                                data: {
                                    dataBulan: dataBulan
                                }
                            },
                            columns: [{
                                    data: 'tgl_trs',
                                    name: 'tgl_trs',
                                    render: function(data, type, row) {
                                        return moment(data).format('D MMMM YYYY');
                                    }
                                },
                                {
                                    data: 'kd_trs',
                                    name: 'kd_trs'
                                },
                                {
                                    data: 'layanan_order',
                                    name: 'layanan_order',
                                    render: function(data, type, row) {
                                        if (data == 'Poliklinik Umum' || data ==
                                            'Poliklinik Bedah') {
                                            return '<span class="badge badge-success">Resep Klinik</span>';
                                        } else {
                                            return '<span class="badge badge-danger">Apotek</span>';
                                        }
                                    }
                                },
                                {
                                    data: 'no_mr',
                                    name: 'no_mr'
                                },
                                {
                                    data: 'nm_pasien',
                                    name: 'nm_pasien'
                                },
                                {
                                    data: 'tipe_tarif',
                                    name: 'tipe_tarif'
                                },
                                {
                                    data: 'total_penjualan',
                                    name: 'total_penjualan',
                                    render: $.fn.dataTable.render.number(',', '.', 2, 'Rp ')
                                },
                                {
                                    data: 'action',
                                    name: 'action'
                                },
                            ],
                            "responsive": true,
                            "paging": true,
                            "searching": true,
                            "lengthChange": true,
                            "autoWidth": true,
                            "buttons": ["copy", "excel", "pdf", "print", "colvis"]
                        }).buttons().container().appendTo('#penjualan_wrapper .col-md-6:eq(0)');
                    }
                })
            };

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
                            $('#tp_dokter').val(getValues[getVals].nm_dokter_jm);
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
                            var cara_pakai = getValues[getVals].ch_cara_pakai ?? '';


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
                                        <input type="text" class="hrg_obat form-control" readonly style="border: none;" id="hrg_obat" name="hrg_obat[]" value="${getValues[getVals].ch_hrg_jual}">
                                    </td>
                                    <td>
                                        <input type="text" class="qtyr form-control" id="qty" name="qty[]" onKeyUp="getQTY(this)" value="${getValues[getVals].ch_qty_obat}">
                                    </td>
                                    <td>
                                        <input type="text" class="cara_pakai form-control" id="cara_pakai" name="cara_pakai[]" value="${cara_pakai}">
                                    </td>
                                    
                                     <td>
                                        <input type="text" class="form-control" id="tuslah"
                                            name="tuslah[]" onKeyUp="getTuslah(this)" value="0">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="embalase"
                                            name="embalase[]" onKeyUp="getEmbalase(this)" value="0">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="diskon"
                                            name="diskon[]" onKeyUp="getDiskon(this)">
                                    </td>
                                    <td>
                                        <input type="text" class="sub_total form-control" id="sub_total"
                                            name="sub_total[]" readonly style="border: none;" value="${sub_total}">
                                    </td>
                                    <input type="hidden" class="sub_total_hidden form-control" id="sub_total_hidden"
                                        name="sub_total_hidden[]" value="${sub_total}">
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
                        GrandTotal();

                    }
                })
            }

            function deleteRow(btn) {
                var row = btn.parentNode.parentNode.parentNode;
                row.parentNode.removeChild(row);
                GrandTotal();
                GrandTotalEdit();
            }

            function getTipeTarif() {
                var tes = $('#tp_tipe_tarif').val();

                if (tes == 'Reguler') {
                    toastr.info('Harga Reguler Selected!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#showTipeTarif').val('');
                    $('#showTipeTarif').val('Reguler');
                    $('.isResepActive').empty();
                    $.ajax({
                        success: function(isObatReguler) {
                            $('#exm2').DataTable({
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "bDestroy": true,
                                ajax: "{{ url('getListObatReguler') }}",
                                columns: [{
                                        data: 'fm_kd_obat',
                                        name: 'fm_kd_obat'
                                    },
                                    {
                                        data: 'fm_nm_obat',
                                        name: 'fm_nm_obat'
                                    },
                                    {
                                        data: 'fm_satuan_jual',
                                        name: 'fm_satuan_jual'
                                    },
                                    {
                                        data: 'fm_hrg_jual_non_resep',
                                        name: 'fm_hrg_jual_non_resep'
                                    },
                                    {
                                        data: 'qty',
                                        name: 'qty'
                                    },
                                    {
                                        data: 'action',
                                        name: 'action'
                                    },
                                ]
                            });
                        }
                    })

                } else if (tes == 'Resep') {
                    $("#getListObatx").empty();
                    toastr.info('Harga Resep Selected!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#showTipeTarif').val('');
                    $('#showTipeTarif').val('Resep');
                    $('.isResepActive').append(
                        `
                             <div class="col-sm-2">
                                    <input type="text" class="form-control" name="resep_dari"
                                        id="resep_dari" value="" placeholder="Resep Dari">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="no_resep"
                                        id="no_resep" value="" placeholder="No.Resep">
                                </div>
                            `
                    )
                    $.ajax({
                        success: function(isObatResep) {
                            $('#exm2').DataTable({
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "bDestroy": true,
                                ajax: "{{ url('getListObatResep') }}",
                                columns: [{
                                        data: 'fm_kd_obat',
                                        name: 'fm_kd_obat'
                                    },
                                    {
                                        data: 'fm_nm_obat',
                                        name: 'fm_nm_obat'
                                    },
                                    {
                                        data: 'fm_satuan_jual',
                                        name: 'fm_satuan_jual'
                                    },
                                    {
                                        data: 'fm_hrg_jual_resep',
                                        name: 'fm_hrg_jual_resep'
                                    },
                                    {
                                        data: 'qty',
                                        name: 'qty'
                                    },
                                    {
                                        data: 'action',
                                        name: 'action'
                                    },
                                ]
                            });
                        }
                    })
                } else {
                    toastr.info('Harga Nakes Selected!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#showTipeTarif').val('');
                    $('#showTipeTarif').val('Nakes');
                    $('.isResepActive').empty();
                    $.ajax({
                        success: function(isObatNakes) {
                            $('#exm2').DataTable({
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "bDestroy": true,
                                ajax: "{{ url('getListObatNakes') }}",
                                columns: [{
                                        data: 'fm_kd_obat',
                                        name: 'fm_kd_obat'
                                    },
                                    {
                                        data: 'fm_nm_obat',
                                        name: 'fm_nm_obat'
                                    },
                                    {
                                        data: 'fm_satuan_jual',
                                        name: 'fm_satuan_jual'
                                    },
                                    {
                                        data: 'fm_hrg_jual_nakes',
                                        name: 'fm_hrg_jual_nakes'
                                    },
                                    {
                                        data: 'qty',
                                        name: 'qty'
                                    },
                                    {
                                        data: 'action',
                                        name: 'action'
                                    },
                                ]
                            });
                        }
                    })
                }
            };

            function getTipeTarifE() {
                var tes = $('#tp_tipe_tarife').val();

                if (tes == 'Reguler') {
                    toastr.info('Harga Reguler Selected!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#showTipeTarif').val('');
                    $('#showTipeTarif').val('Reguler');
                    $('.isResepActive').empty();
                    $.ajax({
                        success: function(isObatReguler) {
                            $('#exm2').DataTable({
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "bDestroy": true,
                                ajax: "{{ url('getListObatRegulerEdit') }}",
                                columns: [{
                                        data: 'fm_kd_obat',
                                        name: 'fm_kd_obat'
                                    },
                                    {
                                        data: 'fm_nm_obat',
                                        name: 'fm_nm_obat'
                                    },
                                    {
                                        data: 'fm_satuan_jual',
                                        name: 'fm_satuan_jual'
                                    },
                                    {
                                        data: 'fm_hrg_jual_non_resep',
                                        name: 'fm_hrg_jual_non_resep'
                                    },
                                    {
                                        data: 'qty',
                                        name: 'qty'
                                    },
                                    {
                                        data: 'action',
                                        name: 'action'
                                    },
                                ]
                            });

                        }
                    })

                } else if (tes == 'Resep') {
                    $("#getListObatx").empty();
                    toastr.info('Harga Resep Selected!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#showTipeTarif').val('');
                    $('#showTipeTarif').val('Resep');
                    $('.isResepActive').append(
                        `
                             <div class="col-sm-2">
                                    <input type="text" class="form-control" name="resep_dari"
                                        id="resep_dari" value="" readonly placeholder="Resep Dari">
                                </div>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="no_resep"
                                        id="no_resep" value="" readonly placeholder="No.Resep">
                                </div>
                            `
                    )
                    $.ajax({
                        success: function(isObatResep) {
                            $('#exm2').DataTable({
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "bDestroy": true,
                                ajax: "{{ url('getListObatResepEdit') }}",
                                columns: [{
                                        data: 'fm_kd_obat',
                                        name: 'fm_kd_obat'
                                    },
                                    {
                                        data: 'fm_nm_obat',
                                        name: 'fm_nm_obat'
                                    },
                                    {
                                        data: 'fm_satuan_jual',
                                        name: 'fm_satuan_jual'
                                    },
                                    {
                                        data: 'fm_hrg_jual_resep',
                                        name: 'fm_hrg_jual_resep'
                                    },
                                    {
                                        data: 'qty',
                                        name: 'qty'
                                    },
                                    {
                                        data: 'action',
                                        name: 'action'
                                    },
                                ]
                            });
                        }
                    })
                } else {
                    toastr.info('Harga Nakes Selected!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#showTipeTarif').val('');
                    $('#showTipeTarif').val('Nakes');
                    $('.isResepActive').empty();
                    $.ajax({
                        success: function(isObatNakes) {
                            $('#exm2').DataTable({
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "bDestroy": true,
                                ajax: "{{ url('getListObatNakesEdit') }}",
                                columns: [{
                                        data: 'fm_kd_obat',
                                        name: 'fm_kd_obat'
                                    },
                                    {
                                        data: 'fm_nm_obat',
                                        name: 'fm_nm_obat'
                                    },
                                    {
                                        data: 'fm_satuan_jual',
                                        name: 'fm_satuan_jual'
                                    },
                                    {
                                        data: 'fm_hrg_jual_nakes',
                                        name: 'fm_hrg_jual_nakes'
                                    },
                                    {
                                        data: 'qty',
                                        name: 'qty'
                                    },
                                    {
                                        data: 'action',
                                        name: 'action'
                                    },
                                ]
                            });
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
                var getHrgBeliHPP = $(f).data('fm_hrg_beli_detail');

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
                            <input type="text" class="form-control" id="tuslah"
                                name="tuslah[]" onKeyUp="getTuslah(this)" value="0">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="embalase"
                                name="embalase[]" onKeyUp="getEmbalase(this)" value="0">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="diskon"
                                name="diskon[]" onKeyUp="getDiskon(this)" value="0">
                        </td>
                        <td>
                            <input type="text" class="sub_total form-control" id="sub_total"
                                name="sub_total[]" readonly style="border: none;">
                        </td>
                            <input type="hidden" class="sub_total_hidden form-control" id="sub_total_hidden"
                                name="sub_total_hidden[]">
                            <input type="hidden" class="sub_total_hidden_after_tuslah form-control" id="sub_total_hidden_after_tuslah"
                                name="sub_total_hidden_after_tuslah[]">
                            <input type="hidden" name="hrgHPP[]" id="hrgHPP" value="${getHrgBeliHPP}">
                        <td>
                            <button type="button" class="remove btn btn-xs btn-danger"><i class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                        </td>
                    </tr>
                    
                    `);
                $('#obatSearchShow').modal('hide');

            };

            function getQTY(q) {
                var parent = q.parentElement.parentElement;
                var quant = $(parent).find('#qty').val();
                var price = $(parent).find('#hrg_obat').val();
                // console.log(quant);
                var x = quant * price;
                var result = x.toFixed(2);
                $(parent).find('#sub_total').val(result);
                $(parent).find('#sub_total_hidden').val(result);
                GrandTotal();
                GrandTotalEdit();
            };

            // function getQTYResep(rs) {
            //     var parentr = rs.parentElement.parentElement;
            //     var quanti = $(parentr).find('#qtyr').val();
            //     var prices = $(parentr).find('#hrg_obatr').val();
            //     // console.log(quanti);
            //     var xr = quanti * prices;
            //     var resultR = xr.toFixed(2);
            //     $(parentr).find('#sub_totalr').val(resultR);
            //     $(parentr).find('#sub_total_hiddenr').val(resultR);

            //     GrandTotalResep();
            // };

            function getTuslah(q) {
                let parentT = q.parentElement.parentElement;
                let tuslah = $(parentT).find('#tuslah').val();
                // console.log(tuslah);
                let subtotalsementara = $(parentT).find('#sub_total_hidden').val();
                let hsl = parseFloat(tuslah) + parseFloat(subtotalsementara);
                let resultT = hsl.toFixed(2);

                $(parentT).find('#sub_total').val(resultT);
                $(parentT).find('#sub_total_hidden_after_tuslah').val(resultT);

                GrandTotal();
                GrandTotalEdit();

            };

            function getEmbalase(q) {
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
                GrandTotalEdit();

            };

            function getDiskon(d) {
                let parentT = d.parentElement.parentElement;
                let diskon = $(parentT).find('#diskon').val();
                // alert(diskon);
                let subtotalsementara = $(parentT).find('#sub_total_hidden').val();
                let hsl = parseFloat(subtotalsementara) - parseFloat(diskon);
                let resultT = hsl.toFixed(2);

                $(parentT).find('#sub_total').val(resultT);
                $(parentT).find('#sub_total_hidden_after_tuslah').val(resultT);

                GrandTotal();
                GrandTotalEdit();

            };

            // function GrandTotalResep() {
            //     var sum = 0;

            //     $('.sub_totalr').each(function() {
            //         sum += Number($(this).val());
            //     });
            //     var result = sum.toFixed(2);

            //     $('#total_penjualan').val(result);

            //     var ttlInt = parseFloat(result);

            //     var formattedNumber = ttlInt.toLocaleString('id-ID', {
            //         style: 'currency',
            //         currency: 'IDR'
            //     });

            //     $('#total_penjualan_show_only').val(formattedNumber);
            // }

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


            function getDetailPen(tx) {
                $('#viewPenjualan').modal('show');

                var kd_trs = $(tx).data('kd_trs');
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
                                                <input type="text" class="form-control" id="tuslah"
                                                    name="tuslah[]" readonly value="${datavalue.tuslah}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="embalase"
                                                    name="embalase[]" readonly value="${datavalue.embalase}">
                                            </td>
                                              <td>
                                                <input type="text" class="form-control" id="diskon"
                                                    name="diskon[]" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="sub_total form-control" id="sub_total"
                                                    name="sub_total[]" readonly style="border: none;" value="${datavalue.sub_total}">
                                            </td>

                                            <input type="hidden" name="user" id="user" value="tes user">
                                        </tr>
                                        `);
                        })
                    }

                });
            };

            function validasiTrs(tx) {
                var kd_trs = $(tx).data('kd_trsu');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('update-penjualanG') }}",
                    type: "GET",
                    data: {
                        kd_trs: kd_trs
                    },
                    success: function(sessionFlashErr) {
                        alert(sessionFlashErr);
                    }
                });
            }

            function EditTrs(te) {
                $('#EditPenjualan').modal('show');
                var kd_trs = $(te).data('kd_trsu');

                $('#EditPenjualanList').empty();
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
                            // $('#kd_trs_viewDetailItem').val(datavalue.kd_trs);
                            // $('#view_kd_reg').val(datavalue.kd_reg);
                            var caraPakai = datavalue.cara_pakai ?? '';
                            $('#tp_kd_trse').val(datavalue.kd_trs);
                            $('#tp_kd_ordere').val(datavalue.kd_reg);
                            $('#tgl_trse').val(datavalue.tgl_trs);
                            $('#tp_layanane').val(datavalue.layanan_order);
                            $('#tp_doktere').val(datavalue.dokter);
                            $('#tp_kd_rege').val(datavalue.kd_reg);
                            $('#tp_no_mre').val(datavalue.no_mr);
                            $('#tp_namae').val(datavalue.nm_pasien);
                            $('#tp_alamate').val(datavalue.alamat);
                            $('#tp_jenis_kelamine').val(datavalue.jenis_kelamin);
                            $('#tp_tgl_lahire').val(datavalue.tgl_lahir);
                            // $('#tp_tipe_tarife').val(datavalue.tipe_tarif);

                            var ttlInte = parseFloat(datavalue.total_penjualan);

                            var formattedNumbers = ttlInte.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            });
                            $('#total_penjualan_show_onlyE').val(formattedNumbers);
                            $('#total_penjualanE').val(datavalue.total_penjualan);

                            $("#EditPenjualanList").append(`
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
                                                <input type="text" class="qty form-control" id="qty" name="qty[]" onKeyUp="getQTY(this)" value="${datavalue.qty}">
                                            </td>
                                            <td>
                                                <input type="text" class="cara_pakai form-control" id="cara_pakai" name="cara_pakai[]" value="${caraPakai}" readonly>
                                            </td>
                                          
                                            <td>
                                                <input type="text" class="form-control" id="tuslah"
                                                    name="tuslah[]" readonly value="${datavalue.tuslah}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="embalase"
                                                    name="embalase[]" readonly value="${datavalue.embalase}">
                                            </td>
                                              <td>
                                                <input type="text" class="form-control" id="diskon"
                                                    name="diskon[]" onKeyUp="getDiskon(this)" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="sub_totalEdit form-control" id="sub_total"
                                                    name="sub_total[]" readonly style="border: none;" value="${datavalue.sub_total}">
                                            </td>
                                            <td>
                                                <button type="button" class="remove btn btn-xs btn-danger"><i
                                                class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                                            </td>

                                            <input type="hidden" name="user" id="user" value="tes user">
                                        </tr>
                                        `);
                        })
                    }

                });
            };

            function DeleteTrs(del) {
                var kd_trs = $(del).data('kd_trsu');
                $('#confirmDelete').modal('show');
                $('#nomorTrs').val(kd_trs);

                $('#ListDeleteItem').empty();
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
                            $('#tgl_trsD').val(datavalue.tgl_trs);
                            // $('#tgl_trsD').val(datavalue.kd_trs);

                            $("#ListDeleteItem").append(`
                                <input type="hidden" name="kd_obat[]" id="kd_obatD" value="${datavalue.kd_obat}">
                                <input type="hidden" name="qty[]" id="qtyD" value="${datavalue.qty}">
                            `);
                        })
                    }

                });
            }

            function SelectItemObatEdit(f) {
                // $("#SelectItemObatxxx").on("click", function() {
                var getKdObat = $(f).data('fm_kd_obat');
                var getNmObat = $(f).data('fm_nm_obat');
                var getSatJual = $(f).data('fm_satuan_jual');
                var getHrg = $(f).data('fm_hrg_jual');


                $("#EditPenjualanList").append(`
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
                            <input type="text" class="form-control" id="tuslah"
                                name="tuslah[]" onKeyUp="getTuslah(this)" value="0">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="embalase"
                                name="embalase[]" onKeyUp="getEmbalase(this)" value="0">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="diskon"
                                name="diskon[]" onKeyUp="getDiskon(this)">
                        </td>
                        <td>
                            <input type="text" class="sub_totalEdit form-control" id="sub_total"
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

            function GrandTotalEdit() {
                var sum = 0;

                $('.sub_totalEdit').each(function() {
                    sum += Number($(this).val());
                });
                var result = sum.toFixed(2);

                $('#total_penjualanE').val(result);

                var ttlInt = parseFloat(result);

                var formattedNumber = ttlInt.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });

                $('#total_penjualan_show_onlyE').val(formattedNumber);
            }

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


            $(document).keydown(function(event) {
                if (event.keyCode == 120) {
                    return searchObatShow();
                }
                // } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
                //     return false;
                // }
            });

            // window.onload = getTipeTarif();

            // $(document).ready(function() {
            //     var table = $('#exm2').DataTable({
            //         // ajax: 'https://gyrocode.github.io/files/jquery-datatables/arrays.json',
            //         keys: {
            //             keys: [13 /* ENTER */ , 38 /* UP */ , 40 /* DOWN */ ]
            //         }
            //     });

            //     // Handle event when cell gains focus
            //     $('#exm2').on('key-focus.dt', function(e, datatable, cell) {
            //         // Select highlighted row
            //         $(table.row(cell.index().row).node()).addClass('selected');
            //     });

            //     // Handle event when cell looses focus
            //     $('#exm2').on('key-blur.dt', function(e, datatable, cell) {
            //         // Deselect highlighted row
            //         $(table.row(cell.index().row).node()).removeClass('selected');
            //     });

            //     // Handle key event that hasn't been handled by KeyTable
            //     $('#exm2').on('key.dt', function(e, datatable, key, cell, originalEvent) {
            //         // If ENTER key is pressed
            //         if (key === 13) {
            //             // Get highlighted row data
            //             var data = table.row(cell.index().row).data();

            //             // FOR DEMONSTRATION ONLY
            //             $("#example-console").html(data.join(', '));
            //         }
            //     });
            // });

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
