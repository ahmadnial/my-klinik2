@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahPasien">Tambah
                    Pasien</button>
                <h3 class="card-title">jsGrid</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="table1" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Nama Pasien</th>
                                <th>Kode Registrasi</th>
                                <th>Layanan</th>
                                <th>Umur</th>
                                <th>BB</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- The modal -->
    <div class="modal fade" id="TambahPasien">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Large Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Kode Registrasi</label>
                            <input type="text" class="form-control" name="fr_kd_reg" readonly
                                value="{{ $kd_reg }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Nama Pasien/No. MR</label>
                            <select class="form-control-pasien" id="search" style="width: 100%;" name="fr_nm_pasien"
                                onchange="getData()"></select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="fr_tgl_lahir"
                                placeholder="Tanggal Lahir Pasien">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Jenis Kelamin</label>
                            <select name="fs_jenis_kelamin" id="fr_jenis_kelamin" class="form-control">
                                <option value="Laki-laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <hr>
                        <hr> <br>
                        <div class="form-group col-sm-6">
                            <label for="">Layanan</label>
                            <select name="fr_layanan" id="fr_layanan" class="form-control">
                                <option value="">--Select--</option>
                                @foreach ($layanan as $lay)
                                    <option value="{{ $lay->fm_kd_layanan }}">{{ $lay->fm_nm_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Dokter</label>
                            <select name="fs_jenis_kelamin" id="fr_dokter" class="form-control">
                                <option value="Laki-laki">Dokter</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Jaminan</label>
                            <select name="fs_jenis_kelamin" id="fr_jaminan" class="form-control">
                                <option value="Laki-laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group col-sm-12">
                        <label for="">Berat Badan</label>
                        <input type="text" class="form-control" name="fr_bb" placeholder="Nomor Telephone/WA Pasien">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Alergi</label>
                        <input type="text" class="form-control" name="fr_alergi" id="fr_alamat"
                            placeholder="Nomor Telephone/WA Pasien">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Alamat</label>
                        <textarea type="date" class="form-control" name="">Alamat Lengkap Pasien</textarea>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Nomor Telephone</label>
                        <input type="text" class="form-control" name="fr_no_tlp" placeholder="Nomor Telephone/WA Pasien">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="" data-dismiss="modal"></button>
                    <button type="button" class="btn btn-success float-rights"><i class="fa fa-save"></i> &nbsp;
                        Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Ajax Search Registrasi
        var path = "{{ route('registrasiSearch') }}";

        $('#search').select2({
            placeholder: 'Nama Pasien / no.MR',
            ajax: {
                url: path,
                dataType: 'json',
                delay: 150,
                processResults: function(isdata) {
                    return {
                        results: $.map(isdata, function(item) {
                            return {
                                // text: item.fs_mr,
                                text: item.fs_mr + ' - ' + item.fs_nama + ' - ' + item.fs_tgl_lahir,
                                id: item.fs_mr,
                                alamat: item.fs_alamat,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        function getData() {
            var fs_mr = $('#search').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getDasos') }}/" + fs_mr,
                type: 'GET',
                data: {
                    'fs_mr': fs_mr
                },
                success: function(isdata2) {
                    var json = isdata2;
                    obj = JSON.stringify(json);
                    // var tz = object.value(obj);
                    // for (var key in obj) {
                    // Console logs all the values in the objArr Array:
                    alert(obj)
                    // console.log(obj);
                    // }
                    $("#fr_alamat").val(obj);
                }
            })
        };

        $(document).ready(function() {
            $('#fr_layanan').on('change', function() {
                var id_layanan = $(this).val();
                console.log(id_layanan);
                if (id_layanan) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('getLayananMedis') }}/" + id_layanan,
                        type: 'get',
                        data: {
                            'fm_layanan': id_layanan
                        },
                        dataType: 'json',
                        success: function(islayananMedis) {
                            console.log(islayananMedis);

                        }
                    })
                } else {

                }
            });
        });
    </script>
@endpush
