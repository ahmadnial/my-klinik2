@extends('Pages.master')

@section('konten')
    <style>
        .splitRight {
            right: 0%;
            height: 100%;
            width: 43%;
            position: absolute;
            z-index: 0;
            top: 0;
            overflow-x: hidden;
            padding-top: 95px;
        }

        @media (min-width: 576px) {
            #Right {
                position: fixed;
                width: auto;
                max-width: 44%;
                top: 0;
                bottom: 0;
                right: 0;
                left: unset;
            }
        }
    </style>

    <section class="splitRight col-lg-6 content" id="Right">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="">Search Registrasi</label>
                        <select class="form-control-pasien" id="tr_kd_reg" style="width: 100%;" name="tr_kd_reg">
                            @foreach ($isRegActive as $reg)
                                <option value="">--Select--</option>
                                <option value="{{ $reg->fr_kd_reg }}">
                                    {{ $reg->fr_kd_reg . '-' . $reg->fr_nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Tanggal</label>
                        <input type="text" class="form-control" name="tr_tgl_trs" id="tr_tgl_trs"
                            value="{{ $dateNow }}" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Nomor RM</label>
                        <input type="text" class="form-control" name="tr_no_mr" id="tr_no_mr" value="" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Nama Pasien</label>
                        <input type="text" class="form-control" name="tr_nm_pasien" id="tr_nm_pasien" value=""
                            readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Layanan</label>
                        <input type="text" class="form-control" name="tr_layanan" id="tr_layanan" value=""
                            readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Dokter</label>
                        <input type="text" class="form-control" name="tr_dokter" id="tr_dokter" value="" readonly>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="">Umur</label>
                        <input type="text" class="form-control" name="tr_umur" id="tr_umur" value="" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="">Alamat</label>
                        <textarea type="text" class="form-control" name="tr_alamat" id="tr_alamat" value="" readonly></textarea>
                    </div>
                    {{-- <input type="text" id="chart_id_show" name="chart_id" value=""> --}}


                    <input type="hidden" id="tr_tgl_lahir" name="tr_tgl_lahir">
                    <input type="hidden" id="user" name="user" value="tes">
                </div>
                {{-- <div class="float-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#TambahSOAP"><i class="fa fa-plus"></i>
                        SOAP</button>
                </div> --}}
                {{-- <div class="card-body"> --}}
                <form action="{{ url('chartCreate') }}" method="post" id="CHCreate">
                    <div class="row">
                        <div class="col">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Form SOAP
                                    </h3>
                                </div>
                                {{-- Hidden value --}}
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" id="chart_id" name="chart_id" value="{{ $isLastChartID }}">
                                    <input type="hidden" id="chart_kd_reg" name="chart_kd_reg" value="">
                                    <input type="hidden" id="chart_tgl_trs" name="chart_tgl_trs"
                                        value="{{ $dateNow }}">
                                    <input type="hidden" id="chart_mr" name="chart_mr" value="">
                                    <input type="hidden" id="chart_nm_pasien" name="chart_nm_pasien" value="">
                                    <input type="hidden" id="chart_layanan" name="chart_layanan" value="">
                                    <input type="hidden" id="chart_dokter" name="chart_dokter" value="">
                                    <input type="hidden" id="user" name="user" value="">
                                    {{-- Hidden value --}}
                                    <div class="form-group">
                                        <label for="inputDescription">Subjective</label>
                                        <textarea id="chart_S" name="chart_S" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Objective</label>
                                        <textarea id="chart_O" name="chart_O" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Assesment</label>
                                        <select class="form-control mb-3" style="width: 100%;" name="chart_A_diagnosa"
                                            id="chart_A_diagnosa">
                                            @foreach ($icdx as $x)
                                                <option value="">--Select--</option>
                                                <option value="{{ $x->code . '-' . $x->name_en }}">
                                                    {{ $x->code . '-' . $x->name_en }}</option>
                                            @endforeach
                                        </select>
                                        <textarea id="chart_A" name="chart_A" class="form-control mt-3 mb-2" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Plan</label>
                                        <div class="float-right mb-1">
                                            <button type="button" id="addTindakann"
                                                class="btn btn-xs btn-warning floar-right text-white" data-toggle="modal"
                                                data-target="#addTindakans">Tindakan</button>
                                            <button type="button" class="btn btn-xs btn-info floar-right"
                                                data-toggle="modal" data-target="#addResep">Resep</button>
                                        </div>
                                        <textarea id="chart_P" name="chart_P" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="showOrHideTdk"></div>

                                    <input type="hidden" id="user" name="user_create" value="tes">
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="" data-dismiss="modal"></button> --}}
                                <button id="createSOAPP" class="btn btn-success float-rights"><i class="fa fa-save"></i>
                                    &nbsp;
                                    Save</button>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>


    {{-- ===============ADD TINDAKAN MODAL================= --}}
    <div class="modal fade" id="addTindakans">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tindakan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="">
                            <label for="">Tarif Dasar</label>
                            <select class="nm_tarif_dasar form-control" style="width:100%;" name="nm_tarif_dasar"
                                id="nm_tarif_dasar">
                                <option value="">--Select--</option>
                                <option value="20000">Tarif 1 - Rp.20.000</option>
                                <option value="30000">Tarif 2 - Rp.30.000</option>
                                <option value="40000">Tarif 3 - Rp.40.000</option>
                                <option value="50000">Tarif 4 - Rp.50.000</option>
                                <option value="60000">Tarif 5 - Rp.60.000</option>
                            </select>
                        </div>
                        {{-- <div class="float-right mb-1 mt-4">
                            <button type="button" class="nm_tarif_add btn btn-xs btn-primary float-right">add more
                            </button>
                        </div> --}}
                        <div class="mt-4">
                            <table class="table table-bordered">
                                <tbody id="nm_tarif_plus">
                                    <tr>
                                        <td>
                                            <label for="">Tarif/Tindakan Tambahan</label>
                                            <select class="nm_tarif form-control" style="width:100%;" name="nm_tarif[]"
                                                id="nm_tarif" multiple="multiple">
                                                <option value="" selected></option>
                                                {{-- <option>--Select--</option> --}}
                                                @foreach ($isTindakanTarif as $t)
                                                    <option value="{{ $t->id }}">{{ $t->nm_tindakan }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" id="kd_trs" name="kd_trs" value="{{ $kd_trs }}">
                    <input type="hidden" id="sub_total" name="sub_total" value="0">
                    <div class="float-right mt-2">
                        <a type="button" id="exitModal" class="btn btn-success">add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================END MODAL ADD TINDAKANs============================= --}}

    {{-- ===============ADD RESEP MODAL================= --}}
    <div class="modal fade" id="addResep">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-nial">
                    <h4 class="modal-title">Resep</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="">
                            <div class="callout callout-success bg-light">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="370px">Obat</th>
                                            <th width="90px">Qty</th>
                                            <th width="150px">Satuan</th>
                                            <th width="200px">Signa</th>
                                            <th width="230px">Cara Pakai</th>
                                        </tr>
                                    </thead>
                                    <tbody id="TESCHCreate">
                                        <tr>
                                            <td>
                                                <select type="text" class="obatResep form-control" id="obatResep"
                                                    style="width: 100%" onchange="pasteTo()"></select>
                                            </td>
                                            <input type="hidden" id="namaObatResep">
                                            <td>
                                                <input type="text" class="form-control" id="qty_obat">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="satuan_jual_obat"
                                                    readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="signa_resep">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="cara_pakai_resep">
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-sm ml-2" id="addItemObatResepp"><i
                                                        class="fa fa-plus"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="resepID callout callout-warning mt-5">

                        </div>
                        {{-- <div class="float-right mb-1 mt-4">
                            <button type="button" class="nm_tarif_add btn btn-xs btn-primary float-right">add more
                            </button>
                        </div> --}}
                    </div>
                    {{-- <input type="hidden" id="kd_trs" name="kd_trs" value="{{ $kd_trs }}"> --}}
                    {{-- <input type="hidden" id="sub_total" name="sub_total" value="0"> --}}
                    <div class="float-right mt-2">
                        <a type="button" id="exitModalResep" class="btn btn-success">add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    {{-- ========================END MODAL ADD RESEP============================= --}}


    <div class="splitLeft col-sm-12 col-lg-6 row">
        <div class="col" id="accordion">
            <div class="card card-primary">
                <a class="d-block w-100" data-toggle="" href="#">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            History Timeline
                        </h4>
                    </div>
                </a>
                <div id="" class="isTimeline collapse show bg-light" data-parent="#accordion">
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->
@endsection

@push('scripts')
    <script>
        // Ajax Search Registrasi
        $('#tr_kd_reg').select2({
            placeholder: 'Search Registrasi',
        });

        $('#chart_A_diagnosa').select2({
            placeholder: 'Search ICD X / Diagnosa',
        });
        $('.nm_tarif').select2({
            placeholder: 'Search Tindakan',
        });
        // $('.obatResep').select2({
        //     placeholder: 'Search Obat',
        // });

        $("#exitModal").click(function() {
            $("#addTindakans").modal("hide");
        });

        $("#exitModalResep").click(function() {
            $("#addResep").modal("hide");
        });

        // $("#addTindakans").on('hide.bs.modal', function() {

        // });

        // Hitung Umur
        function getUmurDetail(dateString) {
            var today = new Date();
            var DOB = new Date(dateString);
            var totalMonths = (today.getFullYear() - DOB.getFullYear()) * 12 + today.getMonth() - DOB.getMonth();
            totalMonths += today.getDay() < DOB.getDay() ? -1 : 0;
            var years = today.getFullYear() - DOB.getFullYear();
            if (DOB.getMonth() > today.getMonth())
                years = years - 1;
            else if (DOB.getMonth() === today.getMonth())
                if (DOB.getDate() > today.getDate())
                    years = years - 1;

            var days;
            var months;

            if (DOB.getDate() > today.getDate()) {
                months = (totalMonths % 12);
                if (months == 0)
                    months = 11;
                var x = today.getMonth();
                switch (x) {
                    case 1:
                    case 3:
                    case 5:
                    case 7:
                    case 8:
                    case 10:
                    case 12: {
                        var a = DOB.getDate() - today.getDate();
                        days = 31 - a;
                        break;
                    }
                    default: {
                        var a = DOB.getDate() - today.getDate();
                        days = 30 - a;
                        break;
                    }
                }

            } else {
                days = today.getDate() - DOB.getDate();
                if (DOB.getMonth() === today.getMonth())
                    months = (totalMonths % 12);
                else
                    months = (totalMonths % 12) + 1;
            }
            var age = years + ' Tahun ' + months + ' Bulan ' + days + ' Hari';
            return age;
        }


        // Call Hasil Search Registrasi
        $("#tr_kd_reg").on("change", function() {
            toastr.info('Pasein Pinned!', {
                timeOut: 600,
                // preventDuplicates: true,
                positionClass: 'toast-top-right',
            });
            var kdReg = $('#tr_kd_reg').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('SearchRegister') }}/" + kdReg,
                type: 'GET',
                data: {
                    'fr_kd_reg': kdReg
                },
                success: function(isRegSearch) {
                    $.each(isRegSearch, function(key, dataregvalue) {
                        $('#tr_no_mr').val(dataregvalue.fr_mr);
                        $('#tr_nm_pasien').val(dataregvalue.fr_nama);
                        $('#tr_jenis_kelamin').val(dataregvalue.fr_jenis_kelamin);
                        $('#tr_layanan').val(dataregvalue.fr_layanan);
                        $('#tr_dokter').val(dataregvalue.fr_dokter);
                        $('#tr_alamat').val(dataregvalue.fr_alamat);
                        $('#tr_tgl_lahir').val(dataregvalue.fr_tgl_lahir);

                        $('#chart_kd_reg').val(dataregvalue.fr_kd_reg);
                        $('#chart_mr').val(dataregvalue.fr_mr);
                        $('#chart_nm_pasien').val(dataregvalue.fr_nama);
                        $('#chart_layanan').val(dataregvalue.fr_layanan);
                        $('#chart_dokter').val(dataregvalue.fr_dokter);

                        var isDateBirthday = dataregvalue.fr_tgl_lahir;
                        var isAgeNow = getUmurDetail(isDateBirthday);
                        $('#tr_umur').val(isAgeNow);

                        // Get MR & save  di sessionStorage
                        var mr = {};
                        mr.Text = $("#tr_no_mr").val();

                        var kdReg = {};
                        kdReg.Text = $("#tr_kd_reg").val();

                        var ChartID = {};
                        ChartID.Text = $("#chart_id").val();
                        // mr.isProcessed = false;
                        sessionStorage.setItem("dataMR", JSON.stringify(mr));
                        sessionStorage.setItem("kdReg", JSON.stringify(kdReg));
                        sessionStorage.setItem("ChartID", JSON.stringify(ChartID));


                        getTimeline();
                        // getTimelineTindakan();
                        // $(".isTimeline").empty();

                    })
                }
            })
        });

        // setInterval(getChartID, 3000);

        // function getChartID() {
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: "{{ url('getLastID') }}",
        //         type: 'GET',
        //         success: function(chart_id) {
        //             $.each(chart_id, function(key, id) {
        //                 $('#chart_id').val(id);
        //             })
        //         }
        //     })
        // };
        // $(document).on("click", "#addTindakan", function() {
        //     // $('.nm_tarif_plus').append(tubuh);
        //     $(".showOrHideTdk").append(
        //         `<div class="">
    //             <label>Tindakan</label>
    //             <div class="float-right mb-1">
    //             <button type="button"
    //                 class="nm_tarif_add btn btn-xs btn-primary float-right">add more
    //             </button>
    //             </div>
    //             <select class="nm_tarif form-control" style="width:100%;"
    //                 name="nm_tarif[]" id="nm_tarif[]">
    //                 <option value="">--Select--</option>
    //                 @foreach ($isTindakanTarif as $t)
    //                     <option value="{{ $t->nm_tindakan }}">{{ $t->nm_tindakan }}
    //                     </option>
    //                 @endforeach
    //             </select>
    //             <input type="hidden" id="kd_trs" name="kd_trs"
    //                 value="{{ $kd_trs }}">
    //             <input type="hidden" id="sub_total" name="sub_total"
    //                 value="6000">
    //         </div>
    //         <div class="nm_tarif_plus"></div>`
        //     );
        // });


        $(".nm_tarif_add").on("click", function() {
            $("#nm_tarif_plus").append(
                '<tr>' +
                '<td>' +
                '<select class="nm_tarif form-control" style="width:100%;" name="nm_tarif[]">' +
                '<option value="">--Select--</option>' +
                '@foreach ($isTindakanTarif as $t)' +
                '<option value="{{ $t->nm_tindakan }}">{{ $t->nm_tindakan }}</option>' +
                ' @endforeach' +
                '</select>' +
                '<a href="javascript:void(0)" class="rmvItm text-danger"><i class="fa fa-trash"></i></a>' +
                '</td>' +
                '</tr>'
            );

        });


        // Obat Search
        var path = "{{ route('obatSearchCH') }}";

        $('.obatResep').select2({
            placeholder: 'Search Obat',
            ajax: {
                url: path,
                dataType: 'json',
                delay: 150,
                processResults: function(isdataObat) {
                    return {
                        results: $.map(isdataObat, function(item) {
                            return {
                                // text: item.fs_mr,
                                text: item.fm_kd_obat + ' - ' + item.fm_nm_obat + ' - ' + item
                                    .fs_tgl_lahir,
                                id: item.fm_kd_obat,
                                alamat: item.fm_nm_obat,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // Get Satuan Jual
        function pasteTo() {
            var kd_obat = $('#obatResep').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getObatListCH') }}/" + kd_obat,
                type: 'GET',
                data: {
                    'fm_kd_obat': kd_obat
                },
                success: function(isdataObatList) {
                    $.each(isdataObatList, function(key, datavalue) {
                        $('#satuan_jual_obat').val(datavalue.fm_satuan_jual);
                        $('#namaObatResep').val(datavalue.fm_nm_obat);
                    })
                }
            })
        }

        // Append Item yang di tambahkan
        $(document).on('click', '#addItemObatResepp', function() {
            // $(this).parent().remove();
            var obatResep = $('#obatResep').val();
            var namaobatResep = $('#namaObatResep').val();
            var qty_obat = $('#qty_obat').val();
            var satuan_jual_obat = $('#satuan_jual_obat').val();
            var signa_resep = $('#signa_resep').val();
            var cara_pakai_resep = $('#cara_pakai_resep').val();

            $(".resepID").append(
                `
                <table>
                    <thead>
                        <tr class="mt-2">
                            <th width="370px">Obat</th>
                            <th width="90px">Qty</th>
                            <th width="150px">Satuan</th>
                            <th width="200px">Signa</th>
                            <th width="230px">Cara Pakai</th>
                        </tr>
                    </thead>
                    <tbody class="mt-2">
                        <tr class="mt-2">
                            <td class="mt-2">
                                <input type="text" class="obatResep form-control" id="ch_kd_obat"
                                    name="ch_kd_obat[]" style="width: 100%" value="${obatResep}" readonly>
                            </td>
                            <input type="hidden" id="ch_nm_obat" name="ch_nm_obat[]" value="${namaobatResep}">
                            <td>
                                <input type="text" class="form-control" id="ch_qty_obat" name="ch_qty_obat[]" value="${qty_obat}">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="ch_satuan_obat" name="ch_satuan_obat[]" value="${satuan_jual_obat}">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="ch_signa" name="ch_signa[]" value="${signa_resep}">
                            </td>
                            <td>
                                <input type="text" class="form-control" id="ch_cara_pakai" name="ch_cara_pakai[]" value="${cara_pakai_resep}">
                            </td>
                            <td>
                                <button class="btn btn-danger btn-sm ml-2" id="delItemObatResep"><i
                                        class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
               `
            );

            $("#CHCreate").append(
                `
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <input type="hidden" class="obatResep form-control" id="ch_kd_obat"
                                    name="ch_kd_obat[]" style="width: 100%" value="${obatResep}" readonly>
                            </td>
                            <input type="hidden" id="ch_nm_obat" name="ch_nm_obat[]" value="${namaobatResep}">
                            <td>
                                <input type="hidden" class="form-control" id="ch_qty_obat" name="ch_qty_obat[]" value="${qty_obat}">
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_satuan_obat" name="ch_satuan_obat[]" value="${satuan_jual_obat}">
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_signa" name="ch_signa[]" value="${signa_resep}">
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_cara_pakai" name="ch_cara_pakai[]" value="${cara_pakai_resep}">
                            </td>
                        </tr>
                    </tbody>
                </table>
               `
            );
        });


        $(document).on('click', '.rmvItm', function() {
            $(this).parent().remove();
        });

        // Create 
        $(document).ready(function() {
            $('#createSOAP').on('click', function() {
                var chart_id = $('#chart_id').val();
                var chart_tgl_trs = $('#tr_tgl_trs').val();
                var chart_kd_reg = $('#chart_kd_reg').val();
                var chart_mr = $('#chart_mr').val();
                var chart_nm_pasien = $('#chart_nm_pasien').val();
                var chart_layanan = $('#chart_layanan').val();
                var chart_dokter = $('#chart_dokter').val();
                var user = $('#user').val();
                var chart_S = $('#chart_S').val();
                var chart_O = $('#chart_O').val();
                var chart_A = $('#chart_A').val();
                var chart_A_diagnosa = $('#chart_A_diagnosa').val();
                var chart_P = $('#chart_P').val();

                // var kd_trs = $('#kd_trs').val();
                var nm_tarif = [];
                var sub_total = $('#sub_total').val();

                $('#nm_tarif').val(function() {
                    nm_tarif.push($(this).text());
                });

                // console.log(nm_tarif);
                if (chart_kd_reg != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('chartCreate') }}",
                        type: "POST",
                        data: {
                            chart_id: chart_id,
                            chart_tgl_trs: chart_tgl_trs,
                            chart_kd_reg: chart_kd_reg,
                            chart_mr: chart_mr,
                            chart_nm_pasien: chart_nm_pasien,
                            chart_layanan: chart_layanan,
                            chart_dokter: chart_dokter,
                            user: user,
                            chart_S: chart_S,
                            chart_O: chart_O,
                            chart_A: chart_A,
                            chart_A_diagnosa: chart_A_diagnosa,
                            chart_P: chart_P,
                            nm_tarif: nm_tarif,
                            kd_trs: kd_trs,
                            tgl_trs: chart_tgl_trs,
                            layanan: chart_layanan,
                            kd_reg: chart_kd_reg,
                            mr_pasien: chart_mr,
                            nm_pasien: chart_nm_pasien,
                            nm_dokter_jm: chart_dokter,
                            sub_total: sub_total,
                        },
                        cache: false,
                        success: function(dataResult) {
                            // $('.close').click();
                            toastr.success('Saved!', 'Berhasil Tersimpan', {
                                timeOut: 2000,
                                preventDuplicates: true,
                                positionClass: 'toast-top-right',
                            });
                            return window.location.href =
                                "{{ url('tindakan-medis') }}";
                            getTimeline();

                        }
                    });
                } else {
                    alert('Please fill all the field !');
                }
            });
        });

        function getTimeline() {

            $(".isTimeline").empty();

            var data = sessionStorage.getItem("dataMR");
            var dataObject;
            // const cekTindakan = getVal.nm_tarif;


            if (data != null) {
                dataObject = JSON.parse(data);
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getTimeline') }}/" + dataObject,
                type: 'GET',
                data: {
                    chart_mr: dataObject
                },
                success: function(isTimelineHistory) {
                    // $.each(isTimelineHistory, function(key, getVal) {
                    var getValue = isTimelineHistory;
                    for (var getVal = 0; getVal < getValue.length; getVal++) {
                        // $('#tr_tgl_trs').val(getVal.chart_tgl_trs);
                        $('#tr_kd_reg').val(getValue[getVal].chart_kd_reg);
                        $('#tr_no_mr').val(getValue[getVal].chart_mr);
                        $('#tr_nm_pasien').val(getValue[getVal].chart_nm_pasien);
                        $('#tr_layanan').val(getValue[getVal].chart_layanan);
                        $('#tr_dokter').val(getValue[getVal].chart_dokter);

                        const trstdk = getValue[getVal].trstdk;
                        let html = "";
                        for (i in trstdk) {
                            if (trstdk[i].nm_trf != null) {
                                html += `<tr><td>${trstdk[i].nm_trf.nm_tindakan}</td></tr>`;
                            } else {
                                html += ``;
                            }
                        }

                        const resep = getValue[getVal].resep;
                        let resepShow = "";
                        for (i in resep) {
                            if (resep[i] != null) {
                                resepShow +=
                                    `<tr><td>${resep[i].ch_nm_obat} - <i>${resep[i].ch_cara_pakai}</i></td></tr>`;
                            } else {
                                resepShow += ``;
                            }
                        }

                        // const trstdk = getValue[getVal].trstdk;
                        // let html = "";
                        // trstdk.forEach(xkx => {
                        //     html =+<td>${xkx.nm_tarif}</td>

                        //     // html = `<td>${xkx.nm_tarif}</td>`;
                        //     console.log(xkx);
                        // });
                        var x = 1;
                        var dateFormat = getValue[getVal].created_at;
                        // var dateConvert = moment().format(
                        //     dateFormat); // "2014-09-08T08:02:17-05:00" (ISO 8601)
                        var dateView = moment(dateFormat).format(
                            "dddd, D MMMM YYYY, h:mm:ss a");
                        $(".isTimeline").append(`
                    <div class="left card-body">
                        <div class="row">
                            <div class="col">
                            
                                <div class="col" id="accordion">
                                    <div class="card card-purple card-outline">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapse${x++}">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <input type="text" style="border:none" class="form-control bg-nial"
                                                    id="" value="${'&nbsp;&nbsp;&nbsp&nbsp;' + dateView}" readonly>
                                                </h4>
                                            </div>
                                        </a>
                                <div id="collapse${x++}" class="collapse show" data-parent="#accordion">
                                    <div class="ml-4 mt-2">
                                        <input type="hidden" id="showChartID" value="${getValue[getVal].chart_id}"></input>
                                        <button type="button" class="btn btn-outline-info btn-xs" id="btneditchart" value="${getValue[getVal].chart_id}" onClick="editChart()"><i class="fa fa-pen"></i></button>
                                        <button type="button" class="btn btn-outline-danger btn-xs"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <div class="card-body">
                                         <div class="">
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Kd.Registrasi :</td>
                                                    <td>${getValue[getVal].chart_kd_reg}</td>
                                                </tr>
                                                <tr>
                                                    <td>No.MR :</td>
                                                    <td>${getValue[getVal].chart_mr}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama :</td>
                                                    <td>${getValue[getVal].chart_nm_pasien}</td>
                                                </tr>
                                                <tr>
                                                    <td>Layanan :</td>
                                                    <td>${getValue[getVal].chart_layanan}</td>
                                                </tr>
                                                 <tr>
                                                    <td>Created By :</td>
                                                    <td>${getValue[getVal].chart_dokter}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                        <div class="form-group ">
                                            <label for="inputDescription" class="bg-danger">Subjective</label>
                                            <textarea id=""  class="show_chart_S form-control" style="border:none;" rows="4" readonly value="">${getValue[getVal].chart_S}</textarea>
                                        </div>
                                        <hr>
                                        <div class="show_chart_O form-group">
                                            <label for="inputDescription" class="bg-info">Objective</label>
                                            <textarea id="" class="show_chart_O form-control" style="border:none;" rows="4" readonly>${getValue[getVal].chart_O}</textarea>
                                        </div>
                                        <hr>
                                        <div class="show_chart_A form-group">
                                            <label for="inputDescription" class="bg-jeje">Assesment</label>
                                            <textarea id="" class="show_chart_A form-control mb-3" style="border:none;" rows="2" readonly>${getValue[getVal].chart_A_diagnosa}</textarea>
                                            <textarea id="" class="show_chart_A form-control" rows="4" style="border:none;" readonly>${getValue[getVal].chart_A}</textarea>
                                        </div>
                                        <hr>
                                        <div class="show_chart_P form-group">
                                            <label for="inputDescription" class="bg-nial">Plan</label>
                                            <textarea id="" class="show_chart_P form-control" rows="4" style="border:none;" readonly>${getValue[getVal].chart_P}</textarea>
                                        </div>
                                        <hr>
                                        <div class="tindakan">
                                               
                                            <table class="table table-hover">
                                                <thead class="bg-info">
                                                    <tr>
                                                        <th>Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TimelineTdk">
                                                        ${html}
                                                </tbody>
                                            </table>
                                        
                                        </div>

                                        <hr>
                                        <div class="resep">
                                               
                                            <table class="table table-hover">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th>Resep</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TimelineResep">
                                                        ${resepShow}
                                                </tbody>
                                            </table>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`)
                        // }

                    }
                    // } else {
                    // $('#show_chart_S').val('');
                    // $('#show_chart_O').val('');
                    // $('#show_chart_A').val('');
                    // $('#show_chart_P').val('');
                    // $('#labelTimeline').val('');
                    // };
                }
            })
        };


        // Edit Chart
        function editChart() {
            toastr.info('Edit Form Opened!', {
                timeOut: 600,
                // preventDuplicates: true,
                positionClass: 'toast-top-right',
            });
            var cahrtid = $('#showChartID').val();
            alert(cahrtid);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('chartIdSearch') }}/" + chartid,
                type: 'GET',
                data: {
                    'chart_id': chartid
                },
                success: function(isChartID) {
                    $.each(isChartID, function(key, dataregvalue) {

                    })
                }
            })
        }

        // Get Data setelah reload
        window.onload = getTimeline();

        // function getTimelineOnSubmit() {
        //     var data = sessionStorage.getItem("dataMR");
        //     var dataObject;

        //     if (data != null) {
        //         dataObject = JSON.parse(data);
        //     }
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: "{{ url('getTimeline') }}/" + dataObject,
        //         type: 'GET',
        //         data: {
        //             chart_mr: dataObject
        //         },
        //         success: function(isTimelineHistory) {
        //             // alert($isTimelineHistory);
        //             if (isTimelineHistory != '') {
        //                 $.each(isTimelineHistory, function(key, timeline) {
        //                     // header informasi
        //                     $('#tr_tgl_trs').val(timeline.chart_tgl_trs);
        //                     $('#tr_kd_reg').val(timeline.chart_kd_reg);
        //                     $('#tr_no_mr').val(timeline.chart_mr);
        //                     $('#tr_nm_pasien').val(timeline.chart_nm_pasien);
        //                     $('#tr_layanan').val(timeline.chart_layanan);
        //                     $('#tr_dokter').val(timeline.chart_dokter);
        //                     // $('#tr_alamat').val(timeline.chart_alamat);

        //                     $('#show_chart_S').val(timeline.chart_S);
        //                     $('#show_chart_O').val(timeline.chart_O);
        //                     $('#show_chart_A').val(timeline.chart_A);
        //                     $('#show_chart_P').val(timeline.chart_P);
        //                     // console.log(timeline.chart_S);
        //                     $('#labelTimeline').val(timeline.chart_kd_reg + '-' + timeline
        //                         .chart_nm_pasien + '-' + timeline
        //                         .chart_dokter + '-' + timeline.chart_layanan + '-' +
        //                         timeline
        //                         .chart_tgl_trs);
        //                 });
        //             } else {
        //                 $('#show_chart_S').val('');
        //                 $('#show_chart_O').val('');
        //                 $('#show_chart_A').val('');
        //                 $('#show_chart_P').val('');
        //                 $('#labelTimeline').val('');
        //             }
        //         }
        //     })
        // };
    </script>
@endpush
