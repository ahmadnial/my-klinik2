@extends('pages.master')
@section('mytitle', 'Adjusment')
@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#TambahADJ">Tambah
                    Adj</button>
                <h3 class="card-title"><i class="fa fa-truck">&nbsp;</i>ADJUSMENT STOCK</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <div class="mb-3">
                        <input type="month" name="MonthAdjusment" id="MonthAdjusment" onchange="getMonthAdjusment()"
                            class="form-control form-control-sm col-2">
                    </div>
                    <table id="penjualan" class="table table-hover">
                        <thead style="background-color:rgb(242, 231, 255)">
                            <tr>
                                <th>Tanggal</th>
                                <th>No Ref</th>
                                <th>Keterangan</th>
                                <th>Nilai Adjusment</th>
                                <th>Periode Adjusment</th>
                                <th>Act.</th>
                                {{-- <th></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($isListAdj as $ila) --}}
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                {{-- <td id="">{{ $ila->tgl_trs }}</td>
                                    <td id="">{{ $ila->kd_adj }}</td>
                                    <td id="">{{ $ila->keterangan }}</td>
                                    <td id="">@currency($ila->nilai_total_adjusment)</td>
                                    <td id="">{{ $ila->user }}</td>
                                    <td><button class="btn btn-xs btn-success" data-toggle="modal"
                                            data-target="#EditXDo">Detail</button>
                                    </td> --}}
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
            padding: 0 !important;
        }

        #TambahADJ .fullmodal {
            width: 90%;
            max-width: none;
            height: auto;
            margin: 40;
        }

        #ViewADJ .fullmodal {
            width: 90%;
            max-width: none;
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
                                <input type="text" class="form-control" name="kd_adj" id="kd_adj" value=""
                                    readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tanggal Jam</label>
                                <input type="date" class="form-control" name="tgl_trs" id="tgl_trs"
                                    value="{{ $dateNow }}">
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
                            <button type="button" id="searchObat" onclick="getBarang()" class="btn btn-info"><i
                                    class="fa fa-plus">&nbsp;Item</i></button>
                        </div>
                    </div>

                    {{-- <hr> --}}
                    <div class="scrollable-table">
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
                    </div>
                    <hr>
                    <div class="float-right col-4">
                    </div>
                    {{-- <hr> --}}
                    <div class="modal-footer">
                        <div class="float-right col-2">
                            <input type="text" class="form-control float-right" name="total_adj_show_only"
                                id="total_adj_show_only" value="" readonly>
                            <input type="hidden" class="form-control float-right" name="total_adj" id="total_adj"
                                value="" readonly>
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
    <div class="modal fade" id="ViewADJ" data-backdrop="static">
        <div class="modal-dialog modal-xl fullmodal">
            <div class="modal-content document">
                <div class="modal-header bg-success">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Adjusment Stock Barang</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="">Nomor Ref</label>
                            <input type="text" class="form-control" name="kd_adjV" id="kd_adjV" value=""
                                readonly>
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="">Tanggal Jam</label>
                            <input type="date" class="form-control" name="tgl_trsV" id="tgl_trsV" value="">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="">Periode Adjusment</label>
                            <input type="date" class="periode_adjusment form-control" id="periode_adjusmentV"
                                name="periode_adjusmentV">
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="">Keterangan</label>
                            <textarea class="keterangan form-control" id="keteranganV" name="keteranganV"></textarea>
                        </div>
                    </div>
                </div>

                {{-- <hr> --}}
                <div class="scrollable-table">
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

                        <tbody id="AdjTable">

                        </tbody>
                    </table>
                </div>
                <hr>
                <div class="float-right col-4">
                </div>
                {{-- <hr> --}}
                <div class="modal-footer">
                    <div class="float-left col">
                        <span id="createdby" class="text-danger"></span>
                    </div>
                    <div class="float-right col-2">
                        <input type="text" class="form-control float-right" name="total_adj_show_onlyV"
                            id="total_adj_show_onlyV" value="" readonly>
                        <input type="hidden" class="form-control float-right" name="total_adjV" id="total_adjV"
                            value="" readonly>
                    </div>

                    {{-- <button type="submit" id="buat" class="btn btn-success float-right"><i
                            class="fa fa-save"></i>&nbsp;Save
                    </button> --}}
                </div>
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
                        <tbody>

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
            getMonthAdjusment()

            function getMonthAdjusment() {
                const dataBulan = $('#MonthAdjusment').val();
                $.ajax({
                    success: function() {
                        $('#penjualan').DataTable({
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
                                url: "{{ url('getMonthAdjusment') }}",
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
                                    data: 'kd_adj',
                                    name: 'kd_adj'
                                },
                                {
                                    data: 'keterangan',
                                    name: 'keterangan',
                                },
                                {
                                    data: 'nilai_total_adjusment',
                                    name: 'nilai_total_adjusment',
                                    render: $.fn.dataTable.render.number(',', '.', 2, 'Rp ')
                                },
                                {
                                    data: 'periode_adjusment',
                                    name: 'periode_adjusment',
                                    render: function(data, type, row) {
                                        return moment(data).format('D MMMM YYYY');
                                    }
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


            function getBarang() {
                $('#obatSearch').modal('show');
                var table = $('#exm2').DataTable();
                var rows = table
                    .rows()
                    .remove()
                    .draw();

                $.ajax({
                    success: function(isObatReguler) {

                        $('#ShowListBarang').DataTable({
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
                                    data: 'fm_satuan_pembelian',
                                    name: 'fm_satuan_pembelian'
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
                        // var getValue = listObat;
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
                var getHrgBeli = $(si).data('fm_hrg_beli_detail');
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
                            <td>
                                <button type="button" class="remove btn btn-xs btn-danger"><i class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                            </td>  
                </tr>`);

                $('#obatSearch').modal('hide');
            };

            function deleteRow(btn) {
                var row = btn.parentNode.parentNode.parentNode;
                row.parentNode.removeChild(row);
                GrandTotal();
            }

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

                var ttlInt = parseFloat(result);

                var formattedNumber = ttlInt.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                });

                $('#total_adj_show_only').val(formattedNumber);
            }

            $(document).keydown(function(event) {
                if (event.keyCode == 120) {
                    return getBarang();
                }
            });

            function getDetailAdj(tx) {
                $('#ViewADJ').modal('show');

                var kd_adj = $(tx).data('kd_adj');
                $('#AdjTable').empty();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getDetailAdjusment') }}/" + kd_adj,
                    type: "GET",
                    data: {
                        kd_adj: kd_adj
                    },
                    success: function(isViewAdjusment) {
                        $.each(isViewAdjusment, function(key, datavalue) {
                            $('#kd_adjV').val(datavalue.kd_adj);
                            $('#tgl_trsV').val(datavalue.tgl_trs);
                            $('#periode_adjusmentV').val(datavalue.periode_adjusment);
                            $('#keteranganV').val(datavalue.keterangan);
                            $('#total_adj_show_onlyV').val(datavalue.nilai_total_adjusment);
                            $('#total_adjV').val(datavalue.nilai_total_adjusment);
                            $('#createdby').html('Created By : ' +
                                datavalue.user);
                            $("#AdjTable").append(`
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
                                                <input type="text" class="form-control" readonly style="border: none;" id="" name="[]" value=${datavalue.qty_awal}>
                                            </td>
                                            <td>
                                                <input type="text" class="qty form-control" id="qty" name="qty[]" onKeyUp="getQTY(this)" value="${datavalue.qty_sebenarnya}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="cara_pakai form-control" id="cara_pakai" name="cara_pakai[]" value="${datavalue.koreksi_adj}" readonly>
                                            </td>
                                          
                                            <td>
                                                <input type="text" class="form-control" id="tuslah"
                                                    name="tuslah[]" readonly value="${datavalue.nilai_hpp}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="embalase"
                                                    name="embalase[]" readonly value="${datavalue.sub_total_adjusment}">
                                            </td>
                                        </tr>
                                        `);
                        })
                    }

                });
            };
        </script>
    @endpush
@endsection
