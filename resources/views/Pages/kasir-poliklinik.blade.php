@extends('pages.master')
@section('mytitle', 'Reg Out')
@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal" data-target="#TambahPO">Reg
                    Out</button>
                <h3 class="card-title"><i class="fa fa-money">&nbsp;</i>KASIR POLIKLINIK</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <div class="mb-3">
                        <input type="month" name="monthRegOut" id="monthRegOut" onchange="getMonthRegOut()"
                            class="form-control form-control-sm col-2">
                    </div>
                    <table id="example1" class="table table-hover">
                        <thead class="">
                            <tr>
                                {{-- <th>Tanggal</th> --}}
                                <th>Kode Trs</th>
                                <th>Kode Registrasi</th>
                                <th>Tgl RegOut</th>
                                <th>No.RM</th>
                                <th>Nama</th>
                                <th>Layanan</th>
                                <th>Dokter</th>
                                <th>Created By</th>
                                <th>Nilai Tarif</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    {{-- <style>
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
    </style> --}}
    <!-- The modal Create -->
    <div class="modal fade" id="TambahPO" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-">&nbsp;</i>Register Keluar</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('regout') }}" onkeydown="return event.key != 'Enter';"
                    class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="">Kd RegOut</label>
                                <input type="text" class="form-control" name="kd_trs_reg_out" id="kd_trs_reg_out"
                                    value="{{ $noReff }}" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Transaksi</label>
                                <select class="form-control-pasien" id="trs_kp_kd_reg" style="width: 100%;"
                                    name="trs_kp_kd_reg" onchange="getTransaksi()">
                                    <option value="">--Select--</option>
                                    @foreach ($isTrsTdk as $trstdk)
                                        <option value="{{ $trstdk->fr_kd_reg }}">
                                            {{ $trstdk->fr_kd_reg . '-' . $trstdk->fr_nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tanggal Keluar</label>
                                <input type="text" class="form-control" name="trs_kp_tgl_keluar" id="trs_kp_tgl_keluar"
                                    value="{{ $dateNow }}" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="trs_kp_nm_pasien" id="trs_kp_nm_pasien"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">No.MR</label>
                                <input type="text" class="form-control" name="trs_kp_no_mr" id="trs_kp_no_mr"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Layanan</label>
                                <input type="text" class="form-control" name="trs_kp_layanan" id="trs_kp_layanan"
                                    value="" readonly>
                            </div>
                            {{-- <div class="form-group col-sm-2">
                                <label for="">Jaminan</label>
                                <input type="text" class="form-control" name="do_hdr_no_faktur" id="do_hdr_no_faktur"
                                value="" >
                            </div> --}}
                            <div class="form-group col-sm-2">
                                <label for="">Dokter</label>
                                <input type="text" class="form-control" name="trs_kp_dokter" id="trs_kp_dokter"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tarif Dasar</label>
                                <input type="text" class="form-control" onkeyup="inputTarifDasar()" name="nm_tarif_dasar"
                                    id="nm_tarif_dasar" value="" required>
                                <div class="invalid-feedback">
                                    Please..dont let me blank
                                </div>
                            </div>
                            <input type="hidden" id="user" name="user" value="tes">
                            <input type="hidden" id="session_poli" name="session_poli">
                        </div>
                    </div>

                    {{-- <hr> --}}

                    <table class="table table-stripped" id="tblTrs">
                        <thead>
                            <tr>
                                <th>No.Trs</th>
                                <th>Keterangan Biaya</th>
                                <th>Nilai</th>
                                {{-- <th>Diskon</th> --}}
                                {{-- <th>Qty</th>
                            <th>Isi</th>
                            <th>Sat.Jual</th>
                            <th>Hrg.Beli</th>
                            <th>Pajak</th>
                            <th>Tgl.Exp</th>
                            <th>Batch Number</th>
                            <th>Total</th> --}}
                            </tr>
                        </thead>
                        <tbody id="showAlltdk">

                            <input type="hidden" name="user" id="user" value="tes user">
                        </tbody>
                    </table>
                    {{-- <hr> --}}
                    <div class="col">
                        <div class="float-right col-3">
                            <label for="">Total.</label>
                            <input type="text" class="form-control" style="border: none" name="trs_kp_nilai_total"
                                id="trs_kp_nilai_total" value="" readonly>
                        </div>
                    </div>
                    <br>
                    <br>
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
    <!-- End The modal Create -->


    <!-- The modal Edit -->
    <div class="modal fade" id="EditTrsRegOut" data-backdrop="static">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-">&nbsp;</i>Register Keluar</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('EditRegout') }}" onkeydown="return event.key != 'Enter';"
                    class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="">Kd RegOut</label>
                                <input type="text" class="form-control" name="kd_trs_reg_outE" id="kd_trs_reg_outE"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Transaksi</label>
                                <input type="text" class="form-control" id="trs_kp_kd_regE" style="width: 100%;"
                                    name="trs_kp_kd_regE" readonly>

                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tanggal Keluar</label>
                                <input type="text" class="form-control" name="trs_kp_tgl_keluarE"
                                    id="trs_kp_tgl_keluarE" value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="trs_kp_nm_pasienE"
                                    id="trs_kp_nm_pasienE" value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">No.MR</label>
                                <input type="text" class="form-control" name="trs_kp_no_mrE" id="trs_kp_no_mrE"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Layanan</label>
                                <input type="text" class="form-control" name="trs_kp_layananE" id="trs_kp_layananE"
                                    value="" readonly>
                            </div>
                            {{-- <div class="form-group col-sm-2">
                                <label for="">Jaminan</label>
                                <input type="text" class="form-control" name="do_hdr_no_faktur" id="do_hdr_no_faktur"
                                value="" >
                            </div> --}}
                            <div class="form-group col-sm-2">
                                <label for="">Dokter</label>
                                <input type="text" class="form-control" name="trs_kp_dokterE" id="trs_kp_dokterE"
                                    value="" readonly>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tarif Dasar</label>
                                <input type="text" class="form-control" onkeyup="inputTarifDasarE()"
                                    name="nm_tarif_dasarE" id="nm_tarif_dasarE" value="" required>
                                <div class="invalid-feedback">
                                    Please..dont let me blank
                                </div>
                            </div>
                            {{-- <input type="hidden" id="user" name="user" value="SysAdm">
                            <input type="hidden" id="session_poliE" name="session_poliE"> --}}
                        </div>
                    </div>

                    {{-- <hr> --}}

                    <table class="table table-stripped" id="tblTrs">
                        <thead>
                            <tr>
                                <th>No.Trs</th>
                                <th>Keterangan Biaya</th>
                                <th>Nilai</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="showAlltdkE">

                            <input type="hidden" name="user" id="user" value="tes user">
                        </tbody>
                    </table>
                    {{-- <hr> --}}
                    <div class="col">
                        <div class="float-right col-3">
                            <label for="">Total.</label>
                            <input type="text" class="form-control" style="border: none" name="trs_kp_nilai_totalE"
                                id="trs_kp_nilai_totalE" value="" readonly>
                        </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    {{-- <hr> --}}
                    <div class="modal-footer">
                        <button type="disable" id="buat" class="btn btn-success float-right"><i
                                class="fa fa-save"></i>&nbsp;Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            getMonthRegOut()

            $('#trs_kp_kd_reg').select2({
                placeholder: 'Search Register',
            });

            function getMonthRegOut() {
                const dataBulan = $('#monthRegOut').val();
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
                                url: "{{ url('getMonthRegOut') }}",
                                type: 'GET',
                                data: {
                                    dataBulan: dataBulan
                                }
                            },
                            columns: [{
                                    data: 'kd_trs_reg_out',
                                    name: 'kd_trs_reg_out'
                                },
                                {
                                    data: 'kp_kd_reg',
                                    name: 'kp_kd_reg'
                                },
                                {
                                    data: 'kp_tgl_keluar',
                                    name: 'kp_tgl_keluar',
                                    render: function(data, type, row) {
                                        return moment(data).format('D MMMM YYYY');
                                    }
                                },
                                {
                                    data: 'kp_no_mr',
                                    name: 'kp_no_mr'
                                    // render: function(data, type, row) {
                                    //     if (data == 'Poliklinik Umum' || data ==
                                    //         'Poliklinik Bedah') {
                                    //         return '<span class="badge badge-success">Resep Klinik</span>';
                                    //     } else {
                                    //         return '<span class="badge badge-danger">Apotek</span>';
                                    //     }
                                    // }
                                },
                                {
                                    data: 'kp_nm_pasien',
                                    name: 'kp_nm_pasien'
                                },
                                {
                                    data: 'kp_layanan',
                                    name: 'kp_layanan'
                                },
                                {
                                    data: 'kp_dokter',
                                    name: 'kp_dokter'
                                },
                                {
                                    data: 'user',
                                    name: 'user',
                                },
                                {
                                    data: 'kp_nilai_total',
                                    name: 'kp_nilai_total',
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
            // Call Register
            // $("#trs_kp_kd_reg").on("change", function() {
            function getTransaksi() {
                $('#tr_no_mr').val('');
                $('#trs_kp_nm_pasien').val('');
                $('#trs_kp_no_mr').val('');
                $('#trs_kp_layanan').val('');
                $('#trs_kp_dokter').val('');
                $('#nm_tarif_dasar').val('');
                $('#session_poli').val('');
                $('#showAlltdk').empty();

                var kdReg = document.getElementById("trs_kp_kd_reg").value;
                // var kdReg = $('#trs_kp_kd_reg').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('SearchRegisterKsr') }}/" + kdReg,
                    type: 'GET',
                    data: {
                        'kd_reg': kdReg
                    },
                    success: function(isRegSearchResult) {
                        $.each(isRegSearchResult, function(key, dataregvalue) {
                            $('#tr_no_mr').val(dataregvalue.fr_mr);
                            $('#trs_kp_nm_pasien').val(dataregvalue.nm_pasien);
                            $('#trs_kp_no_mr').val(dataregvalue.mr_pasien);
                            $('#trs_kp_layanan').val(dataregvalue.layanan);
                            $('#trs_kp_dokter').val(dataregvalue.nm_dokter_jm);
                            $('#nm_tarif_dasar').val(dataregvalue.nm_tarif_dasar);
                            $('#session_poli').val(dataregvalue.fr_session_poli);

                            $('#trs_kp_kd_trs_chart').val(dataregvalue.kd_trs);
                            // $('#trs_kp_nm_tarif').val(dataregvalue.nm_tarif);

                            if (dataregvalue.nm_tindakan != null) {
                                $("#showAlltdk").append(`
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" id="trs_kp_kd_trs_chart"
                                                    name="trs_kp_kd_trs_chart[]" readonly value="${dataregvalue.kd_trs}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="trs_kp_nm_tarif" name="trs_kp_nm_tarif[]" readonly value="${dataregvalue.nm_tindakan}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="trs_kp_nilai_tarif"
                                                    name="trs_kp_nilai_tarif[]" readonly value="${dataregvalue.nilai_tarif}">
                                            </td>
                                        </tr>
                            `)
                            } else {
                                // $("#showAlltdk").empty();
                            }

                        })
                        let trf = isRegSearchResult;

                        // let ttltdk = parseInt('0');
                        // trfdasar.forEach(ax => {
                        //     ttltdk += ax.nilai_tarif;
                        // })
                        // console.log(ttltdk);
                        let trftdk = trf.reduce((f, {
                                nilai_tarif
                            }) =>
                            f + parseInt(nilai_tarif), 0);

                        let trfdsr = 0;
                        trf.forEach(ax => {
                            trfdsr = ax.nm_tarif_dasar;
                        })

                        if (trftdk) {
                            let ttlalltrf = parseInt(trftdk) + parseInt(trfdsr);
                            // console.log(ttlalltrf);
                            $('#trs_kp_nilai_total').val(ttlalltrf);
                        } else {
                            // console.log(ttlalltrf);
                            $('#trs_kp_nilai_total').val(trfdsr);
                        }
                    }
                })
            };

            function inputTarifDasar() {
                var kdReg = document.getElementById("trs_kp_kd_reg").value;
                var nilaiTrfDsr = $('#nm_tarif_dasar').val();

                // var kdReg = $('#trs_kp_kd_reg').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('SearchRegisterKsr') }}/" + kdReg,
                    type: 'GET',
                    data: {
                        'kd_reg': kdReg
                    },
                    success: function(isRegSearchResult) {
                        $.each(isRegSearchResult, function(key, dataregvalue) {
                            // console.log(trf);
                        });
                        let trf = isRegSearchResult;
                        // let trfdsr = 0;
                        let trftdk = trf.reduce((f, {
                                nilai_tarif
                            }) =>
                            f + parseInt(nilai_tarif), 0);
                        // console.log(nilaiTrfDsr);
                        var sumAllManual = parseInt(nilaiTrfDsr) + parseInt(trftdk);
                        // if (event.keyCode == 13) {
                        if (trftdk) {
                            $('#trs_kp_nilai_total').val(sumAllManual);
                        } else {
                            $('#trs_kp_nilai_total').val(nilaiTrfDsr);
                            // var nilaiTrfDsr = $('#nm_tarif_dasar').val();
                        }
                        // }
                    }
                });
            }

            function inputTarifDasarE() {
                var kdReg = document.getElementById("trs_kp_kd_regE").value;
                var nilaiTrfDsr = $('#nm_tarif_dasarE').val();

                // var kdReg = $('#trs_kp_kd_reg').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('SearchRegisterKsr') }}/" + kdReg,
                    type: 'GET',
                    data: {
                        'kd_reg': kdReg
                    },
                    success: function(isRegSearchResult) {
                        $.each(isRegSearchResult, function(key, dataregvalue) {
                            // console.log(trf);
                        });
                        let trf = isRegSearchResult;
                        // let trfdsr = 0;
                        let trftdk = trf.reduce((f, {
                                nilai_tarif
                            }) =>
                            f + parseInt(nilai_tarif), 0);
                        // console.log(nilaiTrfDsr);
                        var sumAllManual = parseInt(nilaiTrfDsr) + parseInt(trftdk);
                        // if (event.keyCode == 13) {
                        if (trftdk) {
                            $('#trs_kp_nilai_totalE').val(sumAllManual);
                        } else {
                            $('#trs_kp_nilai_totalE').val(nilaiTrfDsr);
                            // var nilaiTrfDsr = $('#nm_tarif_dasar').val();
                        }
                        // }
                    }
                });
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

            function EditTrs(te) {
                $('#EditTrsRegOut').modal('show');
                var kd_trs = $(te).data('kd_trsu');

                $('#showAlltdkE').empty();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getDetailRegOut') }}/" + kd_trs,
                    type: "GET",
                    data: {
                        kd_trs: kd_trs
                    },
                    success: function(isDataRegOut) {
                        $.each(isDataRegOut, function(key, datavalue) {
                            $('#kd_trs_reg_outE').val(datavalue.kd_trs_reg_out);
                            $('#trs_kp_kd_regE').val(datavalue.kp_kd_reg);
                            $('#trs_kp_tgl_keluarE').val(datavalue.kp_tgl_keluar);
                            $('#trs_kp_nm_pasienE').val(datavalue.kp_nm_pasien);
                            $('#trs_kp_no_mrE').val(datavalue.kp_no_mr);
                            $('#trs_kp_layananE').val(datavalue.kp_layanan);
                            $('#trs_kp_dokterE').val(datavalue.kp_dokter);
                            $('#nm_tarif_dasarE').val(datavalue.nm_tarif_dasar);
                            $('#trs_kp_nilai_totalE').val(datavalue.kp_nilai_total);

                            const detailTindakan = datavalue.regout_detail;
                            let tindakan = "";

                            for (i in detailTindakan) {
                                if (detailTindakan[i].trs_kp_kd_trs_chart != '') {
                                    tindakan +=
                                        `<tr>
                                        <td>
                                            <input type="text" class="form-control" id="trs_kp_kd_trs_chart"
                                                name="trs_kp_kd_trs_chart[]" readonly value="${detailTindakan[i].trs_kp_kd_trs_chart}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="trs_kp_nm_tarif"
                                                name="trs_kp_nm_tarif[]" readonly value="${detailTindakan[i].trs_kp_nm_tarif}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="trs_kp_nilai_tarif"
                                                name="trs_kp_nilai_tarif[]" readonly value="${detailTindakan[i].trs_kp_nilai_tarif}">
                                        </td>
                                        <td>
                                            <button type="button" class="remove btn btn-xs btn-danger"><i class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                                        </td>
                                    </tr>`;
                                } else {
                                    tindakan += `
                                    <tr>
                                        <td>
                                            <b class="text-danger text-center">Tidak Ada Transaksi Tindakan Lain..</b>
                                        </td>
                                    </tr>
                                    `;
                                }

                                // if (trstdk[i].nm_trf == null) {
                                //     $('#TimelineTdk').hide();
                                // }
                            }

                            // if (datavalue.trs_kp_kd_trs_chart != null) {
                            $("#showAlltdkE").append(`
                                     ${tindakan}
                                `);
                            // }
                        })
                    }

                });
            };

            function deleteRow(btn) {
                var row = btn.parentNode.parentNode.parentNode;
                row.parentNode.removeChild(row);
                // inputTarifDasarE();
            }
        </script>
    @endpush
@endsection
