@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal" data-target="#TambahPO">Tambah
                    DO</button>
                <h3 class="card-title"><i class="fa fa-money">&nbsp;</i>KASIR POLIKLINIK</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <style>
        /* .modal {
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                } */
    </style>
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
                <div class="modal-body">
                    <form method="POST" action="{{ url('add-delivery-order') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-2">
                                <label for="">Transaksi</label>
                                <select class="form-control-pasien" id="trs_kp_kd_reg" style="width: 100%;"
                                    name="trs_kp_kd_reg">
                                    <option value="">--Select--</option>
                                    @foreach ($isTrsTdk as $trstdk)
                                        <option value="{{ $trstdk->kd_reg }}">
                                            {{ $trstdk->kd_reg . '-' . $trstdk->nm_pasien }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-2">
                                <label for="">Tanggal Keluar</label>
                                <input type="date" class="form-control" name="trs_kp_tgl_keluar" id="trs_kp_tgl_keluar"
                                    value="">
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
                                <input type="text" class="form-control" name="nm_tarif_dasar" id="nm_tarif_dasar"
                                    value="" readonly>
                            </div>
                            <input type="hidden" id="user" name="user" value="tes">
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
                        {{-- <tr> --}}
                        {{-- <td>
                                <select class="form-control" style='width: 100%;' id="do_obat" name="do_obat[]"
                                    onchange="getDataObat()"></select>
                            </td> --}}
                        {{-- <td>
                                <input type="text" class="form-control" id="trs_kp_kd_trs_chart"
                                    name="trs_kp_kd_trs_chart" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="trs_kp_nm_tarif">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="trs_kp_nilai_tarif"
                                    name="trs_kp_nilai_tarif">
                            </td> --}}
                        {{-- <td>
                                <input type="text" class="form-control" id="trs_kp_diskon" name="trs_kp_diskon">
                            </td> --}}

                        {{-- </tr> --}}
                        <input type="hidden" name="user" id="user" value="tes user">
                    </tbody>
                </table>
                {{-- <hr> --}}
                <div class="col">
                    <div class="float-right col-3">
                        <label for="">Total.</label>
                        <input type="text" class="form-control" style="border: none" name=""
                            id="trs_kp_nilai_total" value="" readonly>
                    </div>
                </div>
                <br>
                {{-- <hr> --}}
                <div class="modal-footer">
                    <button type="submit" id="buat" class="btn btn-success float-right"><i
                            class="fa fa-save"></i>&nbsp;Save
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>

    @push('scripts')
        <script>
            $('#trs_kp_kd_reg').select2({
                placeholder: 'Search Register',
            });


            // Call Register
            $("#trs_kp_kd_reg").on("change", function() {

                $('#showAlltdk').empty();

                var kdReg = $('#trs_kp_kd_reg').val();
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

                            $('#trs_kp_kd_trs_chart').val(dataregvalue.kd_trs);
                            // $('#trs_kp_nm_tarif').val(dataregvalue.nm_tarif);

                            $("#showAlltdk").append(`
                            <tr>
                            <td>
                                <input type="text" class="form-control" id="trs_kp_kd_trs_chart"
                                    name="trs_kp_kd_trs_chart" readonly value="${dataregvalue.kd_trs}">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="trs_kp_nm_tarif" readonly value="${dataregvalue.nm_tindakan}">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="trs_kp_nilai_tarif"
                                    name="trs_kp_nilai_tarif" readonly value="${dataregvalue.nilai_tarif}">
                            </td>
                            </tr>
                        `)
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

                        let ttlalltrf = parseInt(trftdk) + parseInt(trfdsr);
                        console.log(ttlalltrf);
                        $('#trs_kp_nilai_total').val(ttlalltrf);

                    }
                })
            });
        </script>
    @endpush
@endsection
