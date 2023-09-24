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
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                    title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            {{-- Hidden value --}}
                                            <input type="hidden" id="chart_id" name="chart_id"
                                                value="{{ $chart_id }}">
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
                                                <textarea id="chart_A" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Plan</label>
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

    <div class="row">
        <div class="col" id="accordion">
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            SOAP
                        </h4>
                    </div>
                </a>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    @foreach ($isTindakanChart as $tc)
                        <div class="card-body">
                            {{-- ================================ --}}
                            <div class="row">
                                <div class="col-md">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">
                                                {{ $tc->chart_dokter . '-' . '' . $tc->chart_tgl_trs . '-' . '' . $tc->chart_layanan }}
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
                                                <textarea id="inputDescription" class="form-control" rows="4" readonly>{{ $tc->chart_S }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Objective</label>
                                                <textarea id="inputDescription" class="form-control" rows="4" readonly>{{ $tc->chart_O }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Assesment</label>
                                                <textarea id="inputDescription" class="form-control" rows="4" readonly>{{ $tc->chart_A }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Plan</label>
                                                <textarea id="inputDescription" class="form-control" rows="4" readonly>{{ $tc->chart_P }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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

        // Call Hasil Search Registrasi
        $("#tr_kd_reg").on("change", function() {
            var kdReg = $('#tr_kd_reg').val();
            // alert(kdReg);
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
                    // alert($isRegSearch);
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
                    })
                }
            })
        });

        $("#tr_tgl_lahir").on("change", function() {
            // var kdReg = $('#tr_kd_reg').val();
            // alert(kdReg);
            // selecting the elements
            var date = $('#tr_tgl_lahir').val();

            // var date = document.getElementById('tr_tgl_lahir');
            // alert(date);
            // set maximum date to today
            date.max = new Date().toISOString().split('T')[0];

            function calculateAge() {
                var today = new Date();
                var birthDate = new Date(date.value);

                // Calculate years
                var years;
                if (today.getMonth() > birthDate.getMonth() || (today.getMonth() == birthDate.getMonth() && today
                        .getDate() >=
                        birthDate.getDate())) {
                    years = today.getFullYear() - birthDate.getFullYear();
                } else {
                    years = today.getFullYear() - birthDate.getFullYear() - 1;
                }

                // Calculate months
                var months;
                if (today.getDate() >= birthDate.getDate()) {
                    months = today.getMonth() - birthDate.getMonth();
                } else if (today.getDate() < birthDate.getDate()) {
                    months = today.getMonth() - birthDate.getMonth() - 1;
                }
                // make month positive
                months = months < 0 ? months + 12 : months;

                // Calculate days
                var days;
                // days of months in a year
                var monthDays = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                if (today.getDate() >= birthDate.getDate()) {
                    days = today.getDate() - birthDate.getDate();
                } else {
                    days = today.getDate() - birthDate.getDate() + monthDays[birthDate.getMonth()];
                }

                // Display result
                // result.innerHTML = `<p class="birthdate">You were born on ${birthDate.toDateString()}.</p>`;
                // result.innerHTML += `<p class="age">You are ${years} years, ${months} months and ${days} days old.</p>`;
                // if (months == 0 && days == 0) {
                //     result.innerHTML += `<p class="wishing">Happy Birthday!🎂🎈🎈</p>`;
                // }
                var hasil = years + months + days;
                alert(hasil);
            }
            // calculate.addEventListener('click', calculateAge);

            // // run calculate on enter key
            // document.addEventListener('keypress', (e) => {
            //     if (e.keyCode == 13) {
            //         calculate.click();
            //     }
            // });
        });
        // onload focus on date input
        // date.focus();

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
                var chart_P = $('#chart_P').val();

                if (chart_kd_reg != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('chartCreate') }}",
                        type: "POST",
                        data: {
                            type: 2,
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
                            chart_P: chart_P,
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
                            return window.location.href = "{{ url('tindakan-medis') }}";
                            // document.location.reload()
                        }
                    });
                } else {
                    alert('Please fill all the field !');
                }
            });
        });


        window.onload = function() {
            localStorage.setItem("mr", $('#tr_no_mr').val());
            var mr = localStorage.getItem('mr');
            console.log(mr);
        };

        // Search History MR

        //  To print the value of localStorage variable name

        // if (condition) {

        // } else {

        // }
    </script>
@endpush
