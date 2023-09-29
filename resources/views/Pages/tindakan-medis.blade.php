@extends('Pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-3">
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
                    <div class="form-group col-sm-3">
                        <label for="">Tanggal</label>
                        <input type="date" class="form-control" name="tr_tgl_trs" id="tr_tgl_trs" value="">
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">Nomor RM</label>
                        <input type="text" class="form-control" name="tr_no_mr" id="tr_no_mr" value="" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">Nama Pasien</label>
                        <input type="text" class="form-control" name="tr_nm_pasien" id="tr_nm_pasien" value=""
                            readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">Layanan</label>
                        <input type="text" class="form-control" name="tr_layanan" id="tr_layanan" value=""
                            readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">Dokter</label>
                        <input type="text" class="form-control" name="tr_dokter" id="tr_dokter" value="" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">Umur</label>
                        <input type="text" class="form-control" name="tr_umur" id="tr_umur" value="" readonly>
                    </div>
                    <div class="form-group col-sm-3">
                        <label for="">Alamat</label>
                        <textarea type="text" class="form-control" name="tr_alamat" id="tr_alamat" value="" readonly></textarea>
                    </div>
                    {{-- <input type="text" id="chart_id" name="chart_id" value=""> --}}


                    <input type="hidden" id="tr_tgl_lahir" name="tr_tgl_lahir">
                    <input type="hidden" id="user" name="user" value="tes">
                </div>
                <div class="float-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#TambahSOAP"><i class="fa fa-plus"></i>
                        SOAP</button>
                </div>
            </div>
        </div>
    </section>

    {{-- ===============SOAP MODAL================= --}}
    <div class="modal fade" id="TambahSOAP">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Kartu Pemeriksaan Pasien</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Form SOAP
                                            </h3>

                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="disable"
                                                    title="Collapse">
                                                    {{-- <i class="fas fa-minus"></i> --}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            {{-- Hidden value --}}
                                            <input type="hidden" id="chart_id" name="chart_id"
                                                value="{{ $isLastChartID }}">
                                            <input type="hidden" id="chart_kd_reg" name="chart_kd_reg" value="">
                                            <input type="hidden" id="chart_mr" name="chart_mr" value="">
                                            <input type="hidden" id="chart_nm_pasien" name="chart_nm_pasien"
                                                value="">
                                            <input type="hidden" id="chart_layanan" name="chart_layanan"
                                                value="">
                                            <input type="hidden" id="chart_dokter" name="chart_dokter" value="">
                                            <input type="hidden" id="user" name="user" value="">
                                            {{-- Hidden value --}}
                                            <div class="form-group">
                                                <label for="inputDescription">Subjective</label>
                                                <textarea id="chart_S" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Objective</label>
                                                <textarea id="chart_O" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Assesment</label>
                                                <select class="form-control mb-3" style="width: 100%;"
                                                    name="chart_A_diagnosa" id="chart_A_diagnosa">
                                                    @foreach ($icdx as $x)
                                                        <option value="">--Select--</option>
                                                        <option value="{{ $x->code . '-' . $x->name_en }}">
                                                            {{ $x->code . '-' . $x->name_en }}</option>
                                                    @endforeach
                                                </select>
                                                <textarea id="chart_A" class="form-control mt-3 mb-2" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Plan</label>
                                                <div class="float-right mb-1">
                                                    <button type="button"
                                                        class="btn btn-xs btn-warning floar-right text-white"
                                                        data-toggle="modal" data-target="#addTindakan">Tindakan</button>
                                                    <button type="button"
                                                        class="btn btn-xs btn-info floar-right">Resep</button>
                                                </div>
                                                <textarea id="chart_P" class="form-control" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        {{-- <button type="button" class="" data-dismiss="modal"></button> --}}
                                        <button type="submit" id="createSOAP" class="btn btn-success float-rights"><i
                                                class="fa fa-save"></i>
                                            &nbsp;
                                            Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ========================END MODAL SOAP============================= --}}

    {{-- ===============ADD TINDAKAN MODAL================= --}}
    <div class="modal fade" id="addTindakan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h4 class="modal-title">Tindakan</h4> --}}
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
                </div>
                <div class="modal-body">
                    <div id="" class="collapse show" data-parent="#">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Tambah Tindakan
                                            </h3>

                                            <div class="card-tools">
                                                {{-- <button type="button" class="btn btn-tool" data-card-widget="disable"
                                                    title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button> --}}
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            {{-- Hidden value --}}
                                            <input type="hidden" id="chart_id" name="chart_id" value="">
                                            <div class="form-group">
                                                <label for="inputDescription">Tindakan</label>
                                                <select class="form-control mb-3" style="width: 100%;"
                                                    name="chart_tindakan" id="chart_tindakan">
                                                    @foreach ($isTindakanTarif as $t)
                                                        <option value="">--Select--</option>
                                                        <option value="{{ $t->nm_tindakan }}">{{ $t->nm_tindakan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-dismiss="modal">cancel</button>
                                        <button type="button" id="addTdk" class="btn btn-success float-rights">
                                            Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================END MODAL ADD TINDAKANs============================= --}}
    <div class="row">
        {{-- <table class="table">
            <thead>
                <tr>
                    <th>s</th>
                    <th>o</th>
                    <th>a</th>
                    <th>pp</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="show_chart_S"><input type="text" name="" id="show_chart_S"></td>
                    <td id="show_chart_O"></td>
                    <td id="show_chart_A"></td>
                    <td id="show_chart_P"></td>
                    <td id=""></td>
                </tr>
            </tbody>
        </table> --}}
        <div class="col" id="accordion">
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="" href="#collapseOne">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            SOAP
                        </h4>
                    </div>
                </a>
                <div id="" class="isTimeline collapse show" data-parent="#accordion">
                    {{-- @foreach ($isTindakanChart as $tc) --}}
                    {{-- <div class="card-body">
                       
                        <div class="row">
                            <div class="col-md">
                                <div class="card card-primary" id="hdrLoop">
                                    <div class="card-header">
                                        <h3 class="card-title col-6">
                                            <div class="col">
                                                <input type="text" style="border:none" class="form-control bg-primary"
                                                    id="labelTimeline" readonly>
                                            </div>
                                        </h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputDescription">Subjective</label>
                                            <textarea id="show_chart_S" class="form-control" rows="4" readonly></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Objective</label>
                                            <textarea id="show_chart_O" class="form-control" rows="4" readonly></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Assesment</label>
                                            <textarea id="show_chart_A" class="form-control" rows="4" readonly></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Plan</label>
                                            <textarea id="show_chart_P" class="form-control" rows="4" readonly></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- @endforeach --}}
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
        $('#chart_tindakan').select2({
            placeholder: 'Search Tindakan',
        });

        // Call Hasil Search Registrasi
        $("#tr_kd_reg").on("change", function() {
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

                        // Get MR & save  di sessionStorage
                        var mr = {};
                        mr.Text = $("#tr_no_mr").val();
                        // mr.isProcessed = false;
                        sessionStorage.setItem("dataMR", JSON.stringify(mr));


                        getTimeline();
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

                if (chart_kd_reg != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('chartCreate') }}",
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
                        },
                        cache: false,
                        success: function(dataResult) {
                            // $('.close').click();
                            toastr.success('Saved!', 'Berhasil Tersimpan', {
                                timeOut: 2000,
                                preventDuplicates: true,
                                positionClass: 'toast-top-right',
                            });
                            return window.location.href = "{{ url('tindakan-medis') }}";
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


                    // if (isTimelineHistory != '') {
                    // isTimelineHistory.forEach(function(item, index) {
                    //     console.log(index);
                    //     $('#show_chart_S').val(index.chart_S);

                    // });
                    // for (var i = 0; i < isTimelineHistory.length; i++) {
                    $.each(isTimelineHistory, function(key, getVal) {
                        // $('#hdrLoop')[i];
                        // $('.labelTimeline').val(getVal.chart_kd_reg + '-' +
                        //     getVal.chart_nm_pasien + '-' + getVal.chart_dokter + '-' + getVal
                        //     .chart_layanan + '-' +
                        //     getVal.chart_tgl_trs);
                        // $('.show_chart_S').val(getVal.chart_S);
                        // $('.show_chart_O').val(getVal.chart_O);
                        // $('.show_chart_A').val(getVal.chart_A);
                        // $('.show_chart_P').val(getVal.chart_P);
                        // console.log(timeline.chart_S);
                        // };
                        // $(".isTimeline").parent().remove();
                        var dateFormat = getVal.created_at;
                        // var dateConvert = moment().format(
                        //     dateFormat); // "2014-09-08T08:02:17-05:00" (ISO 8601)
                        var dateView = moment(dateFormat).format("dddd, D MMMM YYYY, h:mm:ss a");
                        $(".isTimeline").append(`
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <div class="card card-primary" id="hdrLoop">
                                    <div class="card-header">
                                        <h3 class="card-title col-8">
                                            <div>
                                                <button type="button" class="btn btn-xs "><i class="fa fa-pen"></i></button>
                                            </div>
                                            <div class="col">
                                                <input type="text" style="border:none" class="form-control bg-primary"
                                                    id="" value="${getVal.chart_kd_reg + '&nbsp;&nbsp;-&nbsp&nbsp;' + getVal.chart_nm_pasien + '&nbsp;&nbsp;-&nbsp&nbsp;' + getVal.chart_dokter + '&nbsp;&nbsp;-&nbsp&nbsp;' + getVal.chart_layanan + '&nbsp;&nbsp;-&nbsp&nbsp;' +
                                                    dateView}" readonly>
                                            </div>
                                        </h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputDescription">Subjective</label>
                                            <textarea id="" class="show_chart_S form-control" rows="4" readonly value="">${getVal.chart_S}</textarea>
                                        </div>
                                        <div class="show_chart_O form-group">
                                            <label for="inputDescription">Objective</label>
                                            <textarea id="" class="show_chart_O form-control" rows="4" readonly>${getVal.chart_O}</textarea>
                                        </div>
                                        <div class="show_chart_A form-group">
                                            <label for="inputDescription">Assesment</label>
                                            <textarea id="" class="show_chart_A form-control mb-3" rows="2" readonly>${getVal.chart_A_diagnosa}</textarea>
                                            <textarea id="" class="show_chart_A form-control" rows="4" readonly>${getVal.chart_A}</textarea>
                                        </div>
                                        <div class="show_chart_P form-group">
                                            <label for="inputDescription">Plan</label>
                                            <textarea id="" class="show_chart_P form-control" rows="4" readonly>${getVal.chart_P}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`)
                    })
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

        // Get Data setelah reload
        window.onload = getTimeline();

        function getTimelineOnSubmit() {
            var data = sessionStorage.getItem("dataMR");
            var dataObject;

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
                    // alert($isTimelineHistory);
                    if (isTimelineHistory != '') {
                        $.each(isTimelineHistory, function(key, timeline) {
                            // header informasi
                            $('#tr_tgl_trs').val(timeline.chart_tgl_trs);
                            $('#tr_kd_reg').val(timeline.chart_kd_reg);
                            $('#tr_no_mr').val(timeline.chart_mr);
                            $('#tr_nm_pasien').val(timeline.chart_nm_pasien);
                            $('#tr_layanan').val(timeline.chart_layanan);
                            $('#tr_dokter').val(timeline.chart_dokter);
                            // $('#tr_alamat').val(timeline.chart_alamat);

                            $('#show_chart_S').val(timeline.chart_S);
                            $('#show_chart_O').val(timeline.chart_O);
                            $('#show_chart_A').val(timeline.chart_A);
                            $('#show_chart_P').val(timeline.chart_P);
                            // console.log(timeline.chart_S);
                            $('#labelTimeline').val(timeline.chart_kd_reg + '-' + timeline
                                .chart_nm_pasien + '-' + timeline
                                .chart_dokter + '-' + timeline.chart_layanan + '-' +
                                timeline
                                .chart_tgl_trs);
                        });
                    } else {
                        $('#show_chart_S').val('');
                        $('#show_chart_O').val('');
                        $('#show_chart_A').val('');
                        $('#show_chart_P').val('');
                        $('#labelTimeline').val('');
                    }
                }
            })
        };
    </script>
@endpush
