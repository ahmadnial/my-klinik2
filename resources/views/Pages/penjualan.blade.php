@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahPO">Tambah</button>
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

        #TambahPO .fullmodal {
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
    <div class="modal fade" id="TambahPO" data-backdrop="static">
        <div class="modal-dialog modal-xl fullmodal">
            <div class="modal-content document">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Delivery Order</h4>
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
                            <div class="form-group col-sm-2">
                                <label for="">Tanggal Jatuh Tempo</label>
                                <input type="date" class="form-control" name="do_hdr_tgl_tempo" id="do_hdr_tgl_tempo"
                                    value="">
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Lokasi</label>
                                <select class="form-control-pasien" id="do_hdr_lokasi_stock" style="width: 100%;"
                                    name="do_hdr_lokasi_stock">
                                    <option value="">--Select--</option>

                                </select>
                            </div>
                            <input type="hidden" id="user" name="user" value="tes">
                        </div>
                        <div class="">
                            <button type="button" id="searchObat" class="btn btn-info">tambah</button>
                        </div>
                    </div>

                    {{-- <hr> --}}

                    <table class="table" style="width: 100%">
                        <thead>
                            <tr>
                                {{-- <th>Kode Obat</th> --}}
                                <th>Obat</th>
                                <th>Sat.Beli</th>
                                <th>Qty</th>
                                <th>Isi</th>
                                <th>Sat.Jual</th>
                                <th>Hrg.Beli</th>
                                <th>Disc %</th>
                                <th>Discount</th>
                                <th>Pajak</th>
                                <th>Tgl.Exp</th>
                                <th>Batch Number</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>

                        <tbody id="doTable">
                            <tr>
                                {{-- <td>
                                    <select class="searchObat form-control" style='width: 100%;' id="do_obat"
                                        name="do_obat[]" onchange="getDataObat()" aria-placeholder="Search"></select>
                                </td> --}}
                                {{-- <td>
                                    <input class="searchObat form-control" style='width: 100%;' id="do_obat"
                                        name="do_obat[]" onchange="getDataObat()" placeholder="Search" readonly>
                                </td>
                                <td>
                                    <input type="text" class="do_satuan_pembelian form-control" id="do_satuan_pembelian"
                                        name="do_satuan_pembelian[]" readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="do_diskon" name="do_diskon[]">
                                </td>
                                <td>
                                    <input type="number" class="do_qty form-control" id="do_qty[]" name="do_qty[]">
                                </td>
                                <td>
                                    <input type="text" class="do_isi_pembelian form-control" id="do_isi_pembelian"
                                        name="do_isi_pembelian[]" readonly>
                                </td>
                                <td>
                                    <input type="text" class="do_satuan_jual form-control" id="do_satuan_jual"
                                        name="do_satuan_jual[]" readonly>
                                </td>
                                <td>
                                    <input type="text" class="do_hrg_beli form-control" id="do_hrg_beli"
                                        name="do_hrg_beli[]" readonly>
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
                                    <input type="text" class="form-control" id="do_sub_total" name="do_sub_total[]">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="text-success" id="addRow" title="Remove"><i
                                            class="fa fa-plus"></i></a>
                                </td>

                                <input type="hidden" name="user" id="user" value="tes user"> --}}
                                {{-- <input type="hidden" name="do_hdr_kd[]" id="do_hdr_kd">  --}}
                                {{-- <td>
                                <button class="remove btn btn-xs btn-danger " id="delRow"><i
                                        class="fa fa-close"></i></button>
                            </td> --}}
                            </tr>
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

                        {{-- @foreach ($listObat as $lo)
                            <tbody>
                                <tr>
                                    <td><input class="getItemObat col-6" style="border: none" readonly
                                            value="{{ $lo->fm_kd_obat }}">
                                    </td>
                                    <td>{{ $lo->fm_nm_obat }}</td>
                                    <td>{{ $lo->fm_satuan_pembelian }}</td>
                                    <td><button type="button" class="SelectItemObat btn btn-info btn-xs"
                                            id="SelectItemObat" data-fm_kd_obat="{{ $lo->fm_kd_obat }}"
                                            data-fm_nm_obat="{{ $lo->fm_nm_obat }}"
                                            data-fm_satuan_pembelian="{{ $lo->fm_satuan_pembelian }}"
                                            data-fm_isi_satuan_pembelian="{{ $lo->fm_isi_satuan_pembelian }}"
                                            data-fm_satuan_jual="{{ $lo->fm_satuan_jual }}"
                                            data-fm_hrg_beli="{{ $lo->fm_hrg_beli }}">Select</button>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach --}}
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
            </script>
        @endpush
    @endsection
