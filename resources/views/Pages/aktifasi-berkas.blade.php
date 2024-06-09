@extends('pages.master')

@section('mytitle', 'Aktifasi')
@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Aktifasi Berkas</h3>
                <button type="" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahAktifasi">Aktifasi Berkas
                </button>
            </div>

            <div class="card-body">
                <div class="button"></div>
                <div id="result" class="">
                    <table id="example1" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Kode aktifasi</th>
                                <th>No.MR</th>
                                <th>Nama Pasien</th>
                                <th>Layanan</th>
                                {{-- <th>Dokter</th>
                                <th>Umur</th>
                                <th>Kunjungan</th> --}}
                                <th>User Activator</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="tb">
                            @foreach ($listAktifasi as $item)
                                <tr>
                                    <td>{{ $item->kd_aktifasi }}</td>
                                    <td>{{ $item->mr_aktifasi }}</td>
                                    <td>{{ $item->nm_pasien_aktifasi }}</td>
                                    <td>{{ $item->layanan_aktifasi }}</td>
                                    <td>{{ $item->user_aktifasi }}</td>
                                    <td><button type="" class="btn btn-xs btn-danger"
                                            data-kd_aktifasi='{{ $item->kd_aktifasi }}' onclick="setNonaktif(this)">Set
                                            Non-Aktif</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- The modal Create -->
    <div class="modal fade" id="TambahAktifasi">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Aktifasi Berkas Pasien</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="create-aktifasi" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">Kode Aktifasi</label>
                                <input type="text" class="form-control" name="kd_aktifasi" id="kd_aktifasi" readonly
                                    value="{{ $kd_aktifasi_get }}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tanggal Aktifasi</label>
                                <input type="date" class="form-control" name="tgl_trs_aktifasi" id="tgl_trs_aktifasi"
                                    value="{{ $dateNow }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nama / No.RM Pasien</label>
                                <select class="form-control-pasien" id="mr_aktifasi" style="width: 100%;" name="mr_aktifasi"
                                    onchange="getData()"></select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Pasien</label>
                                <input type="text" class="form-control" name="nm_pasien_aktifasi" id="nm_pasien_aktifasi"
                                    value="" readonly>
                            </div>
                            <input type="hidden" id="reg_aktifasi" name="reg_aktifasi">
                            <hr>
                            <hr> <br>
                            <div class="form-group col-sm-6">
                                <label for="">Layanan</label>
                                <select name="layanan_aktifasi" id="layanan_aktifasi" class="fr_layanan form-control"
                                    required>
                                    <option value="">--Select--</option>
                                    @foreach ($layanan as $lay)
                                        <option value="{{ $lay->fm_nm_layanan }}">{{ $lay->fm_nm_layanan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="form-group col-sm-6">
                            <label for="">Dokter</label>
                            <select name="fr_dokter" id="fr_dokter" class="fr_dokter form-control" required>

                            </select>
                        </div> --}}
                            <div class="form-group col-sm-6">
                                <label for="">Kunjungan Terakhir</label>
                                <input type="text" class="form-control" style="background-color:#edfafa; border:none"
                                    id="kunjungan_terakhir" readonly>
                            </div>
                        </div>
                        <hr>
                </div>
                <input type="hidden" name="user_aktifasi" id="user_aktifasi" value="{{ Auth::user()->name }}">
                <div class="modal-footer">
                    {{-- <button type="button" class="" data-dismiss="modal"></button> --}}
                    <button type="submit" id="create" class="btn btn-success float-rights"><i class="fa fa-save"></i>
                        &nbsp;
                        Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The modal Edit -->

@endsection

@push('scripts')
    <script>
        // Ajax Search RM untuk Registrasi
        var path = "{{ route('getRegAktifasi') }}";

        $('#mr_aktifasi').select2({
            placeholder: 'Nama / Nomor RM Pasien',
            ajax: {
                url: path,
                dataType: 'json',
                delay: 150,
                processResults: function(isdata) {
                    return {
                        results: $.map(isdata, function(item) {
                            return {
                                // text: item.fs_mr,
                                text: item.fr_mr + ' - ' + item.fr_nama + ' - ' + item.fr_kd_reg,
                                id: item.fr_mr,
                                // alamat: item.fs_alamat,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // Call Hasil Search MR
        function getData() {
            var fr_mr = $('#mr_aktifasi').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('selectRegAktifasi') }}/" + fr_mr,
                type: 'GET',
                data: {
                    'fr_mr': fr_mr
                },
                success: function(isdata2) {
                    // var json = isdata2;
                    $.each(isdata2, function(key, datavalue) {
                        $('#nm_pasien_aktifasi').val(datavalue.fr_nama);
                        $('#reg_aktifasi').val(datavalue.fr_kd_reg);
                        $('#kunjungan_terakhir').val(datavalue.fs_tgl_kunjungan_terakhir);
                    })
                }
            })
        };

        function setNonaktif(x) {
            var kd_aktifasi = $(x).data('kd_aktifasi');
            // alert(kd_aktifasi);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('deaktif') }}",
                type: "POST",
                data: {
                    kd_aktifasi: kd_aktifasi,
                },
                cache: false,
                success: function(sessionFlash) {
                    if (sessionFlash == 'Success') {
                        toastr.success('Berhasil Deaktif!', {
                            timeOut: 2000,
                            preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        // $('#voidReg').modal('hide');
                        window.location.replace("{{ url('aktifasi-berkas') }}")
                    } else {
                        toastr.error('Some Error Occured!', {
                            timeOut: 2000,
                            preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                    }
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
    </script>
@endpush
