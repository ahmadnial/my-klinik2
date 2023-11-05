@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#addPenjualan">Tambah</button>
                <h3 class="card-title"><i class="fa fa-chart">&nbsp;</i>Transaksi Penjualan</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example1" class="table table-hover">
                        <thead class="">
                            <tr>
                                {{-- <th>Tanggal</th> --}}
                                <th>No Ref</th>
                                <th>No Faktur</th>
                                <th>Supplier</th>
                                <th>Tgl Jatuh Tempo</th>
                                <th>Dibuat</th>
                                <th>Nilai Faktur</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($viewDO as $tz) --}}
                            <tr>
                                {{-- <td id="">{{ $tz->created_at }}</td> --}}
                                {{-- <td id="">{{ $tz->do_hdr_kd }}</td>
                                    <td id="">{{ $tz->do_hdr_no_faktur }}</td>
                                    <td id="">{{ $tz->do_hdr_supplier }}</td>
                                    <td id="">{{ $tz->do_hdr_tgl_tempo }}</td>
                                    <td id="">{{ $tz->created_at }}</td>
                                    <td id="">@currency($tz->do_hdr_total_faktur)</td> --}}
                                {{-- <td id="">@currency($tz->fm_hrg_beli)</td>
                                    <td id="">@currency($tz->fm_hrg_jual_non_resep)</td>
                                    <td id="">@currency($tz->fm_hrg_jual_resep)</td>
                                    <td id="">@currency($tz->fm_hrg_jual_nakes)</td> --}}
                                <td><button class="btn btn-xs btn-success" data-toggle="modal"
                                        data-target="#EditObat">Edit</button>
                                    <button class="btn btn-xs btn-danger" data-toggle="modal"
                                        data-target="#DeleteSupplier">Hapus</button>
                                </td>
                            </tr>
                            {{-- @endforeach --}}
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
            max-width: none;
            height: auto;
            margin: 40;
        }

        .modal .modal-content {
            height: auto;
            border: 0;
            border-radius: 0;
        }

        .modal .modal-body {
            overflow-y: auto;
        }
    </style>
    <!-- The modal Create -->
    <div class="modal fade" id="addPenjualan" data-backdrop="static">
        <div class="modal-dialog modal-xl fullmodal">
            <div class="modal-content document">
                <div class="modal-header">
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
                                <input type="text" class="form-control" name="tp_kd_trs" id="tp_kd_trs" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">kd Resep</label>
                                <select class="form-control" id="tp_kd_order" style="width: 100%;" name="tp_kd_order">
                                    <option value="">--Select--</option>

                                </select>
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
                            <div class="form-group col-sm-2">
                                <label for="">Lokasi Stock</label>
                                <select class="form-control-pasien" id="tp_lokasi_stock" style="width: 100%;"
                                    name="tp_lokasi_stock">
                                    <option value="">--Select--</option>

                                </select>
                            </div>
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
                            <button type="button" id="obatSearch" class="btn btn-info">tambah</button>
                        </div>
                    </div>

                    {{-- <hr> --}}

                    <table class="table table-stripped" style="width: 100%">
                        <thead>
                            <tr>
                                <th>kd obat</th>
                                <th>Nama Obat</th>
                                <th>Dosis</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Disc</th>
                                <th>Satuan</th>
                                <th>Tax</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>

                        <tbody id="ListObatJual">
                            {{-- <tr>
                                <td class="">
                                    <input class="searchObat form-control" style='width: 100%;' style="border: none"
                                        id="do_obat" name="do_obat[]" placeholder="kode obat" readonly
                                        style="border: none;">
                                </td>
                                <td>
                                    <input class="searchObat form-control" style='width: 100%;' id="do_obat"
                                        name="do_obat[]" ondblclick="getListObat()" aria-placeholder="Search">
                                </td>
                                <td>
                                    <input type="text" class="do_satuan_pembelian form-control"
                                        id="do_satuan_pembelian" name="do_satuan_pembelian[]" readonly
                                        style="border: none;">
                                </td>
                                <td>
                                    <input type="text" class="form-control" style="border: none;">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="do_diskon" name="do_diskon[]"
                                        style="border: none;">
                                </td>
                                <td>
                                    <input type="number" class="do_qty form-control" id="do_qty[]" name="do_qty[]"
                                        style="border: none;">
                                </td>
                                <td>
                                    <input type="text" class="do_isi_pembelian form-control" id="do_isi_pembelian"
                                        name="do_isi_pembelian[]" readonly style="border: none;">
                                </td>
                                <td>
                                    <input type="text" class="do_satuan_jual form-control" id="do_satuan_jual"
                                        name="do_satuan_jual[]" readonly style="border: none;">
                                </td>
                                <td>
                                    <input type="text" class="do_hrg_beli form-control" id="do_hrg_beli"
                                        name="do_hrg_beli[]" readonly style="border: none;">
                                </td>

                                <input type="hidden" name="user" id="user" value="tes user">
                                <td>
                                    <button class="remove btn btn-xs btn-danger " id="delRow"><i
                                            class="fa fa-close"></i></button>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                    <hr>
                    <div class="float-right col-4">
                        <div class="float-right col-4">
                            <input type="text" class="form-control float-right" name="do_hdr_total_faktur"
                                id="do_hdr_total_faktur" value="" readonly>
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


    <div class="modal fade" id="obatSearchShow">
        <div class="modal-dialog modal-lg">
            <div class="modal-content document">
                <div class="modal-header">
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
                                <th>Harga Jual Reguler</th>
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

        @push('scripts')
            <script>
                $('#tp_kd_order').select2({
                    placeholder: 'Search E-Resep',
                });

                $('#tp_lokasi_stock').select2({
                    placeholder: 'Search Lokasi Stock',
                });

                $('#tp_tipe_tarif').select2({
                    placeholder: 'Search Lokasi Stock',
                });

                $("#obatSearch").on("click", function() {
                    $('#obatSearchShow').modal('show');

                    // alert('helo');
                });

                function getTipeTarif() {
                    toastr.info('Harga Reguler Selected!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    var tes = $('#tp_tipe_tarif').val();

                    if (tes == 'Reguler') {
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
                                // $.each(isTimelineHistory, function(key, getVal) {
                                $(".getListObatx").empty();
                                var getValue = isObatReguler;
                                for (var getVal = 0; getVal < getValue.length; getVal++) {
                                    $(".getListObatx").append(`
                                    <tr>
                                        <td><input class="getItemObat col-4" style="border: none" readonly value="${getValue[getVal].fm_kd_obat}"></td>
                                        <td id="kd_obat">${getValue[getVal].fm_nm_obat}</td>
                                        <td>${getValue[getVal].fm_satuan_jual}</td>
                                        <td>${getValue[getVal].fm_hrg_jual_non_resep}</td>
                                        <td><button type="button" class="btn btn-info btn-xs" id="SelectItemObat"
                                                data-fm_kd_obat="${getValue[getVal].fm_kd_obat}"
                                                data-fm_nm_obat="${getValue[getVal].fm_nm_obat}"
                                                data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}"
                                                data-fm_hrg_jual_non_resep="${getValue[getVal].fm_hrg_jual_non_resep}" onClick="SelectItemObat()">Select</button>
                                        </td>
                                    </tr>`)
                                }

                            }
                        })

                    } else if (tes == 'Resep') {
                        toastr.info('Harga Resep Selected!', {
                            timeOut: 600,
                            // preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        $(".getListObatx").empty();
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
                                // $.each(isTimelineHistory, function(key, getVal) {
                                $(".getListObatx").empty();
                                var getValue = isObatResep;
                                for (var getVal = 0; getVal < getValue.length; getVal++) {
                                    $(".getListObatx").append(`
                                    <tr>
                                        <td><input class="getItemObat col-4" style="border: none" readonly value="${getValue[getVal].fm_kd_obat}"></td>
                                        <td>${getValue[getVal].fm_nm_obat}</td>
                                        <td>${getValue[getVal].fm_satuan_jual}</td>
                                        <td>${getValue[getVal].fm_hrg_jual_resep}</td>
                                        <td><button type="button" class="SelectItemObat btn btn-info btn-xs" id="SelectItemObat" onClick="SelectItemObat()"
                                                data-fm_kd_obat="${getValue[getVal].fm_kd_obat}"
                                                data-fm_nm_obat="${getValue[getVal].fm_nm_obat}"
                                                data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}"
                                                data-fm_hrg_jual_non_resep="${getValue[getVal].fm_hrg_jual_resep}">Select</button>
                                        </td>
                                    </tr>`)
                                }

                            }
                        })
                    } else {
                        toastr.info('Harga Nakes Selected!', {
                            timeOut: 600,
                            // preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        $(".getListObatx").empty();
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
                                // $.each(isTimelineHistory, function(key, getVal) {
                                $(".getListObatx").empty();
                                var getValue = isObatNakes;
                                for (var getVal = 0; getVal < getValue.length; getVal++) {
                                    $(".getListObatx").append(`
                                    <tr>
                                        <td><input class="getItemObat col-4" style="border: none" readonly value="${getValue[getVal].fm_kd_obat}"></td>
                                        <td>${getValue[getVal].fm_nm_obat}</td>
                                        <td>${getValue[getVal].fm_satuan_jual}</td>
                                        <td>${getValue[getVal].fm_hrg_jual_nakes}</td>
                                        <td><button type="button" class="SelectItemObat btn btn-info btn-xs" id="SelectItemObat" onClick="SelectItemObat()"
                                                data-fm_kd_obat="${getValue[getVal].fm_kd_obat}"
                                                data-fm_nm_obat="${getValue[getVal].fm_nm_obat}"
                                                data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}"
                                                data-fm_hrg_jual_non_resep="${getValue[getVal].fm_hrg_jual_nakes}">Select</button>
                                        </td>
                                    </tr>`)
                                }
                            }
                        })
                    }
                };

                function getListObat() {
                    $('#obatSearchShow').modal('show');
                }

                function SelectItemObat() {

                    var getKdObat = $(this).data('fm_kd_obat');
                    var getNmObat = $(this).data('fm_nm_obat');
                    var getSatJual = $(this).data('fm_satuan_jual');
                    var getHrgnonResep = $(this).data('fm_hrg_jual_non_resep');

                    console.log(getKdObat);

                    $("#ListObatJual").append(`
                    <tr>
                        <td class="">
                            <input class="searchObat form-control" style='width: 100%;' style="border: none"
                                id="do_obat" name="do_obat[]" placeholder="kode obat" readonly
                                style="border: none;" value="${getKdObat}">
                        </td>
                        <td>
                            <input class="searchObat form-control" style='width: 100%;' id="do_obat"
                                name="do_obat[]" ondblclick="getListObat()" aria-placeholder="Search" value="${getNmObat}">
                        </td>
                        <td>
                            <input type="text" class="do_satuan_pembelian form-control"
                                id="do_satuan_pembelian" name="do_satuan_pembelian[]" readonly
                                style="border: none;">
                        </td>
                        <td>
                            <input type="text" class="form-control" style="border: none;" value=${getHrgnonResep}>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="do_diskon" name="do_diskon[]"
                                style="border: none;">
                        </td>
                        <td>
                            <input type="number" class="do_qty form-control" id="do_qty[]" name="do_qty[]"
                                style="border: none;">
                        </td>
                        <td>
                            <input type="text" class="do_isi_pembelian form-control" id="do_isi_pembelian"
                                name="do_isi_pembelian[]" readonly style="border: none;">
                        </td>
                        <td>
                            <input type="text" class="do_satuan_jual form-control" id="do_satuan_jual"
                                name="do_satuan_jual[]" readonly style="border: none;">
                        </td>
                        <td>
                            <input type="text" class="do_hrg_beli form-control" id="do_hrg_beli"
                                name="do_hrg_beli[]" readonly style="border: none;">
                        </td>

                        <input type="hidden" name="user" id="user" value="tes user">
                        <td>
                            <button class="remove btn btn-xs btn-danger " id="delRow"><i
                                    class="fa fa-close"></i></button>
                        </td>
                    </tr>
                    
                    `);
                    $('#obatSearchShow').modal('hide');

                };


                // shortcut.add("F12", function() {
                //     alert("F12 pressed");
                // });
            </script>
        @endpush
    @endsection
