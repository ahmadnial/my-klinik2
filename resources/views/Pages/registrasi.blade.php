@extends('pages.master')
@php
    function hitung_umur($tanggal_lahir)
    {
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime('today');
        if ($birthDate > $today) {
            exit('0 tahun 0 bulan 0 hari');
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $y . ' tahun ' . $m . ' bulan ' . $d . ' hari';
    }
    
    // echo hitung_umur('1980-12-01');
    
@endphp
@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registrasi Pasien</h3>
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahPasien">Tambah
                    Pasien</button>
            </div>

            <div class="card-body">
                <div class="button"></div>
                <div id="result" class="">
                    <table id="example1" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Kode Registrasi</th>
                                <th>No.MR</th>
                                <th>Nama Pasien</th>
                                <th>Layanan</th>
                                <th>Dokter</th>
                                <th>Umur</th>
                                <th>BB</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="tb">
                            @foreach ($isviewreg as $item)
                                <tr>
                                    <td>{{ $item->fr_kd_reg }}</td>
                                    <td>{{ $item->fr_mr }}</td>
                                    <td>{{ $item->fr_nama }}</td>
                                    <td>{{ $item->fr_layanan }}</td>
                                    <td>{{ $item->fr_dokter }}</td>
                                    <td>
                                        @php
                                            echo hitung_umur($item->fr_tgl_lahir);
                                        @endphp
                                    </td>
                                    <td>{{ $item->fr_bb }}Kg</td>
                                    <td>
                                        <button class="btn btn-xs btn-success"
                                            data-toggle="modal"data-target="#Edit">Edit</button>
                                        <button class="btn btn-xs btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
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
                    <h4 class="modal-title">Registrasi Pasien</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Kode Registrasi</label>
                            <input type="text" class="form-control" name="fr_kd_reg" id="fr_kd_reg" readonly
                                value="{{ $kd_reg }}">
                        </div>
                        <input type="hidden" id="fr_nama" name="fr_nama">
                        <div class="form-group col-sm-6">
                            <label for="">Nama Pasien/No. MR</label>
                            <select class="form-control-pasien" id="fr_mr" style="width: 100%;" name="fr_mr"
                                onchange="getData()"></select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="fr_tgl_lahir" id="fr_tgl_lahir"
                                placeholder="Tanggal Lahir Pasien">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Jenis Kelamin</label>
                            <select name="fr_jenis_kelamin" id="fr_jenis_kelamin" class="form-control">
                                <option value="">--Select--</option>
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
                                    <option value="{{ $lay->fm_nm_layanan }}">{{ $lay->fm_nm_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Dokter</label>
                            <select name="fr_dokter" id="fr_dokter" class="form-control">

                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Jaminan</label>
                            <select name="fr_jaminan" id="fr_jaminan" class="form-control">
                                <option value="">--Select--</option>
                                @foreach ($jaminan as $jam)
                                    <option value="{{ $jam->fm_nm_jaminan }}">{{ $jam->fm_nm_jaminan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Session Poli</label>
                            <select name="fr_session_poli" id="fr_session_poli" class="form-control">
                                <option value="">--Select--</option>
                                <option value="Pagi">Pagi</option>
                                <option value="Sore">Sore</option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group col-sm-12">
                        <label for="">Berat Badan</label>
                        <input type="number" class="form-control" name="fr_bb" id="fr_bb"
                            placeholder="Berat Badan Pasien">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Alergi</label>
                        <input type="text" class="form-control" name="fr_alergi" id="fr_alergi"
                            placeholder="Alergi Pasien">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Alamat</label>
                        <textarea type="date" class="form-control" name="fr_alamat" id="fr_alamat"></textarea>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Nomor Telephone</label>
                        <input type="text" class="form-control" name="fr_no_hp" id="fr_no_hp"
                            placeholder="Nomor Telephone/WA Pasien">
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="" data-dismiss="modal"></button> --}}
                    <button type="submit" id="create" class="btn btn-success float-rights"><i
                            class="fa fa-save"></i> &nbsp;
                        Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function autonumber() {
            let id = "ABCD9991";

            for (let i = 0; i < 100; i++) {
                let strings = id.replace(/[0-9]/g, '');
                let digits = (parseInt(id.replace(/[^0-9]/g, '')) + 1).toString();
                if (digits.length < 4)
                    digits = ("000" + digits).substr(-4);
                id = strings + digits;
                // console.log(id);
            }
        }

        // Ajax Search RM untuk Registrasi
        var path = "{{ route('registrasiSearch') }}";

        $('#fr_mr').select2({
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

        // Call Hasil Search MR
        function getData() {
            var fs_mr = $('#fr_mr').val();
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
                    // var json = isdata2;
                    $.each(isdata2, function(key, datavalue) {
                        $('#fr_nama').val(datavalue.fs_nama);
                        $('#fr_alamat').val(datavalue.fs_alamat);
                        $('#fr_no_hp').val(datavalue.fs_no_hp);
                        $('#fr_tgl_lahir').val(datavalue.fs_tgl_lahir);
                        $('#fr_jenis_kelamin').val(datavalue.fs_jenis_kelamin);
                    })
                }
            })
        };

        // Dependent Select Layanan Medis
        $(document).ready(function() {
            $('#fr_layanan').on('change', function() {
                var id_layanan = $(this).val();
                // console.log(id_layanan);
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
                            // console.log(islayananMedis);
                            $('#fr_dokter').empty();
                            $('#fr_dokter').append('<option value="">--Select--</option>');
                            $.each(islayananMedis, function(key, value) {
                                $('#fr_dokter').append('<option value="' + value
                                    .fm_nm_medis +
                                    '">' + value.fm_nm_medis +
                                    '</option>');
                            })
                        }
                    });
                }
            });

        });

        // View Registrasi
        // $(document).ready(function() {
        //     viewRegistrasi()
        // });

        // function viewRegistrasi() {
        //     $.get("{{ url('registrasiView') }}", {}, function(isviewreg, status) {
        //         // $.each(isviewreg, function(key, datavalue) {
        //         var container = document.getElementById("result");
        //         isviewreg.forEach(function(count) {
        //             // console.log(count);
        //             let tableBody = document.getElementById("tb");
        //             tableBody.innerHTML += '<tr><td>' + count.fr_kd_reg +
        //                 '</td><td>' +
        //                 count.fr_mr + '</td><td>' +
        //                 count.fr_nama + '</td><td>' +
        //                 count.fr_layanan + '</td></tr>';
        //         })
        //         // container.innerHTML = '</table></div>'
        //         // })
        //     });
        // }

        // Create Registrasi
        $(document).ready(function() {

            $('#create').on('click', function() {
                var fr_kd_reg = $('#fr_kd_reg').val();
                var fr_mr = $('#fr_mr').val();
                var fr_nama = $('#fr_nama').val();
                var fr_tgl_lahir = $('#fr_tgl_lahir').val();
                var fr_jenis_kelamin = $('#fr_jenis_kelamin').val();
                var fr_alamat = $('#fr_alamat').val();
                var fr_no_hp = $('#fr_no_hp').val();
                var fr_layanan = $('#fr_layanan').val();
                var fr_dokter = $('#fr_dokter').val();
                var fr_jaminan = $('#fr_jaminan').val();
                var fr_session_poli = $('#fr_session_poli').val();
                var fr_bb = $('#fr_bb').val();
                var fr_alergi = $('#fr_alergi').val();
                var fr_user = $('#fr_user').val();
                // alert(fm_nm_layanan);
                if (fr_mr != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('create-registrasi') }}",
                        type: "POST",
                        data: {
                            type: 2,
                            fr_kd_reg: fr_kd_reg,
                            fr_mr: fr_mr,
                            fr_nama: fr_nama,
                            fr_tgl_lahir: fr_tgl_lahir,
                            fr_jenis_kelamin: fr_jenis_kelamin,
                            fr_alamat: fr_alamat,
                            fr_no_hp: fr_no_hp,
                            fr_layanan: fr_layanan,
                            fr_dokter: fr_dokter,
                            fr_jaminan: fr_jaminan,
                            fr_session_poli: fr_session_poli,
                            fr_bb: fr_bb,
                            fr_alergi: fr_alergi,
                            fr_user: fr_user
                        },
                        cache: false,
                        success: function(dataResult) {
                            $('.close').click();
                            // document.getElementById("fm_nm_layanan").value = "";
                            window.location.replace("{{ url('registrasi') }}")
                            // viewRegistrasi()
                            // toastr.success('Saved');
                            // view()
                            // url = "{{ url('mstr-layanan') }}";
                        }
                    });
                } else {
                    alert('Please fill all the field !');
                }
            });
        });
    </script>
@endpush
