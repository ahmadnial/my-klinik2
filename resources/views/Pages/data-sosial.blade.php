@extends('pages.master')
@section('mytitle', 'Data Sosial')
@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#TambahPasien"><i class="fa fa-plus"></i>&nbsp;
                    Pasien Baru</button>
                <h3 class="card-title">Data Sosial Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div>
                    <table id="alldss" class="serverSideTable table table-hover table-striped">
                        <thead class="" style="background-color:rgb(242, 231, 255)">
                            <tr>
                                <th>No MR</th>
                                <th>Nama</th>
                                <th>Tgl Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                {{-- <th>No.Hp</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                            {{-- @foreach ($isdatasosial as $item)
                                <tr>
                                    <td>{{ $item->fs_mr }}</td>
                                    <td>{{ $item->fs_nama }}</td>
                                    <td>{{ $item->fs_tgl_lahir }}</td>
                                    <td>{{ $item->fs_jenis_kelamin }}</td>
                                    <td>{{ $item->fs_alamat }}</td>
                                    <td>
                                        <button class="btn btn-xs btn-info"
                                            data-toggle="modal"data-target="#Detail">Detail</button>
                                        <button class="btn btn-xs btn-success"
                                            data-toggle="modal"data-target="#Edit{{ $item->fs_mr }}">Edit</button>
                                        <button class="btn btn-xs btn-danger"
                                            data-toggle="modal"data-target="#Delete{{ $item->fs_mr }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-xs btn-info"
                                        data-toggle="modal"data-target="#Detail">Detail</button>
                                    <button class="btn btn-xs btn-success"
                                        data-toggle="modal"data-target="#Edit">Edit</button>
                                    <button class="btn btn-xs btn-danger"
                                        data-toggle="modal"data-target="#Delete">Delete</button>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>

    <!-- The modal Create -->
    <div class="modal fade" id="TambahPasien" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabelLarge">Data Pasien Baru</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('/create-dasos') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">No. Rekam Medis</label>
                                <input type="text" class="form-control" name="fs_mr" value="{{ $mr }}"
                                    readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="fs_nama" placeholder="Nama Pasien"
                                    required>
                                <div class="invalid-feedback">
                                    Please..dont let me blank
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tempat Lahir</label>
                                <input type="text" class="form-control" name="fs_tempat_lahir"
                                    placeholder="Tempat Kelahiran">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="fs_tgl_lahir"
                                    placeholder="Tanggal Lahir Pasien" required>
                                <div class="invalid-feedback">
                                    Please..dont let me blank
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Jenis Kelamin</label>
                                <select name="fs_jenis_kelamin" id="fs_jenis_kelamin" class="form-control" required>
                                    <option value="">--Select--</option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please..dont let me blank
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Jenis Identitas</label>
                                <select name="fs_jenis_identitas" id="fs_jenis_identitas" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="KTP">KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="VISA">VISA</option>
                                    <option value="Paspor">Paspor</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nomor Identitas</label>
                                <input type="text" class="form-control" name="fs_no_identitas"
                                    placeholder="Nomor Identitas">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nama Ibu Kandung</label>
                                <input type="text" class="form-control" name="fs_nm_ibu_kandung"
                                    placeholder="Nama Ibu Kandung">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">Alamat</label>
                                <textarea type="date" class="form-control" name="fs_alamat"></textarea>
                            </div>
                            {{-- <div class="form-group col-sm-6">
                                <label class="col-form-label" for="provinsi">Provinsi</label>
                                <div class="col">
                                    @php
                                        $provinces = new App\Http\Controllers\WilayahController();
                                        $provinces = $provinces->provinces();
                                    @endphp
                                    <select class="form-control" name="provinsi" id="provinsi" style="width: 100%"
                                        required>
                                        <option>Select</option>
                                        @foreach ($provinces as $item)
                                            <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            <div class="form-group col-sm-6">
                                <label class="col-form-label" for="kota">Kabupaten / Kota</label>
                                <div class="col">
                                    <select class="form-control" name="kota" id="kota" required>
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-form-label" for="kecamatan">Kecamatan</label>
                                <div class="col">
                                    <select class="form-control" name="kecamatan" id="kecamatan" required>
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-form-label" for="desa">Kelurahan</label>
                                <div class="col">
                                    <select class="form-control" name="desa" id="desa" required>
                                        <option>Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">Suku</label>
                                <input type="text" class="form-control" name="fs_suku" placeholder="Suku">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Bahasa</label>
                                <select name="fs_bahasa" id="fs_bahasa" class="form-control">
                                    <option>Select</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Jawa">Jawa</option>
                                    <option value="Lain-lain">Lain-lain</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">Agama</label>
                                <select name="fs_agama" id="fs_agama" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katholik">Katholik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Penghayat">Penghayat</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Pekerjaan</label>
                                <select name="fs_pekerjaan" id="fs_pekerjaan" class="form-control" style="width:100%;">
                                    <option value="">--Select--</option>
                                    <option value="Di Bawah Umur">Di Bawah Umur</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Pekerja Lepas">Pekerja Lepas</option>
                                    <option value="Pedagang">Pedagang</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                    <option value="TNI/POLRI">TNI/POLRI</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Pendidikan</label>
                                <select name="fs_pendidikan" id="fs_pendidikan" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA/SMK">SMA/SMK</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Sarjana">Sarjana</option>
                                    <option value="Magister">Magister</option>
                                    <option value="Belum/Tidak Tamat SD">Belum/Tidak Tamat SD</option>
                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Status Nikah</label>
                                <select name="fs_status_kawin" id="fs_status_kawin" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="Belum kawin">Belum kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Cerai Hidup">Cerai Hidup</option>
                                    <option value="Cerai Mati">Cerai Mati</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Alergi Pasien</label>
                                <input type="text" class="form-control" name="fs_alergi"
                                    placeholder="Alergi Obat / Makanan Pasien">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nomor Telephone</label>
                                <input type="number" class="form-control" name="fs_no_hp"
                                    placeholder="Nomor Telephone/WA Pasien">
                            </div>
                            <input type="hidden" name="fs_user" id="fs_user" value="{{ Auth::user()->name }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> &nbsp;
                            Save</button>
                    </div>
            </div>
            </form>
        </div>
    </div>

    <!-- The modal Edit -->
    {{-- @foreach ($isdatasosial as $d) --}}
    <div class="modal fade" id="EditDasos" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-warning">
                    <h4 class="modal-title" id="modalLabelLarge">Edit Data Pasien</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('edit-dasos') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">No. Rekam Medis</label>
                                <input type="text" class="form-control" name="fs_mr" id="efs_mr" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nama</label>
                                <input type="text" class="form-control" name="fs_nama" id="efs_nama"
                                    placeholder="Nama Pasien" value="">
                                @if ($errors->has('fs_nama'))
                                    <small class="error">{{ $errors->first('fs_nama') }}</small>
                                @endif
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tempat Lahir</label>
                                <input type="text" class="form-control" name="fs_tempat_lahir" id="efs_tempat_lahir"
                                    placeholder="Tempat Kelahiran" value="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="fs_tgl_lahir" id="efs_tgl_lahir"
                                    placeholder="Tanggal Lahir Pasien" value="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Jenis Kelamin</label>
                                <select name="fs_jenis_kelamin" id="efs_jenis_kelamin" class="form-control">
                                    <option value=""></option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Jenis Identitas</label>
                                <select name="fs_jenis_identitas" id="efs_jenis_identitas" class="form-control">
                                    <option value="">
                                    </option>
                                    <option value="KTP">KTP</option>
                                    <option value="SIM">SIM</option>
                                    <option value="VISA">VISA</option>
                                    <option value="Paspor">Paspor</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nomor Identitas</label>
                                <input type="text" class="form-control" name="fs_no_identitas" id="efs_no_identitas"
                                    placeholder="Nomor Identitas" value="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nama Ibu Kandung</label>
                                <input type="text" class="form-control" name="fs_nm_ibu_kandung"
                                    id="efs_nm_ibu_kandung" placeholder="Nama Ibu Kandung" value="">
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">Alamat</label>
                                <textarea type="date" class="form-control" name="fs_alamat" id="efs_alamat"></textarea>
                            </div>
                            {{-- <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="provinsi">Provinsi</label>
                                    <div class="col">
                                        @php
                                            $provinces = new App\Http\Controllers\WilayahController();
                                            $provinces = $provinces->provinces();
                                        @endphp
                                        <select class="form-control" name="provinsi" id="provinsi" style="width: 100%"
                                            required>
                                            <option value="{{ $d->provinsi }}">{{ $d->provinsi }}</option>
                         @foreach ($provinces as $item)
                         <option value="{{ $item->id ?? '' }}">{{ $item->name ?? '' }}</option>
                         @endforeach
                         </select>
                     </div>
                 </div> --}}
                            <div class="form-group col-sm-6">
                                <label class="col-form-label" for="kota">Kabupaten / Kota</label>
                                <div class="col">
                                    <select class="form-control" name="kota" id="kota">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-form-label" for="kecamatan">Kecamatan</label>
                                <div class="col">
                                    <select class="form-control" name="kecamatan" id="kecamatan">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <label class="col-form-label" for="desa">Kelurahan</label>
                                <div class="col">
                                    <select class="form-control" name="desa" id="desa">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">Suku</label>
                                <input type="text" class="form-control" name="fs_suku" id="efs_suku"
                                    placeholder="Suku" value="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Bahasa</label>
                                <select name="fs_bahasa" id="efs_bahasa" class="form-control">
                                    <option value=""></option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="Jawa">Jawa</option>
                                    <option value="Lain-lain">Lain-lain</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">Agama</label>
                                <select name="fs_agama" id="efs_agama" class="form-control">
                                    <option value=""></option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katholik">Katholik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Konghucu">Konghucu</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Pekerjaan</label>
                                <select name="fs_pekerjaan" id="efs_pekerjaan" class="form-control" style="width:100%;">
                                    <option value=""></option>
                                    <option value="Di Bawah Umur">Di Bawah Umur</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Petani">Petani</option>
                                    <option value="Pekerja Lepas">Pekerja Lepas</option>
                                    <option value="Pedagang">Pedagang</option>
                                    <option value="Wiraswasta">Wiraswasta</option>
                                    <option value="Karyawan Swasta">Karyawan Swasta</option>
                                    <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                                    <option value="TNI/POLRI">TNI/POLRI</option>
                                    <option value="PNS">PNS</option>
                                    <option value="Mahasiswa">Mahasiswa</option>
                                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Pendidikan</label>
                                <select name="fs_pendidikan" id="efs_pendidikan" class="form-control">
                                    <option value=""></option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA/SMK">SMA/SMK</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="Sarjana">Sarjana</option>
                                    <option value="Magister">Magister</option>
                                    <option value="Belum/Tidak Tamat SD">Belum/Tidak Tamat SD</option>
                                    <option value="Tidak Sekolah">Tidak Sekolah</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Status Nikah</label>
                                <select name="fs_status_kawin" id="efs_status_kawin" class="form-control">
                                    <option value=""></option>
                                    <option value="Belum kawin">Belum kawin</option>
                                    <option value="Kawin">Kawin</option>
                                    <option value="Janda">Janda</option>
                                    <option value="Duda">Duda</option>
                                    <option value="Tidak Diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Alergi Pasien</label>
                                <input type="text" class="form-control" name="fs_alergi" id="efs_alergi"
                                    placeholder="Alergi Obat / Makanan Pasien" value="">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nomor Telephone</label>
                                <input type="number" class="form-control" name="fs_no_hp" id="efs_no_hp"
                                    placeholder="Nomor Telephone/WA Pasien" value="">
                            </div>
                            <hr><br>
                        </div>
                    </div>
                    <div class=" col-12 ml-3 mb-3">
                        <i class="fa fa-user text-danger"></i>&nbsp;&nbsp;<i class="text-danger">Last Save by
                            :</i> <input type="text" class="text-danger col-8" id="last_save_by" style="border: none"
                            readonly>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}
                        <button type="button" onclick="executeEditDasos()" class="btn btn-success"><i
                                class="fa fa-save"></i> &nbsp;
                            Update</button>
                    </div>
            </div>
            </form>
        </div>
    </div>


    <div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title" id="modalLabelLarge">Konfirmasi Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('delete-dasos') }}" method="DELETE">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <input type="text" class="form-control" style="border: none"
                                value="Hapus Data RM Pasien :  ?" readonly>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> &nbsp;
                                Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @endforeach --}}
@endsection
@push('scripts')
    <script>
        function getDasosEdit(f) {
            var kodeMR = $(f).data('kdmr');
            // alert(kodeMR);
            $('#EditDasos').modal('show');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getDasos') }}/" + kodeMR,
                type: "GET",
                data: {
                    fs_mr: kodeMR
                },
                success: function(isdata2) {
                    $.each(isdata2, function(key, dasos) {
                        $('#efs_mr').val(dasos.fs_mr);
                        $('#efs_nama').val(dasos.fs_nama);
                        $('#efs_tempat_lahir').val(dasos.fs_tempat_lahir);
                        $('#efs_tgl_lahir').val(dasos.fs_tgl_lahir);
                        $('#efs_jenis_kelamin').val(dasos.fs_jenis_kelamin);
                        $('#efs_jenis_identitas').val(dasos.fs_jenis_identitas);
                        $('#efs_no_identitas').val(dasos.fs_no_identitas);
                        $('#efs_nm_ibu_kandung').val(dasos.fs_nm_ibu_kandung);
                        $('#efs_alamat').val(dasos.fs_alamat);
                        $('#efs_suku').val(dasos.fs_suku);
                        $('#efs_bahasa').val(dasos.fs_bahasa);
                        $('#efs_agama').val(dasos.fs_agama);
                        $('#efs_pekerjaan').val(dasos.fs_pekerjaan);
                        $('#efs_pendidikan').val(dasos.fs_pendidikan);
                        $('#efs_status_kawin').val(dasos.fs_status_kawin);
                        $('#efs_alergi').val(dasos.fs_alergi);
                        $('#efs_no_hp').val(dasos.fs_no_hp);
                        const timeStampLastSave = dasos.updated_at;
                        if (timeStampLastSave == null) {
                            var dateView = '';
                        } else {
                            var dateView = moment(timeStampLastSave).format(
                                "D MMMM YYYY, h:mm:ss a");
                        }
                        const lastSave = dasos.fs_user + '   ' + dateView;
                        $('#last_save_by').val(lastSave);
                    })
                }

            });
        }

        function executeEditDasos() {
            var efs_mr = $('#efs_mr').val();
            var efs_nama = $('#efs_nama').val();
            var efs_tempat_lahir = $('#efs_tempat_lahir').val();
            var efs_tgl_lahir = $('#efs_tgl_lahir').val();
            var efs_jenis_kelamin = $('#efs_jenis_kelamin').val();
            var efs_jenis_identitas = $('#efs_jenis_identitas').val();
            var efs_no_identitas = $('#efs_no_identitas').val();
            var efs_nm_ibu_kandung = $('#efs_nm_ibu_kandung').val();
            var efs_alamat = $('#efs_alamat').val();
            var efs_suku = $('#efs_suku').val();
            var efs_bahasa = $('#efs_bahasa').val();
            var efs_agama = $('#efs_agama').val();
            var efs_pekerjaan = $('#efs_pekerjaan').val();
            var efs_pendidikan = $('#efs_pendidikan').val();
            var efs_status_kawin = $('#efs_status_kawin').val();
            var efs_alergi = $('#efs_alergi').val();
            var efs_no_hp = $('#efs_no_hp').val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('edit-dasos') }}",
                type: "POST",
                data: {
                    fs_mr: efs_mr,
                    fs_nama: efs_nama,
                    fs_tempat_lahir: efs_tempat_lahir,
                    fs_tgl_lahir: efs_tgl_lahir,
                    fs_jenis_kelamin: efs_jenis_kelamin,
                    fs_jenis_identitas: efs_jenis_identitas,
                    fs_no_identitas: efs_no_identitas,
                    fs_nm_ibu_kandung: efs_nm_ibu_kandung,
                    fs_alamat: efs_alamat,
                    fs_suku: efs_suku,
                    fs_bahasa: efs_bahasa,
                    fs_agama: efs_agama,
                    fs_pekerjaan: efs_pekerjaan,
                    fs_pendidikan: efs_pendidikan,
                    fs_status_kawin: efs_status_kawin,
                    fs_alergi: efs_alergi,
                    fs_no_hp: efs_no_hp
                },
                success: function(sessionFlash) {
                    if (sessionFlash == 'Error') {
                        toastr.error('Some Error Occured!', {
                            timeOut: 2000,
                            preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        $('#EditDasos').modal('hide');
                    } else {
                        toastr.success('Saved!', {
                            timeOut: 2000,
                            preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        // window.location.reload()
                        $('#EditDasos').modal('hide');
                        getAllDss()
                    }
                }
            });
        }


        function getAllDss() {
            $('#alldss').DataTable({
                processing: true,
                serverSide: true,
                dom: 'lBfrtip',
                responsive: true,
                "bDestroy": true,
                ajax: "{{ url('getAllDasos') }}",
                columns: [{
                        data: 'fs_mr',
                        name: 'fs_mr'
                    },
                    {
                        data: 'fs_nama',
                        name: 'fs_nama'
                    },
                    {
                        data: 'fs_tgl_lahir',
                        name: 'fs_tgl_lahir'
                    },
                    {
                        data: 'fs_jenis_kelamin',
                        name: 'fs_jenis_kelamin'
                    },
                    {
                        data: 'fs_alamat',
                        name: 'fs_alamat'
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
            }).buttons().container().appendTo('#alldss_wrapper .col-md-6:eq(0)');
        };

        getAllDss();

        $('#fs_pekerjaan').select2({
            placeholder: 'Pekerjaan',
        });
        $('#provinsi').select2({
            placeholder: 'Provinsi',
        });

        //DependentDropdown Wilayah RI
        function onChangeSelect(url, id, name) {
            // send ajax request to get the cities of the selected province and append to the select tag
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#' + name).empty();
                    $('#' + name).append('<option>Select</option>');

                    $.each(data, function(key, value) {
                        $('#' + name).append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        }
        $(function() {
            $('#provinsi').on('change', function() {
                onChangeSelect('{{ route('cities') }}', $(this).val(), 'kota');
            });
            $('#kota').on('change', function() {
                onChangeSelect('{{ route('districts') }}', $(this).val(), 'kecamatan');
            })
            $('#kecamatan').on('change', function() {
                onChangeSelect('{{ route('villages') }}', $(this).val(), 'desa');
            })
        });

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
