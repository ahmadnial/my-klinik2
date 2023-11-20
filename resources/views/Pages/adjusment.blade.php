@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal" data-target="#TambahADJ">Tambah
                    Adj</button>
                <h3 class="card-title"><i class="fa fa-truck">&nbsp;</i>ADJUSMENT STOCK</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example1" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>No Ref</th>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Alasan</th>
                                <th>Dibuat Oleh</th>
                                <th></th>
                                {{-- <th>Nilai Faktur</th>
                                <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($viewDO as $tz) --}}
                            <tr>
                                {{-- <td id="">{{ $tz->created_at }}</td> --}}
                                <td id=""></td>
                                <td id=""></td>
                                <td id=""></td>
                                <td id=""></td>
                                <td id=""></td>
                                {{-- <td id=""></td>
                                <td id=""></td> --}}
                                {{-- <td id="">{{ $tz->hdrToDetail[0]->do_obat }}</td> --}}
                                <td><button class="btn btn-xs btn-success" data-toggle="modal"
                                        data-target="#EditXDo">Edit</button>
                                    {{-- <button class="btn btn-xs btn-danger" data-toggle="modal"
                                            data-target="#DeleteSupplier">Hapus</button> --}}
                                </td>
                            </tr>
                        </tbody>
                        {{-- @endforeach --}}
                    </table>
                </div>
            </div>
        </div>
    </section>
    <style>
        .modal {
            padding: 0 !important;
        }

        #TambahADJ .fullmodal {
            width: 85%;
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
    <div class="modal fade" id="TambahADJ" data-backdrop="static">
        <div class="modal-dialog modal-xl fullmodal">
            <div class="modal-content document">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Adjusment Stock Barang</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('add-delivery-order') }}" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="">Nomor Ref</label>
                                <input type="text" class="form-control" name="do_hdr_kd" id="do_hdr_kd" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tanggal Jam</label>
                                <input type="date" class="form-control" name="do_hdr_no_faktur" id="do_hdr_no_faktur"
                                    value="">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Periode Adjusment</label>
                                <input type="date" class="do_hdr_supplier form-control" id="do_hdr_supplier"
                                    name="do_hdr_supplier">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="">Keterangan</label>
                                <textarea class="do_hdr_supplier form-control" id="do_hdr_supplier" name="do_hdr_supplier"></textarea>
                            </div>

                            <input type="hidden" id="user" name="user" value="tes">
                        </div>
                        <div class="">
                            <button type="button" id="searchObat" class="btn btn-info">tambah</button>
                        </div>
                    </div>

                    {{-- <hr> --}}

                    <table class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                {{-- <th>Kode Obat</th> --}}
                                <th>kd Obat</th>
                                <th>Nama Obat</th>
                                <th>satuan</th>
                                <th>Qty Stock / Tercatat</th>
                                <th>Sebenarnya</th>
                                <th>Koreksi</th>
                                <th>Nilai HPP</th>
                                <th>Sub Total HPP</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="doTable">

                        </tbody>
                    </table>
                    <hr>
                    <div class="float-right col-4">
                        <div class="float-right col-4">
                            <input type="text" class="form-control float-right" name="total_adj" id="total_adj"
                                value="" readonly>
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

    <!-- The modal Edit -->
    <div class="modal xeditmodal fade" id="EditDO">

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
                                <th>QTY Stock</th>
                                <th></th>
                            </tr>
                        </thead>

                        @foreach ($ListObat as $lo)
                            <tbody>
                                <tr>
                                    <td><input class="getItemObat col-6" style="border: none" readonly
                                            value="{{ $lo->fm_kd_obat }}">
                                    </td>
                                    <td>{{ $lo->fm_nm_obat }}</td>
                                    <td>{{ $lo->fm_satuan_pembelian }}</td>
                                    <td>{{ $lo->qty }}</td>
                                    <td><button type="button" class="SelectItemObat btn btn-info btn-xs"
                                            id="SelectItemObat" data-fm_kd_obat="{{ $lo->fm_kd_obat }}"
                                            data-fm_nm_obat="{{ $lo->fm_nm_obat }}"
                                            data-fm_satuan_pembelian="{{ $lo->fm_satuan_pembelian }}"
                                            data-fm_isi_satuan_pembelian="{{ $lo->fm_isi_satuan_pembelian }}"
                                            data-fm_satuan_jual="{{ $lo->fm_satuan_jual }}"
                                            data-fm_hrg_beli="{{ $lo->fm_hrg_beli_detail }}"
                                            data-qty="{{ $lo->qty }}">Select</button>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
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
                $("#searchObat").on("click", function() {
                    $('#obatSearch').modal('show');

                    // alert('helo');
                });

                $(".SelectItemObat").on("click", function() {
                    var getKdObat = $(this).data('fm_kd_obat');
                    var getNmObat = $(this).data('fm_nm_obat');
                    var getSatJual = $(this).data('fm_satuan_jual');
                    var getHrgBeli = $(this).data('fm_hrg_beli');
                    var getQTY = $(this).data('qty');

                    $("#doTable").append(`
                        <tr id="">
                            <td>
                            <input type="text" class="form-control searchObat" id="kd_obat"
                                name="kd_obat[]" value="${getKdObat}" readonly>
                            </td>
                            <td>
                            <input class="form-control" style='width: 100%;' id="nm_obat"
                                name="nm_obat[]" onchange="getDataObat()" value="${getNmObat}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="satuan_jual_terkecil[]"
                                    name="satuan_jual_terkecil[]" value="${getSatJual}" readonly>
                            </td>
                            <td>
                                <input type="text" class="qty form-control" id="qty" name="qty[]" value="${getQTY}" readonly>
                            </td>
                            <td>
                                <input type="text" class="qty_adj form-control" id="qty_adj"
                                    name="qty_adj[]" onKeyDown="getQTYAdj(this)">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="qty_hasil_koreksi" name="qty_hasil_koreksi[]" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="hrg_beli_hpp" name="hrg_beli_hpp[]"
                                 value="${getHrgBeli}" readonly>
                            </td>
                            <td>
                                <input type="text" class="sub_total_adj form-control" id="sub_total_adj" name="sub_total_adj[]">
                            </td>
                    <td><a href="javascript:void(0)" class="text-danger font-18 remove" title="Remove"><i class="fa fa-trash"></i></a></td>
                   
                </tr>`);

                    $('#obatSearch').modal('hide');
                });

                function getQTYAdj(qa) {
                    var parentQA = qa.parentElement.parentElement;
                    if (event.keyCode == 13) {
                        var QtyAdj = $(parentQA).find('#qty_adj').val();
                        var QtyStock = $(parentQA).find('#qty').val();
                        var hpp = $(parentQA).find('#hrg_beli_hpp').val();
                        var hasil = QtyAdj - QtyStock;
                        $(parentQA).find('#qty_hasil_koreksi').val(hasil);
                        var HasilKoreksi = $(parentQA).find('#qty_hasil_koreksi').val();
                        var hppSub = HasilKoreksi * hpp;
                        // alert(toFix);
                        $(parentQA).find('#sub_total_adj').val(hppSub);

                        // if (tdscr != 0) {
                        //     $(parentR).find('#do_sub_total').val(toDecimal);
                        //     $(parentR).find('#do_diskon_prosen').val(result);
                        // } else {
                        //     $(parentR).find('#do_sub_total').val(subttl);
                        //     // $(parentR).find('#do_diskon_prosen').val();
                        // }
                        GrandTotal();
                    }

                }

                function GrandTotal() {
                    var sum = 0;

                    $('.sub_total').each(function() {
                        sum += Number($(this).val());
                    });
                    var result = sum.toFixed(2);

                    $('#total_adj').val(result);
                }
            </script>
        @endpush
    @endsection
