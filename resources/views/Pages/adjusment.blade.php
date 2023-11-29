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
                {{-- <div id=""> --}}
                <table id="exm2" class="table table-hover">
                    <thead>
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
                        @foreach ($isListAdj as $ila)
                            <tr>
                                <td id="">{{ $ila->kd_adj }}</td>
                                <td id="">{{ $ila->tgl_trs }}</td>
                                <td id=""></td>
                                <td id="">{{ $ila->keterangan }}</td>
                                <td id="">{{ $ila->user }}</td>
                                {{-- <td id=""></td>
                                <td id=""></td> --}}
                                {{-- <td id="">{{ $tz->hdrToDetail[0]->do_obat }}</td> --}}
                                {{-- <td><button class="btn btn-xs btn-success" data-toggle="modal"
                                            data-target="#EditXDo">Edit</button>
                                    </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- </div> --}}
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
                <div class="modal-header bg-success">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Adjusment Stock Barang</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('CreateAdj') }}" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="">Nomor Ref</label>
                                <input type="text" class="form-control" name="kd_adj" id="kd_adj"
                                    value="{{ $noReff }}" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tanggal Jam</label>
                                <input type="date" class="form-control" name="tgl_trs" id="tgl_trs" value="">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Periode Adjusment</label>
                                <input type="date" class="periode_adjusment form-control" id="periode_adjusment"
                                    name="periode_adjusment">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="">Keterangan</label>
                                <textarea class="keterangan form-control" id="keterangan" name="keterangan"></textarea>
                            </div>

                            <input type="hidden" id="user" name="user" value="tes">
                        </div>
                        <div class="">
                            <button type="button" id="searchObat" onclick="getBarang()"
                                class="btn btn-info">tambah</button>
                        </div>
                    </div>

                    {{-- <hr> --}}

                    <table id="" class="table table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                {{-- <th>Kode Obat</th> --}}
                                <th width="150px">kd Obat</th>
                                <th width="250px">Nama Obat</th>
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
                    <table id="ShowListBarang" class="table table-hover table-stripped">
                        <thead>
                            <tr>
                                <th>KD OBAT</th>
                                <th>Nama Obat</th>
                                <th>Satuan beli</th>
                                <th>QTY Stock</th>
                                <th></th>
                            </tr>
                        </thead>

                        {{-- @foreach ($ListObat as $lo) --}}
                        <tbody>
                            {{-- <tr>
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
                        @endforeach --}}
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
                // $("#periode_adjusment").datepicker({
                //     format: "mm-yyyy",
                //     startView: "months",
                //     minViewMode: "months"
                // });

                $('#periode_adjusment').datepicker({
                    minViewMode: 2,
                    format: 'yyyy'
                });

                $("#searchObat").on("click", function() {
                    $('#obatSearch').modal('show');

                    // alert('helo');
                });

                function getBarang() {
                    var table = $('#exm2').DataTable();
                    var rows = table
                        .rows()
                        .remove()
                        .draw();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('getListObatReguler') }}",
                        type: 'GET',

                        success: function(listObat) {
                            var getValue = listObat;
                            for (var getVal = 0; getVal < getValue.length; getVal++) {

                                const table = $('#ShowListBarang').DataTable();
                                var btnBtn =
                                    `<button class="SelectItemObat btn btn-success btn-xs" id="SelectItemObat" onClick="SelectItemObat(this)" data-fm_kd_obat="${getValue[getVal].fm_kd_obat}" data-fm_nm_obat="${getValue[getVal].fm_nm_obat}" data-fm_satuan_pembelian="${getValue[getVal].fm_satuan_pembelian}" data-fm_isi_satuan_pembelian="${getValue[getVal].fm_isi_satuan_pembelian}" data-fm_satuan_jual="${getValue[getVal].fm_satuan_jual}" data-fm_hrg_beli="${getValue[getVal].fm_hrg_beli_detail}" data-qty="${getValue[getVal].qty}">Select</button>`
                                const dataBaru = [
                                    [getValue[getVal].fm_kd_obat, getValue[getVal].fm_nm_obat, getValue[getVal]
                                        .fm_satuan_jual, getValue[getVal].qty,
                                        btnBtn
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

                                        ]).draw(false)
                                    }
                                }
                                injectDataBaru()
                            }

                        }
                    })
                }

                function SelectItemObat(si) {
                    var table = $('#ShowListBarang').DataTable();
                    var rows = table
                        .rows()
                        .remove()
                        .draw();

                    var getKdObat = $(si).data('fm_kd_obat');
                    var getNmObat = $(si).data('fm_nm_obat');
                    var getSatJual = $(si).data('fm_satuan_jual');
                    var getHrgBeli = $(si).data('fm_hrg_beli');
                    var getQTY = $(si).data('qty');

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
                                <input type="text" class="form-control" id="satuan[]"
                                    name="satuan[]" value="${getSatJual}" readonly>
                            </td>
                            <td>
                                <input type="text" class="qty form-control" id="qty" name="qty[]" value="${getQTY}" readonly>
                            </td>
                            <td>
                                <input type="number" class="qty_adj form-control" id="qty_adj"
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
                };

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

                        GrandTotal();
                    }

                }

                function GrandTotal() {
                    var sum = 0;

                    $('.sub_total_adj').each(function() {
                        sum += Number($(this).val());
                    });
                    var result = sum.toFixed(2);

                    $('#total_adj').val(sum);
                }
            </script>
        @endpush
    @endsection
