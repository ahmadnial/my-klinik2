@extends('Pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-3">
                        <label for="">Nomor Registrasi</label>
                        <select class="form-control-pasien" id="tr_kd_reg" style="width: 100%;" name="tr_kd_reg">
                            @foreach ($isRegActive as $reg)
                                <option value="">--Select--</option>
                                <option value="{{ $reg->fr_kd_reg }}">
                                    {{ $reg->fr_kd_reg . '-' . $reg->fr_mr }}
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
                        <textarea type="text" class="form-control" name="tr_umur" id="tr_umur" value="" readonly></textarea>
                    </div>
                    <input type="hidden" id="user" name="user" value="tes">
                </div>
            </div>
        </div>
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
                        <div class="card-body">
                            {{-- ================================ --}}
                            <div class="row">
                                <div class="col-md">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">dr.Aji Pangki - 01-09-2023 - Layanan</h3>

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
                                                <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Objective</label>
                                                <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Assesment</label>
                                                <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputDescription">Plan</label>
                                                <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                            </div>
                                            {{-- <div class="form-group">
                                            <label for="inputStatus">Status</label>
                                            <select id="inputStatus" class="form-control custom-select">
                                                <option disabled>Select one</option>
                                                <option>On Hold</option>
                                                <option>Canceled</option>
                                                <option selected>Success</option> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputClientCompany">Client Company</label>
                                            <input type="text" id="inputClientCompany" class="form-control"
                                                value="Deveint Inc">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputProjectLeader">Project Leader</label>
                                            <input type="text" id="inputProjectLeader" class="form-control"
                                                value="Tony Chicken">
                                        </div> --}}
                                        </div>
                                    </div>
                                    {{-- ===================================================== --}}

                                    <div class="row">
                                        <div class="col-md">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">General</h3>

                                                    <div class="card-tools">
                                                        <button type="button" class="btn btn-tool"
                                                            data-card-widget="collapse" title="Collapse">
                                                            <i class="fas fa-minus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="inputName">Project Name</label>
                                                        <input type="text" id="inputName" class="form-control"
                                                            value="AdminLTE">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputDescription">Project Description</label>
                                                        <textarea id="inputDescription" class="form-control" rows="4">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputStatus">Status</label>
                                                        <select id="inputStatus" class="form-control custom-select">
                                                            <option disabled>Select one</option>
                                                            <option>On Hold</option>
                                                            <option>Canceled</option>
                                                            <option selected>Success</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputClientCompany">Client Company</label>
                                                        <input type="text" id="inputClientCompany"
                                                            class="form-control" value="Deveint Inc">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputProjectLeader">Project Leader</label>
                                                        <input type="text" id="inputProjectLeader"
                                                            class="form-control" value="Tony Chicken">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{--   --}}

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
    </section>

    <!-- /.content -->
    {{-- <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Budget</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEstimatedBudget">Estimated budget</label>
                    <input type="number" id="inputEstimatedBudget" class="form-control" value="2300" step="1">
                </div>
                <div class="form-group">
                    <label for="inputSpentBudget">Total amount spent</label>
                    <input type="number" id="inputSpentBudget" class="form-control" value="2000" step="1">
                </div>
                <div class="form-group">
                    <label for="inputEstimatedDuration">Estimated project duration</label>
                    <input type="number" id="inputEstimatedDuration" class="form-control" value="20"
                        step="0.1">
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    </div> --}}
@endsection

@push('scripts')
    <script>
        // Ajax Search Registrasi
        $('#tr_kd_reg').select2({
            placeholder: 'Search Registrasi',
        });

        // Call Hasil Search Registrasi
        function getDataObat() {
            var obat = $('#tr_kd_reg').val();
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
    </script>
@endpush
