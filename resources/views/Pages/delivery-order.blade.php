@extends('pages.master')

@section('mytitle', 'Penerimaan Barang')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal" data-target="#TambahDO">Tambah
                    DO</button>
                <h3 class="card-title"><i class="fa fa-truck">&nbsp;</i>PENERIMAAN BARANG</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example1" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Tanggal Trs</th>
                                <th>No Ref</th>
                                <th>No Faktur</th>
                                <th>Supplier</th>
                                <th>Tgl Jatuh Tempo</th>
                                <th>Nilai Faktur</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewDO as $tz)
                                <tr>
                                    {{-- <td id="">{{ $tz->created_at }}</td> --}}
                                    <td id="">{{ $tz->created_at->format('d M Y h:i A') }}</td>
                                    <td id="">{{ $tz->do_hdr_kd }}</td>
                                    <td id="">{{ $tz->do_hdr_no_faktur }}</td>
                                    <td id="">{{ $tz->do_hdr_supplier }}</td>
                                    <td id="">{{ $tz->do_hdr_tgl_tempo }}</td>
                                    <td id="">@currency($tz->do_hdr_total_faktur)</td>
                                    {{-- <td id="">{{ $tz->hdrToDetail[0]->do_obat }}</td> --}}
                                    <td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#EditXDo"
                                            onclick="getDetailDO(this)" data-kd_do="{{ $tz->do_hdr_kd }}"
                                            data-no_faktur="{{ $tz->do_hdr_no_faktur }}"
                                            data-supplier="{{ $tz->do_hdr_supplier }}"
                                            data-tgl_tempo="{{ $tz->do_hdr_tgl_tempo }}" data-kd_obat="{{ $tz->do_obat }}"
                                            data-nm_obat="{{ $tz->hdrToDetail[0]->do_obat }}">View</button>
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
            padding: 0 !important;
        }

        #TambahDO .fullmodal {
            width: 95%;
            max-width: none;
            height: auto;
            margin: 40;
        }

        #EditDO .fullmodal {
            width: 95%;
            max-width: none;
            height: auto;
            margin: 40;
        }

        .scrollable-table {
            /* overflow-y: initial !important */
            max-height: 370px;
            /* max-width: 970px; */
            overflow-y: scroll;
            white-space: nowrap;
            overflow-x: scroll;
        }

        /* th {
                                                                                                    min-width: 180px;
                                                                                                } */

        .modal-footer {
            position: sticky;
            bottom: 0;
            background-color: #f8f9fa;
            padding: 10px;
            padding-right: 10px;
        }
    </style>
    <!-- The modal Create -->
    <div class="modal fade" id="TambahDO" data-backdrop="static">
        <div class="modal-dialog modal-xl fullmodal">
            <div class="modal-content document">
                <div class="modal-header bg-info">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Delivery Order</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('add-delivery-order') }}" onkeydown="return event.key != 'Enter';"
                    class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="">Nomor Ref</label>
                                <input type="text" class="form-control" name="do_hdr_kd" id="do_hdr_kd"
                                    value="{{ $noRef }}" readonly>
                            </div>
                            <div class="form-group col-sm-2 has-validation">
                                <label for="tanggal_trs" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tanggal_trs" id="tanggal_trs"
                                    value="{{ $dateNow }}" required>
                                <div class="invalid-feedback">
                                    Please..dont let me blank
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="">Nomor Faktur</label>
                                <input type="text" class="form-control" name="do_hdr_no_faktur" id="do_hdr_no_faktur"
                                    value="{{ old('do_hdr_no_faktur') }}" placeholder="Input Nomor Faktur" required>
                                <div class="invalid-feedback">
                                    Please..dont let me blank
                                </div>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Supplier</label>
                                <select class="do_hdr_supplier form-control-pasien" id="do_hdr_supplier"
                                    style="width: 100%;" name="do_hdr_supplier" required>
                                    <option value="">--Select--</option>
                                    @foreach ($supplier as $sp)
                                        <option value="{{ $sp->fm_nm_supplier }}">{{ $sp->fm_nm_supplier }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please..dont let me blank</div>
                            </div>
                            <div class="form-group">
                                <label class="form-check-label" for="flexCheckDefault">
                                    <input class="checkbox form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault" onchange="getTglTempo();">
                                    Kredit
                                    <div class="invalid-feedback">
                                        Please..dont let me blank
                                    </div>
                                </label>
                            </div>
                            <div class="tglJatuhtempo form-group col-sm-2">

                            </div>
                            {{-- <div class="form-group col-sm-2">
                                <label for="">Lokasi</label>
                                <select class="do_hdr_lokasi_stock form-control-pasien" id="do_hdr_lokasi_stock"
                                    style="width: 100%;" name="do_hdr_lokasi_stock">
                                    <option value="">--Select--</option>
                                    @foreach ($lokasi as $lok)
                                        <option value="{{ $lok->fm_nm_lokasi_stock }}">{{ $lok->fm_nm_lokasi_stock }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <input type="hidden" id="hs_kd_hutang" name="hs_kd_hutang" value="{{ $noRefHT }}">
                        </div>
                        <div class="">
                            <button type="button" id="searchObat" onclick="getBarang()" class="btn btn-info"><i
                                    class="fa fa-plus">&nbsp;Item</i></button>
                            <i class="text-danger text-sm float-right">
                                *Tekan F9 untuk membuka List Obat/Klik Tombol +Item
                            </i>
                        </div>
                    </div>

                    {{-- <hr> --}}
                    <div class="scrollable-table">
                        <table class="table table-bordered" id="deliverOrder">
                            <thead style="background-color: aliceblue">
                                <tr>
                                    {{-- <th>Kode Obat</th> --}}
                                    <th width="250px">Obat</th>
                                    <th>Sat.Beli</th>
                                    <th>Hrg.Beli</th>
                                    <th>Qty</th>
                                    <th width="60px">Isi</th>
                                    <th width="90px">Sat.Jual</th>
                                    <th>Disc %</th>
                                    <th>Disc</th>
                                    <th width="100px">Pajak</th>
                                    <th width="40px">Tgl.Exp</th>
                                    <th>Batch No.</th>
                                    <th width="110px">Sub Total</th>
                                    <th>updt hrg</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody id="doTable">
                                <tr>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>

                    <br>
                    <br>
                    {{-- <hr> --}}
                    <div class="modal-footer">
                        <div class="float-right col-4">
                            <div class="float-right col-4">
                                <input type="text" class="form-control float-right" name=""
                                    id="do_hdr_total_faktur_show_only" value="" readonly>
                                <input type="hidden" class="form-control float-right" name="do_hdr_total_faktur"
                                    id="do_hdr_total_faktur" value="" readonly>
                            </div>
                        </div>
                        <button type="submit" id="buat" class="btn btn-success float-right"><i
                                class="fa fa-save"></i>&nbsp;Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The modal Edit -->
    <div class="modal xeditmodal fade" id="EditDO">
        <div class="modal-dialog modal-xl fullmodal">
            <div class="modal-content document">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Penerimaan Barang</h4>
                    <button type="button" class="close btn btn-danger" id="EditDOClose" data-dismiss="close"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('edit-delivery-order') }}" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="modal-body" id="AppendEditDO">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="obatSearch">
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
                                <th>Satuan beli</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="listGetBarang">

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

    @push('scripts')
        <script>
            // $(document).ready(function() {
            //     $('#deliverOrder').DataTable({
            //         "scrollX": true,
            //         "scrollY": 200,
            //     });
            //     $('.dataTables_length').addClass('bs-select');
            // });
            // $(".checkbox").change(function() {
            //     if (this.checked) {
            //         $('.tglJatuhtempo').append(
            //             `
    //             <label for="">Tanggal Jatuh Tempo</label>
    //             <input type="date" class="form-control" name="do_hdr_tgl_tempo" id="do_hdr_tgl_tempo"
    //             value="" required>
    //             `
            //         )
            //     }
            // });

            function getTglTempo() {
                if ($('.checkbox').is(":checked"))
                    $('.tglJatuhtempo').append(
                        `
                        <label for="">Tanggal Jatuh Tempo</label>
                        <input type="date" class="form-control" name="do_hdr_tgl_tempo" id="do_hdr_tgl_tempo"
                        value="" required>
                        `
                    )
                else
                    $('.tglJatuhtempo').empty();
            }

            function getBarang() {
                $('#obatSearch').modal('show');

                // var table = $('#exm2').DataTable();
                // var rows = table
                //     .rows()
                //     .remove()
                //     .draw();

                $.ajax({
                    // headers: {
                    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    // },
                    // url: "{{ url('getListObatDO') }}",
                    // type: 'GET',

                    success: function(listObat) {
                        $('#exm2').DataTable({
                            processing: true,
                            serverSide: true,
                            responsive: true,
                            "bDestroy": true,
                            ajax: "{{ url('getListObatDO') }}",
                            columns: [{
                                    data: 'fm_kd_obat',
                                    name: 'fm_kd_obat'
                                },
                                {
                                    data: 'fm_nm_obat',
                                    name: 'fm_nm_obat'
                                },
                                {
                                    data: 'fm_satuan_pembelian',
                                    name: 'fm_satuan_pembelian'
                                },
                                // {
                                //     data: 'fm_hrg_jual_non_resep',
                                //     name: 'fm_hrg_jual_non_resep'
                                // },
                                // {
                                //     data: 'qty',
                                //     name: 'qty'
                                // },
                                {
                                    data: 'action',
                                    name: 'action'
                                },
                            ]
                        });
                        // var getValue = listObat;
                        // for (var getVal = 0; getVal < getValue.length; getVal++) {

                        //     const table = $('#exm2').DataTable();
                        //     var btnBtn =
                        //         `<button class="SelectItemObat btn btn-success btn-xs" id="SelectItemObat" onClick="SelectItemObat(this)" data-fm_kd_obat="${getValue[getVal].fm_kd_obat}" data-fm_nm_obat="${getValue[getVal].fm_nm_obat}" data-fm_satuan_pembelian="${getValue[getVal].fm_satuan_pembelian}" data-fm_isi_satuan_pembelian="${getValue[getVal].fm_isi_satuan_pembelian}" data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}" data-fm_hrg_beli="${getValue[getVal].fm_hrg_beli}">Select</button>`
                        //     const dataBaru = [
                        //         [getValue[getVal].fm_kd_obat, getValue[getVal].fm_nm_obat, getValue[getVal]
                        //             .fm_satuan_pembelian, btnBtn
                        //         ],
                        //     ]

                        //     function injectDataBaru() {
                        //         for (const data of dataBaru) {
                        //             table.row.add([
                        //                 data[0],
                        //                 data[1],
                        //                 data[2],
                        //                 data[3],
                        //             ]).draw(false)
                        //         }
                        //     }
                        //     injectDataBaru()
                        // }

                    }
                })
            }

            // $(".SelectItemObat").on("click", function() {
            function SelectItemObatDO(x) {
                var getKdObat = $(x).data('fm_kd_obat');
                var getNmObat = $(x).data('fm_nm_obat');
                var getSatBeli = $(x).data('fm_satuan_pembelian');
                var getIsiSatBeli = $(x).data('fm_isi_satuan_pembelian');
                var getSatJual = $(x).data('fm_satuan_jual');
                var getHrgBeli = $(x).data('fm_hrg_beli');
                var getHrgBeliDetail = $(x).data('fm_hrg_beli_detail');

                $("#doTable").append(`
                        <tr id="R${++rowIdx}">
                          <input type="hidden" class="searchObat" id="do_obat"
                                name="do_obat[]" onchange="getDataObat()" value="${getKdObat}" readonly>
                            
                            <td>
                          <input class="form-control" style='width: 100%;' id="nm_obat"
                                name="nm_obat[]" onchange="getDataObat()" value="${getNmObat}" readonly>
                            </td>
                            <td>
                                <input type="text" class="do_satuan_pembelian form-control" id="do_satuan_pembelian[]"
                                    name="do_satuan_pembelian[]" value="${getSatBeli}" readonly>
                            </td>
                            <td>
                                <input type="text" class="do_hrg_beli form-control" id="do_hrg_beli" name="do_hrg_beli[]"
                                 value="${getHrgBeli}">
                            </td>
                            <td>
                                <input type="text" class="do_qty form-control" id="do_qty" onKeyUp="getQTY(this)" name="do_qty[]">
                            </td>
                            <td>
                                <input type="text" class="do_isi_pembelian form-control" id="do_isi_pembelian"
                                    name="do_isi_pembelian[]" value="${getIsiSatBeli}" readonly>
                            </td>
                            <td>
                                <input type="text" class="do_satuan_jual form-control" id="do_satuan_jual" name="do_satuan_jual[]"
                                    value="${getSatJual}" readonly>
                            </td>
                            <td>
                            <input type="text" class="form-control" name="do_diskon_prosen[]" id="do_diskon_prosen" onKeyDown="discProsen(this)">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_diskon" name="do_diskon[]" onKeyDown="discRp(this)">
                            </td>
                            <td>
                                <select type="text" class="form-control" id="do_pajak" name="do_pajak[]" onChange="pajakPPN(this)">
                                    <option value="Tanpa Pajak">Tanpa Pajak</option>
                                    <option value="11">PPN 11%</option>
                                </select>
                            </td>
                            <td>
                                <input type="date" class="form-control" id="do_tgl_exp" name="do_tgl_exp[]" required>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_batch_number"
                                    name="do_batch_number[]" required>
                            </td>
                            <td>
                                <input type="text" class="do_sub_total form-control" id="do_sub_total" name="do_sub_total[]">
                            </td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="updateHrg" name="updateHrg[]" value="${getKdObat}">
                                    <label class="form-check-label" for="flexCheckDefault">
                                    </label>
                                </div>
                            </td>
                            <td>
                                 <button type="button" class="remove btn btn-xs btn-danger"><i class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                            </td>
                                <input type="hidden" class="do_hrg_beli_detail form-control" id="do_hrg_beli_detail" name="do_hrg_beli_detail[]" value="${getHrgBeliDetail}">
                   
                </tr>`);

                $('#obatSearch').modal('hide');
            };

            function deleteRow(btn) {
                var row = btn.parentNode.parentNode.parentNode;
                row.parentNode.removeChild(row);
                GrandTotal();
            }

            // $(document).ready(function() {
            function getQTY(q) {
                // $('#calculation').on("keyup", ".do_hrg_beli", function() {
                var parent = q.parentElement.parentElement;
                var quant = $(parent).find('#do_qty').val();
                var price = $(parent).find('#do_hrg_beli').val();
                // console.log(quant);
                var x = quant * price;
                var result = x.toFixed(2);
                $(parent).find('#do_sub_total').val(result);
                GrandTotal();
                // });

            };

            function discProsen(x) {
                var parentx = x.parentElement.parentElement;
                var tdsc = $(parentx).find('#do_diskon_prosen').val();
                if (event.keyCode == 13 && tdsc != '') {
                    // var parentx = x.parentElement.parentElement;
                    // var tdsc = $(parentx).find('#do_diskon_prosen').val();
                    // var price = $(parentx).find('#do_sub_total').val();
                    var subttl = $(parentx).find('#do_sub_total').val();
                    var calc = (tdsc / 100) * subttl;

                    var result = calc.toFixed(2);
                    // console.log(result);
                    $(parentx).find('#do_diskon').val(result);
                    var dsc = $(parentx).find('#do_diskon').val();

                    var hasil = parseInt(subttl) - parseInt(dsc);

                    $(parentx).find('#do_sub_total').val(hasil);

                    // console.log(result);
                } else if (event.keyCode == 13 && tdsc == '') {
                    var qty = $(parentx).find('#do_qty').val();
                    var hrgBeli = $(parentx).find('#do_hrg_beli').val();
                    var recalc = hrgBeli * qty;
                    var toDecimalFalse = recalc.toFixed(2);

                    $(parentx).find('#do_sub_total').val(toDecimalFalse);
                    $(parentx).find('#do_diskon').val('');
                }
                GrandTotal();
            }

            function discRp(r) {
                var parentR = r.parentElement.parentElement;
                var tdscr = $(parentR).find('#do_diskon').val();
                if (event.keyCode == 13 && tdscr != '') {
                    var subttl = $(parentR).find('#do_sub_total').val();
                    var calc = (tdscr / subttl) * 100;
                    var toFix = subttl - tdscr;
                    var toDecimal = toFix.toFixed(2);
                    var result = calc.toFixed(2);

                    if (tdscr != 0) {
                        $(parentR).find('#do_sub_total').val(toDecimal);
                        $(parentR).find('#do_diskon_prosen').val(result);
                    } else {
                        $(parentR).find('#do_sub_total').val(subttl);
                        // $(parentR).find('#do_diskon_prosen').val();
                    }
                } else if (event.keyCode == 13 && tdscr == '') {
                    var qty = $(parentR).find('#do_qty').val();
                    var hrgBeli = $(parentR).find('#do_hrg_beli').val();
                    var recalc = hrgBeli * qty;
                    var toDecimalFalse = recalc.toFixed(2);

                    $(parentR).find('#do_sub_total').val(toDecimalFalse);
                    $(parentR).find('#do_diskon_prosen').val('');
                }
                GrandTotal();
            }

            function GrandTotal() {
                var sum = 0;

                $('.do_sub_total').each(function() {
                    sum += Number($(this).val());
                });
                var result = sum.toFixed(2);

                $('#do_hdr_total_faktur').val(result);

                var ttlInt = parseFloat(result);

                var formattedNumber = ttlInt.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });

                $('#do_hdr_total_faktur_show_only').val(formattedNumber);
            }


            function pajakPPN(p) {
                var parentP = p.parentElement.parentElement;
                var pajak = $(parentP).find('#do_pajak').val();
                var subttl = $(parentP).find('#do_sub_total').val();
                if (pajak == '11') {
                    var calc = subttl * (11 / 100);
                    var toFix = parseFloat(subttl) + parseFloat(calc);
                    var toDecimal = toFix.toFixed(2);
                    $(parentP).find('#do_sub_total').val(toDecimal);
                    // console.log(toDecimal)
                } else {
                    var qty = $(parentP).find('#do_qty').val();
                    var hrgBeli = $(parentP).find('#do_hrg_beli').val();
                    var recalc = hrgBeli * qty;
                    var toDecimalFalse = recalc.toFixed(2);

                    $(parentP).find('#do_sub_total').val(toDecimalFalse);
                }
                GrandTotal();
            }


            // Ajax Search Obat
            var path = "{{ route('obatSearch') }}";

            $('#do_obatt').select2({
                placeholder: 'Obat / Barang',
                ajax: {
                    url: path,
                    dataType: 'json',
                    delay: 150,
                    processResults: function(isdataObat) {
                        return {
                            results: $.map(isdataObat, function(item) {
                                return {
                                    // text: item.fs_mr,
                                    text: item.fm_nm_obat,
                                    id: item.fm_kd_obat,
                                    // alamat: item.fs_alamat,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            // Call Hasil Search Obat
            function getDataObat() {
                var obat = $('#do_obat').val();
                // alert(obat);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getObatList') }}/" + obat,
                    type: 'GET',
                    data: {
                        'fm_kd_obat': obat
                    },
                    success: function(isdataObat) {
                        // var json = isdata2;
                        $.each(isdataObat, function(key, datavalue) {
                            $('.do_satuan_pembelian').val(datavalue.fm_satuan_pembelian);
                            $('.do_hrg_beli').val(datavalue.fm_hrg_beli);
                            $('.do_satuan_jual').val(datavalue.fm_satuan_jual);
                            $('.do_isi_pembelian').val(datavalue.fm_isi_satuan_pembelian);
                            // $('#fr_tgl_lahir').val(datavalue.fs_tgl_lahir);
                            // $('#fr_jenis_kelamin').val(datavalue.fs_jenis_kelamin);
                        })
                    }
                })
            };

            var rowIdx = 1;
            $("#addRow").on("click", function() {
                // Adding a row inside the tbody.
                $("#doTable tbody").append(`
                <tr id="R${++rowIdx}">
                    <td>
                         <select class="do_obat form-control" style='width: 100%;' id="do_obat[]" name="do_obat[]"
                                    onchange="getDataObat()"></select>
                            </td>
                            <td>
                                <input type="text" class="do_satuan_pembelian form-control" id="do_satuan_pembelian[]"
                                    name="do_satuan_pembelian[]" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_diskon" name="do_diskon[]">
                            </td>
                            <td>
                                <input type="text" class="do_qtyy form-control" id="do_qtyy" name="do_qty[]">
                            </td>
                            <td>
                                <input type="text" class="do_isi_pembelian form-control" id="do_isi_pembelian"
                                    name="do_isi_pembelian[]" readonly>
                            </td>
                            <td>
                                <input type="text" class="do_satuan_jual form-control" id="do_satuan_jual" name="do_satuan_jual[]"
                                    readonly>
                            </td>
                            <td>
                                <input type="text" class="do_hrg_belii form-control" id="do_hrg_belii" name="do_hrg_beli[]"
                                    readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_pajak" name="do_pajak[]">
                            </td>
                            <td>
                                <input type="date" class="form-control" id="do_tgl_exp" name="do_tgl_exp[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_batch_number"
                                    name="do_batch_number[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_sub_total" name="do_sub_total[]"
                                    >
                            </td>
                    <td><a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove"><i class="fa fa-trash"></i></a></td>
                   
                </tr>`);

                // Ajax Search Obat
                var path = "{{ route('obatSearch') }}";

                $('.do_obatt').select2({
                    placeholder: 'Obat / Barang',
                    ajax: {
                        url: path,
                        dataType: 'json',
                        delay: 150,
                        processResults: function(isdataObat) {
                            return {
                                results: $.map(isdataObat, function(item2) {
                                    return {
                                        // text: item.fs_mr,
                                        text: item2.fm_nm_obat,
                                        id: item2.fm_kd_obat,
                                        // alamat: item.fs_alamat,
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });

                // Call Hasil Search Obat
                // function getDataObat() {
                //     var obat = $('.do_obat').val();
                //     // alert(obat);
                //     $.ajax({
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         url: "{{ url('getObatList') }}/" + obat,
                //         type: 'GET',
                //         data: {
                //             'fm_kd_obat': obat
                //         },
                //         success: function(isdataObat) {
                //             // var json = isdata2;
                //             $.each(isdataObat, function(key, datavalue2) {
                //                 $('#do_satuan_pembelian').val(datavalue2.fm_satuan_pembelian);
                //                 $('.do_hrg_beli').val(datavalue2.fm_hrg_beli);
                //                 $('.do_satuan_jual').val(datavalue2.fm_satuan_jual);
                //                 $('.do_isi_pembelian').val(datavalue2.fm_isi_satuan_pembelian);
                //                 // $('#fr_tgl_lahir').val(datavalue.fs_tgl_lahir);
                //                 // $('#fr_jenis_kelamin').val(datavalue.fs_jenis_kelamin);
                //             })
                //         }
                //     })
                // };
            });

            $(document).on('click', '.remove', function() {
                // var delete_row = $(this).data("row");
                $('.addNewRow').remove();
            });


            // Select2 call
            $('.do_hdr_supplier').select2({
                placeholder: 'Supplier',
            });

            $('.do_hdr_lokasi_stock').select2({
                placeholder: 'Lokasi Stock',
            });
            // Select2 call
            $('.edo_hdr_supplier').select2({
                placeholder: 'Supplier',
            });

            $('.edo_hdr_lokasi_stock').select2({
                placeholder: 'Lokasi Stock',
            });



            // Auto Currency
            // var rupiah1 = document.getElementById("fm_hrg_beli");

            // rupiah1.addEventListener('keyup', function(e) {

            //     rupiah1.value = formatRupiah(this.value, 'Rp. ');
            // });


            // function formatRupiah(angka, prefix) {
            //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
            //         split = number_string.split(','),
            //         sisa = split[0].length % 3,
            //         rupiah1 = split[0].substr(0, sisa),
            //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            //     if (ribuan) {
            //         separator = sisa ? '.' : '';
            //         rupiah1 += separator + ribuan.join('.');
            //     }

            //     rupiah1 = split[1] != undefined ? rupiah1 + ',' + split[1] : rupiah1;
            //     return prefix == undefined ? rupiah1 : (rupiah1 ? 'Rp. ' + rupiah1 : '');
            // };



            // $(document).ready(function() {
            //     $('#buat').on('click', function() {
            //         var fm_hrg_beli = $('#fm_hrg_beli').val();
            //         var show = parseInt(fm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
            //         alert(show);
            //     })
            // });

            // Create 
            $(document).ready(function() {
                $('#buatt').on('click', function() {
                    var do_hdr_kd = $('#do_hdr_kd').val();
                    var do_hdr_no_faktur = $('#do_hdr_no_faktur').val();
                    var do_hdr_supplier = $('#do_hdr_supplier').val();
                    var do_hdr_tgl_tempo = $('#do_hdr_tgl_tempo').val();
                    var do_hdr_lokasi_stock = $('#do_hdr_lokasi_stock').val();
                    var do_hdr_total_faktur = $('#do_hdr_total_faktur').val();
                    var user = $('#user').val();

                    // Detail Do
                    var do_obat = $('#do_obat').val();
                    var do_satuan_pembelian = $('#do_satuan_pembelian').val();
                    var do_diskon = $('#do_diskon').val();
                    var do_qty = $('#do_qty').val();
                    var do_isi_pembelian = $('#do_isi_pembelian').val();
                    var do_satuan_jual = $('#do_satuan_jual').val();
                    var do_hrg_beli = $('#do_hrg_beli').val();
                    var do_pajak = $('#do_pajak').val();
                    var do_tgl_exp = $('#do_tgl_exp').val();
                    var do_batch_number = $('#do_batch_number').val();
                    var do_sub_total = $('#do_sub_total').val();
                    // var do_hdr_kd = $('#do_hdr_kd').val();

                    // ubah currency ke string biasa
                    // var sfm_hrg_beli = parseInt(fm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
                    // var sfm_hrg_jual_non_resep = parseInt(fm_hrg_jual_non_resep.replace(/,.*|[^0-9]/g, ''), 10);
                    // var sfm_hrg_jual_resep = parseInt(fm_hrg_jual_resep.replace(/,.*|[^0-9]/g, ''), 10);
                    // var sfm_hrg_jual_nakes = parseInt(fm_hrg_jual_nakes.replace(/,.*|[^0-9]/g, ''), 10);

                    if (do_hdr_no_faktur != "") {
                        var selWeight = [];
                        $('input[name="do_obat"]').each(function() {
                            if ($(this).val() != '') {
                                selWeight.push($(this).val());
                            }
                        });
                        alert(selWeight);
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ url('add-delivery-order') }}",
                            type: "POST",
                            data: {
                                type: 2,
                                do_hdr_kd: do_hdr_kd,
                                do_hdr_no_faktur: do_hdr_no_faktur,
                                do_hdr_supplier: do_hdr_supplier,
                                do_hdr_tgl_tempo: do_hdr_tgl_tempo,
                                do_hdr_lokasi_stock: do_hdr_lokasi_stock,
                                do_hdr_total_faktur: do_hdr_total_faktur,
                                user: user,

                                // Detail Do
                                do_obat: do_obat,
                                do_satuan_pembelian: do_satuan_pembelian,
                                do_diskon: do_diskon,
                                do_qty: do_qty,
                                do_isi_pembelian: do_isi_pembelian,
                                do_satuan_jual: do_satuan_jual,
                                do_hrg_beli: do_hrg_beli,
                                do_pajak: do_pajak,
                                do_tgl_exp: do_tgl_exp,
                                do_batch_number: do_batch_number,
                                do_sub_total: do_sub_total,
                                // do_hdr_id: do_hdr_kd
                            },
                            cache: false,
                            success: function(dataResult) {
                                // $('.close').click();
                                // document.getElementById("fm_nm_kategori_produk").value = "";
                                toastr.success('Saved!', 'Your fun', {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                                return window.location.href = "{{ url('delivery-order') }}";
                            }
                        });
                    } else {
                        alert('Please fill all the field !');
                    }
                });
            });

            // Custom Harga Beli Perxxx
            $(document).ready(function() {
                $('#fm_satuan_pembelian').on('change', function() {
                    var sat_beli = $(this).val();
                    // alert(sat_beli);
                    if (sat_beli) {
                        $('#hrgBeliPer').val(sat_beli);
                    }
                });

            });

            // Custom Isi Satuan Pembelian
            $(document).ready(function() {
                $('#fm_satuan_jual').on('change', function() {
                    var sat_jual = $(this).val();
                    // alert(sat_jual);
                    if (sat_jual) {
                        $('#isiSatuanBeli').val(sat_jual);
                    }
                });
            });

            // modal Edit DO
            function getDetailDO(tx) {
                $('#EditDO').modal('show');
                $('#AppendEditDO').empty();
                toastr.info('Opened!', 'Data Penerimaan Barang', {
                    timeOut: 2000,
                    preventDuplicates: true,
                    positionClass: 'toast-top-right',
                });
                // $(".SelectItemObat").on("click", function() {
                var kd_do = $(tx).data('kd_do');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('get-data-do') }}/" + kd_do,
                    type: "GET",
                    data: {
                        do_hdr_kd: kd_do
                    },
                    success: function(isListDO) {
                        $.each(isListDO, function(key, datavalue) {
                            const toDetail = datavalue.hdr_to_detail;
                            var totalFaktur = Number(datavalue.do_hdr_total_faktur);

                            var totalFakturCurrency = totalFaktur.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR'
                            });
                            let itemObat = "";
                            for (i in toDetail) {
                                itemObat += `
                                        <tr>
                                            <input type="hidden" class="searchObat" id="do_obat"
                                                    name="do_obat[]" value="${toDetail[i].do_obat}" readonly>

                                                <td>
                                                    <input class="form-control" style='width: 100%;' id="nm_obat"
                                                    name="nm_obat[]" value="${toDetail[i].nm_obat}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="do_satuan_pembelian form-control" id="do_satuan_pembelian[]"
                                                        name="do_satuan_pembelian[]" value="${toDetail[i].do_satuan_pembelian}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="do_qty form-control" id="do_qty" onKeyUp="getQTY(this)" name="do_qty[]" value="${toDetail[i].do_qty}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="do_isi_pembelian form-control" id="do_isi_pembelian"
                                                        name="do_isi_pembelian[]" value="${toDetail[i].do_isi_pembelian}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="do_satuan_jual form-control" id="do_satuan_jual" name="do_satuan_jual[]"
                                                        value="${toDetail[i].do_satuan_jual}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="do_hrg_beli form-control" id="do_hrg_beli" name="do_hrg_beli[]"
                                                    value="${toDetail[i].do_hrg_beli}" readonly>
                                                </td>
                                                <td>
                                                <input type="text" class="form-control" name="do_diskon_prosen" id="do_diskon_prosen" onKeyDown="discProsen(this)" value="${toDetail[i].do_diskon_prosen}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="do_diskon" name="do_diskon[]" onKeyDown="discRp(this)" value="${toDetail[i].do_diskon}" readonly>
                                                </td>
                                                <td>
                                                    <select type="text" class="form-control" id="do_pajak" name="do_pajak[]" onChange="pajakPPN(this)" readonly>
                                                        <option value="${toDetail[i].do_pajak}">${toDetail[i].do_pajak}</option>
                                                        <option value="">Tanpa Pajak</option>
                                                        <option value="11">PPN 11%</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" id="do_tgl_exp" name="do_tgl_exp[]" value="${toDetail[i].do_tgl_exp}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="do_batch_number"
                                                        name="do_batch_number[]" value="${toDetail[i].do_batch_number}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="do_sub_total form-control" id="do_sub_total" name="do_sub_total[]" value="${toDetail[i].do_sub_total}" readonly>
                                                </td>
                                        </tr>
                                        `;
                            }
                            $("#AppendEditDO").append(`
                                            <div class="row">
                                                <div class="form-group col-sm-2">
                                                    <label for="">Nomor Ref</label>
                                                    <input type="text" class="form-control" name="edo_hdr_kd" id="edo_hdr_kd"
                                                        value="${datavalue.do_hdr_kd}" readonly>
                                                </div>
                                                 <div class="form-group col-sm-2">
                                                    <label for="">Tanggal Transaksi</label>
                                                    <input type="date" class="form-control" name="tanggal_trs" id="tanggal_trs"
                                                        value="${datavalue.tanggal_trs}" readonly>
                                                </div>
                                                <div class="form-group col-sm-3">
                                                    <label for="">Nomor Faktur</label>
                                                    <input type="text" class="form-control" name="edo_hdr_no_faktur"
                                                        id="edo_hdr_no_faktur" value="${datavalue.do_hdr_no_faktur}" placeholder="Input Nomor Faktur" readonly>
                                                </div>
                                                <div class="form-group col-sm-2">
                                                    <label for="">Supplier</label>
                                                    <input class="edo_hdr_supplier form-control" id="edo_hdr_supplier"
                                                        style="width: 100%;" name="edo_hdr_supplier" value="${datavalue.do_hdr_supplier}" readonly>
                                                </div>
                                                <div class="form-group col-sm-2">
                                                    <label for="">Tanggal Jatuh Tempo</label>
                                                    <input type="date" class="form-control" name="edo_hdr_tgl_tempo"
                                                        id="edo_hdr_tgl_tempo" value="${datavalue.do_hdr_tgl_tempo}" readonly>
                                                </div>
                                                <input type="hidden" id="euser" name="euser" value="tes">
                                            </div>
                                        

                                        {{-- <hr> --}}

                                        <table class="table" style="width: 100%">
                                            <thead>
                                                <tr>
                                                   <th width="250px">Obat</th>
                                                    <th>Sat.Beli</th>
                                                    <th>Qty</th>
                                                    <th>Isi</th>
                                                    <th width="50px">Sat.Jual</th>
                                                    <th>Hrg.Beli</th>
                                                    <th>Disc %</th>
                                                    <th>Discount</th>
                                                    <th>Pajak</th>
                                                    <th width="60px">Tgl.Exp</th>
                                                    <th>Batch Number</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>

                                            <tbody id="doTableEdit">
                                            ${itemObat}
                                            </tbody>
                                            </table>
                                            <hr>
                                            <div class="float-right col-4">
                                                <div class="float-right col-4">
                                                    <input type="text" class="form-control float-right" name="do_hdr_total_faktur"
                                                        id="do_hdr_total_faktur" value="${totalFakturCurrency}" readonly>
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            {{-- <hr> --}}
                                            <div class="modal-footer">
                                               {{-- <button type="button" id="" class="btn btn-danger float-right"><i
                                                        class="fa fa-save"></i>&nbsp;
                                                </button> --}}
                                            </div>
                                     `);
                        })
                        // return window.location.href = "{{ url('mstr-obat') }}";
                    }

                });
            };

            $(document).ready(function() {
                $('#EditDOClose').on('click', function() {
                    $('#EditDO').modal('hide');
                });
            });


            $(document).ready(function() {
                var selectedItem = null;

                $('#itemList li').on('click', function() {
                    selectItem($(this));
                });

                $(document).keydown(function(e) {
                    if (e.key === 'ArrowUp' || e.key === 'ArrowDown') {
                        e.preventDefault();
                        navigateItems(e.key);
                    } else if (e.key === 'Enter') {
                        e.preventDefault();
                        if (selectedItem !== null) {
                            selectItem(selectedItem);
                        }
                    }
                });

                function navigateItems(key) {
                    var items = $('#itemList li');
                    var currentIndex = items.index(selectedItem);

                    if (currentIndex === -1) {
                        currentIndex = 0;
                    } else {
                        selectedItem.removeClass('selected');
                    }

                    if (key === 'ArrowUp' && currentIndex > 0) {
                        currentIndex--;
                    } else if (key === 'ArrowDown' && currentIndex < items.length - 1) {
                        currentIndex++;
                    }

                    selectedItem = items.eq(currentIndex);
                    selectedItem.addClass('selected');
                }

                function selectItem(item) {
                    // Implement the logic for handling the selected item
                    var itemId = item.data('id');
                    console.log('Selected Item ID:', itemId);
                }
            });

            $(document).keydown(function(event) {
                if (event.keyCode == 120) {
                    return getBarang();
                }
            });

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
