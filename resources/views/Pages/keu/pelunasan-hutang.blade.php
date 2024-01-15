@extends('pages.master')

@section('mytitle', 'Penerimaan Barang')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#TambahDO">Tambah
                </button>
                <h3 class="card-title"><i class="fa fa-money">&nbsp;</i>TRANSAKSI PELUNASAN HUTANG</h3>
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
                            {{-- @foreach ($viewDO as $tz)
                                <tr>
                                    <td id="">{{ $tz->created_at->format('d M Y h:i A') }}</td>
                                    <td id="">{{ $tz->do_hdr_kd }}</td>
                                    <td id="">{{ $tz->do_hdr_no_faktur }}</td>
                                    <td id="">{{ $tz->do_hdr_supplier }}</td>
                                    <td id="">{{ $tz->do_hdr_tgl_tempo }}</td>
                                    <td><button class="btn btn-xs btn-success" data-toggle="modal" data-target="#EditXDo"
                                            onclick="getDetailDO(this)" data-kd_do="{{ $tz->do_hdr_kd }}"
                                            data-no_faktur="{{ $tz->do_hdr_no_faktur }}"
                                            data-supplier="{{ $tz->do_hdr_supplier }}"
                                            data-tgl_tempo="{{ $tz->do_hdr_tgl_tempo }}" data-kd_obat="{{ $tz->do_obat }}"
                                            data-nm_obat="{{ $tz->hdrToDetail[0]->do_obat }}">View</button>
                                     
                                    </td>
                                </tr>
                            @endforeach --}}
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
    <div class="modal fade" id="TambahDO" data-backdrop="static">
        <div class="modal-dialog modal-xl fullmodal">
            <div class="modal-content document">
                <div class="modal-header bg-info">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Pelunasan Hutang</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('add-pelunasan-hutang') }}" onkeydown="return event.key != 'Enter';">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-4">
                                <label for="">Nomor Ref</label>
                                <input type="text" class="form-control" name="do_hdr_kd" id="do_hdr_kd"
                                    value="{{ $noRefTL }}" readonly>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="">Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tanggal_trs" id="tanggal_trs"
                                    value="{{ $dateNow }}" required>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="">Nomor Kuitansi</label>
                                <input type="text" class="form-control" name="do_hdr_no_faktur" id="do_hdr_no_faktur"
                                    value="" placeholder="Input Nomor Faktur" required>
                            </div>
                            {{-- <div class="form-group col-sm-2">
                                <label for="">Supplier</label>
                                <select class="do_hdr_supplier form-control-pasien" id="do_hdr_supplier"
                                    style="width: 100%;" name="do_hdr_supplier" required>
                                    <option value="">--Select--</option>
                                    @foreach ($listHutangSupplier as $lhs)
                                        <option value="{{ $lhs->hs_supplier }}">{{ $lhs->hs_supplier }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <input type="hidden" id="hs_kd_hutang" name="hs_kd_hutang" value="">
                        </div>
                        <div class="">
                            <button type="button" id="" onclick="getHutang()" class="btn btn-info"><i
                                    class="fa fa-plus">&nbsp;Item</i></button>
                            <i class="text-danger text-sm float-right">
                                *Tekan F9 untuk membuka List Obat/Klik Tombol +Item
                            </i>
                        </div>
                    </div>

                    {{-- <hr> --}}
                    <div class="scrollable-table">
                        <table class="table table-bordered" id="deliverOrder">
                            <thead>
                                <tr>
                                    {{-- <th width="250px">Obat</th> --}}
                                    <th>Kode Trs Pembelian</th>
                                    <th>No.Faktur</th>
                                    <th>Tanggal</th>
                                    <th>Hutang Awal</th>
                                    <th>Pembayaran</th>
                                    <th>Potongan</th>
                                    <th>Hutang Akhir</th>
                                </tr>
                            </thead>

                            <tbody id="DetailHutang">
                                <tr>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div class="float-right col-4">
                        <div class="float-right col-4">
                            <input type="text" class="form-control float-right" name=""
                                id="do_hdr_total_faktur_show_only" value="" readonly>
                            <input type="hidden" class="form-control float-right" name="do_hdr_total_faktur"
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


    <div class="modal fade" id="getDataHutang">
        <div class="modal-dialog modal-lg">
            <div class="modal-content document">
                <div class="modal-header">
                    <h4 class="modal-title">Search Hutang</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body table-responsive">
                    {{-- <div class="row"> --}}
                    <table class="table table-hover table-stripped" id="exm2" style="width: 100%">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>No.Faktur</th>
                                <th>Tanggal</th>
                                <th>Hutang Awal</th>
                                <th>Pembayaran</th>
                                <th>Potongan</th>
                                <th>Hutang Akhir</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="ListHutang">

                        </tbody>
                    </table>
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
            function getHutang() {
                $('#getDataHutang').modal('show');

                $.ajax({
                    success: function(listHutangSuppliers) {
                        $('#exm2').DataTable({
                            processing: true,
                            serverSide: true,
                            responsive: false,
                            "bDestroy": true,
                            ajax: "{{ url('list-hutang') }}",
                            // ajax: {
                            //     headers: {
                            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            //     },
                            //     url: "{{ url('list-hutangj') }}",
                            //     type: 'GET',
                            //     // data: {
                            //     //     dataBulan: dataBulan
                            //     // }
                            // },
                            columns: [{
                                    data: 'hs_kd_hutang',
                                    name: 'hs_kd_hutang'
                                },
                                {
                                    data: 'hs_no_faktur',
                                    name: 'hs_no_faktur'
                                },
                                {
                                    data: 'hs_tanggal_hutang',
                                    name: 'hs_tanggal_hutang'
                                },
                                {
                                    data: 'hs_nilai_hutang',
                                    name: 'hs_nilai_hutang'
                                },
                                {
                                    data: 'hs_pembayaran',
                                    name: 'hs_pembayaran'
                                },
                                {
                                    data: 'hs_potongan',
                                    name: 'hs_potongan'
                                },
                                {
                                    data: 'hs_hutang_akhir',
                                    name: 'hs_hutang_akhir'
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

            function SelectItemHutang(x) {
                var getKdtrs = $(x).data('kdtrs');
                var getNoFaktur = $(x).data('no_faktur');
                var getTglHutang = $(x).data('tgl_hutang');
                var getHutangAwal = $(x).data('hutang_awal');

                $("#DetailHutang").append(`
                        <tr>
                            <td>
                                <input class="form-control" id="nm_obat"
                                name="nm_obat[]" onchange="getDataObat()" value="${getKdtrs}" readonly>
                            </td>
                            <td>
                                <input type="text" class="do_satuan_pembelian form-control" id="do_satuan_pembelian[]"
                                    name="do_satuan_pembelian[]" value="${getNoFaktur}" readonly>
                            </td>
                            <td>
                                <input type="text" class="do_isi_pembelian form-control" id="do_isi_pembelian"
                                    name="do_isi_pembelian[]" value="${getTglHutang}" readonly>
                            </td>
                            <td>
                                <input type="text" class="do_satuan_jual form-control" id="pl_hutang_awal" name="pl_hutang_awal[]"
                                    value="${getHutangAwal}" readonly>
                            </td>
                            <td>
                                <input type="text" class="pl_pembayaran form-control" id="pl_pembayaran" name="pl_pembayaran[]"
                                 onKeyup="getPembayaran(this)">
                            </td>
                            <td>
                            <input type="text" class="form-control" name="do_diskon_prosen[]" id="do_diskon_prosen" onKeyDown="discProsen(this)">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="pl_hutang_akhir" name="pl_hutang_akhir[]" readonly>
                            </td>
                            
                            <td>
                                 <button type="button" class="remove btn btn-xs btn-danger"><i class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                            </td>                   
                </tr>`);

                $('#getDataHutang').modal('hide');
            };

            function deleteRow(btn) {
                var row = btn.parentNode.parentNode.parentNode;
                row.parentNode.removeChild(row);
                GrandTotal();
            }

            // $(document).ready(function() {
            function getPembayaran(q) {
                var parent = q.parentElement.parentElement;
                var ha = $(parent).find('#pl_hutang_awal').val();
                var pem = $(parent).find('#pl_pembayaran').val();
                var x = ha - pem;
                var result = x.toFixed(2);
                $(parent).find('#pl_hutang_akhir').val(result);
                GrandTotal();
            };

            function discRp(r) {
                var parentR = r.parentElement.parentElement;
                if (event.keyCode == 13) {
                    var tdscr = $(parentR).find('#do_diskon').val();
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
                    GrandTotal();

                    // console.log(tdscr);
                }

            }

            function GrandTotal() {
                var sum = 0;

                $('.pl_pembayaran').each(function() {
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


            $(document).on('click', '.remove', function() {
                // var delete_row = $(this).data("row");
                $('.addNewRow').remove();
            });


            $(document).keydown(function(event) {
                if (event.keyCode == 120) {
                    return getHutang();
                }
            });
        </script>
    @endpush
@endsection
