@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal" data-target="#TambahPO">Tambah
                    DO</button>
                <h3 class="card-title"><i class="fa fa-truck">&nbsp;</i>DELIVERY ORDER</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Tanggal</th>
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
                            {{-- @foreach ($obatView as $tz)
                                <tr>
                                    <td id="">{{ $tz->fm_kd_obat }}</td>
                                    <td id="">{{ $tz->fm_nm_obat }}</td>
                                    <td id="">{{ $tz->fm_kategori }}</td>
                                    <td id="">{{ $tz->fm_supplier }}</td>
                                    <td id="">{{ $tz->fm_satuan_pembelian }}</td>
                                    <td id="">{{ $tz->fm_satuan_jual }}</td>
                                    <td id="">@currency($tz->fm_hrg_beli)</td>
                                    <td id="">@currency($tz->fm_hrg_jual_non_resep)</td>
                                    <td id="">@currency($tz->fm_hrg_jual_resep)</td>
                                    <td id="">@currency($tz->fm_hrg_jual_nakes)</td>
                                    <td><button class="btn btn-xs btn-success" data-toggle="modal"
                                            data-target="#EditObat{{ $tz->fm_kd_obat }}">Edit</button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal"
                                            data-target="#DeleteSupplier{{ $tz->fm_kd_supplier }}">Hapus</button>
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
            padding: 0 !important; // override inline padding-right added from js
        }

        .modal .modal-dialog {
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
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-truck">&nbsp;</i>Delivery Order</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-2">
                            <label for="">Nomor Ref</label>
                            <input type="text" class="form-control" name="do_hdr_kd" id="do_hdr_kd" value="">
                        </div>
                        {{-- <div class="form-group col-sm-3">
                            <label for="">Tanggal DO</label>
                            <input type="date" class="form-control" name="fp_tgl_po" id="fp_tgl_po" value=""
                                placeholder="Input Nama Supplier">
                        </div> --}}
                        <div class="form-group col-sm-3">
                            <label for="">Nomor Faktur</label>
                            <input type="text" class="form-control" name="do_hdr_no_faktur" id="do_hdr_no_faktur"
                                value="" placeholder="Input Nomor Faktur">
                        </div>
                        <div class="form-group col-sm-2">
                            <label for="">Supplier</label>
                            <select class="form-control-pasien" id="do_hdr_supplier" style="width: 100%;"
                                name="do_hdr_supplier">
                                <option value="">--Select--</option>
                                @foreach ($supplier as $sp)
                                    <option value="{{ $sp->fm_nm_supplier }}">{{ $sp->fm_nm_supplier }}</option>
                                @endforeach
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
                                @foreach ($lokasi as $lok)
                                    <option value="{{ $lok->fm_nm_lokasi_stock }}">{{ $lok->fm_nm_lokasi_stock }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="user" name="user" value="tes">
                    </div>
                </div>

                {{-- <hr> --}}

                <table class="table">
                    <thead>
                        <tr>
                            {{-- <th>Kode Obat</th> --}}
                            <th>Obat</th>
                            <th>Sat.Beli</th>
                            <th>Tipe Diskon</th>
                            <th>Diskon</th>
                            <th>Qty</th>
                            <th>Isi</th>
                            <th>Sat.Jual</th>
                            <th>Hrg.Beli</th>
                            <th>Pajak</th>
                            <th>Tgl.Exp</th>
                            <th>Batch Number</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="addTbRow">
                        <tr id="addNewRow">
                            {{-- <td>
                                    <input type="text" class="form-control">
                                </td> --}}
                            <td>
                                <select class="do_obat form-control" style='width: 100%;' id="do_obat" name="do_obat"
                                    onchange="getDataObat()"></select>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_satuan_pembelian" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_diskon" name="do_diskon">
                            </td>
                            <td>
                                <input type="text" class="do_qty form-control" id="do_qty" name="do_qty">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_isi_pembelian" name="do_isi_pembelian"
                                    readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_satuan_jual" name="do_satuan_jual"
                                    readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_hrg_beli" name="do_hrg_beli" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_pajak" name="do_pajak">
                            </td>
                            <td>
                                <input type="date" class="form-control" id="do_tgl_exp" name="do_tgl_exp">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_batch_number" name="do_batch_number">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="do_sub_total" name="do_sub_total"
                                    readonly>
                            </td>
                            <input type="hidden" name="user" id="user" value="tes user">
                            <td>
                                <button class="remove btn btn-xs btn-danger " id="delRow"><i
                                        class="fa fa-close"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="float-right col-4">
                    <div class="float-right col-4">
                        <input type="text" class="form-control float-right" name="do_hdr_total_faktur"
                            id="do_hdr_total_faktur" value="556667" readonly>
                    </div>
                    <div class="float-right">
                        <button class="btn btn-xs btn-info" id="addRow">Tambah Barang</button>
                    </div>
                </div>
                <br>
                {{-- <hr> --}}
                <div class="modal-footer">
                    <button type="button" id="buat" class="btn btn-success float-right"><i
                            class="fa fa-save"></i>&nbsp;Save
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- The modal Edit -->
    {{-- @foreach ($obatView as $tz)
          
        {{-- End Modal --}}

    <!-- The modal Delete -->
    {{-- <div class="modal fade" id="DeleteSupplier{{ $tz->fm_kd_obat }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    Hapus data Supplier : <b> {{ $tz->fm_nm_obat }} </b> ?
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form class="d-inline" action="{{ url('destroy-mstr-supplier', [$tz->fm_kd_obat]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" value="DELETE" name="_method">
                                    <button type="submit" id="Delete" value="Delete"
                                        class="btn btn-danger float-right">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let baris = 1

            $(document).on('click', '#addRow', function() {
                // alert(baris);
                baris = baris + 1
                var html = "<tr class='addNewRow' id='addNewRow'" + baris + ">"
                html +=
                    "<td><select class='do_obat form-control' style='width: 100%;' id='do_obat' name='do_obat[]' onchange='getDataObat()'></select></td>"
                html += "<td><input type='text' class='form-control' id='do_satuan_pembelian'></td>"
                html += "<td><input type='text' class='form-control' id=''></td>"
                html += "<td><input type='text' class='form-control' id='do_diskon' name='do_diskon'></td>"
                html += "<td><input type='text' class='form-control' id='do_qty' name='do_qty'></td>"
                html +=
                    "<td><input type='text' class='form-control' id='do_isi_pembelian' name='do_isi_pembelian'></td>"
                html +=
                    "<td><input type='text' class='form-control' id='do_satuan_jual' name='do_satuan_jual'></td>"
                html +=
                    "<td><input type='text' class='form-control' id='do_hrg_beli' name='do_hrg_beli'></td>"
                html += "<td><input type='text' class='form-control' id='do_pajak' name='do_pajak'></td>"
                html +=
                    "<td><input type='date' class='form-control' id='do_tgl_exp' name='do_tgl_exp'></td>"
                html +=
                    "<td><input type='text' class='form-control' id='do_batch_number' name='do_batch_number'></td>"
                html +=
                    "<td><input type='text' class='form-control' id='do_total' name='do_total' readonly></td>"
                html +=
                    "<td><button class='remove btn btn-xs btn-danger' id='delRow'><i class='fa fa-close'></i></button></td>"
                html += "</tr>"

                $('#addTbRow').append(html)
            });
            // var newSelect = $("#addTbRow").find(".do_obat").last();
            // Select2(newSelect);
        });

        // $(document).on('click', '#delRow', function() {
        //     let hapus = $(this).data('row')
        //     $('#' + hapus).remove()
        // });


        $(document).on('click', '.remove', function() {
            // var delete_row = $(this).data("row");
            $('.addNewRow').remove();
        });


        // Select2 call
        $('#do_hdr_supplier').select2({
            placeholder: 'Supplier',
        });

        $('#do_hdr_lokasi_stock').select2({
            placeholder: 'Lokasi Stock',
        });

        // Ajax Search Obat
        var path = "{{ route('obatSearch') }}";

        $('.do_obat').select2({
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
                        $('#do_satuan_pembelian').val(datavalue.fm_satuan_pembelian);
                        $('#do_hrg_beli').val(datavalue.fm_hrg_beli);
                        $('#do_satuan_jual').val(datavalue.fm_satuan_jual);
                        $('#do_isi_pembelian').val(datavalue.fm_isi_satuan_pembelian);
                        // $('#fr_tgl_lahir').val(datavalue.fs_tgl_lahir);
                        // $('#fr_jenis_kelamin').val(datavalue.fs_jenis_kelamin);
                    })
                }
            })
        };

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
            $('#buat').on('click', function() {
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
                var do_hdr_kd = $('#do_hdr_kd').val();

                // ubah currency ke string biasa
                // var sfm_hrg_beli = parseInt(fm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
                // var sfm_hrg_jual_non_resep = parseInt(fm_hrg_jual_non_resep.replace(/,.*|[^0-9]/g, ''), 10);
                // var sfm_hrg_jual_resep = parseInt(fm_hrg_jual_resep.replace(/,.*|[^0-9]/g, ''), 10);
                // var sfm_hrg_jual_nakes = parseInt(fm_hrg_jual_nakes.replace(/,.*|[^0-9]/g, ''), 10);

                if (do_hdr_no_faktur != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('add-delivery-order') }}",
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
                            do_hdr_kd: do_hdr_kd
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

        // Qty x hrg 
        $(document).ready(function() {
            $('.do_qty').on('keyup', function() {
                var qty = $(this).val();
                var hrg = $('#do_hrg_beli').val();
                // alert(qty);
                if (hrg == '') {
                    $('#do_sub_total').val('');
                } else {
                    var total = qty * hrg
                    $('#do_sub_total').val(total);
                }
            });
        });
    </script>
@endpush