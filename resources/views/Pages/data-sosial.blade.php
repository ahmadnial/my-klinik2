@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahPasien">Tambah
                    Pasien</button>
                <h3 class="card-title">Data Sosial Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="">
                    <table id="example1" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>No.MR</th>
                                <th>Nama</th>
                                <th>Tgl Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                {{-- <th>No.Hp</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
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
                            @endforeach --}}
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
                <form action="{{ url('/create-dasos') }}" method="post">
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
                                <input type="text" class="form-control" name="fs_nama" placeholder="Nama Pasien">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tempat Lahir</label>
                                <input type="text" class="form-control" name="fs_tempat_lahir"
                                    placeholder="Tempat Kelahiran">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="fs_tgl_lahir"
                                    placeholder="Tanggal Lahir Pasien">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Jenis Kelamin</label>
                                <select name="fs_jenis_kelamin" id="fs_jenis_kelamin" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="Laki-laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
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
                            <div class="form-group col-sm-6">
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
                            </div>
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
    @foreach ($isdatasosial as $d)
        <div class="modal fade" id="Edit{{ $d->fs_mr }}" tabindex="-1" role="dialog"
            aria-labelledby="modalLabelLarge" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
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
                                    <input type="text" class="form-control" name="fs_mr"
                                        value="{{ $d->fs_mr }}" readonly>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control" name="fs_nama" placeholder="Nama Pasien"
                                        value="{{ $d->fs_nama }}">
                                    @if ($errors->has('fs_nama'))
                                        <small class="error">{{ $errors->first('fs_nama') }}</small>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="fs_tempat_lahir"
                                        placeholder="Tempat Kelahiran" value="{{ $d->fs_tempat_lahir }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="fs_tgl_lahir"
                                        placeholder="Tanggal Lahir Pasien" value="{{ $d->fs_tgl_lahir }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="fs_jenis_kelamin" id="fs_jenis_kelamin" class="form-control">
                                        <option value="{{ $d->fs_jenis_kelamin }}">{{ $d->fs_jenis_kelamin }}</option>
                                        <option value="Laki-laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Jenis Identitas</label>
                                    <select name="fs_jenis_identitas" id="fs_jenis_identitas" class="form-control">
                                        <option value="{{ $d->fs_jenis_identitas }}">{{ $d->fs_jenis_identitas }}
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
                                    <input type="text" class="form-control" name="fs_no_identitas"
                                        placeholder="Nomor Identitas" value="{{ $d->fs_no_identitas }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Nama Ibu Kandung</label>
                                    <input type="text" class="form-control" name="fs_nm_ibu_kandung"
                                        placeholder="Nama Ibu Kandung" value="{{ $d->fs_nm_ibu_kandung }}">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="">Alamat</label>
                                    <textarea type="date" class="form-control" name="fs_alamat">{{ $d->fs_alamat }}</textarea>
                                </div>
                                <div class="form-group col-sm-6">
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
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="kota">Kabupaten / Kota</label>
                                    <div class="col">
                                        <select class="form-control" name="kota" id="kota" required>
                                            <option value="{{ $d->kota }}">{{ $d->kota }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="kecamatan">Kecamatan</label>
                                    <div class="col">
                                        <select class="form-control" name="kecamatan" id="kecamatan" required>
                                            <option value="{{ $d->kecamatan }}">{{ $d->kecamatan }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label class="col-form-label" for="desa">Kelurahan</label>
                                    <div class="col">
                                        <select class="form-control" name="desa" id="desa" required>
                                            <option value="{{ $d->desa }}">{{ $d->desa }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="">Suku</label>
                                    <input type="text" class="form-control" name="fs_suku" placeholder="Suku"
                                        value="{{ $d->fs_suku }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Bahasa</label>
                                    <select name="fs_bahasa" id="fs_bahasa" class="form-control">
                                        <option value="{{ $d->fs_bahasa }}">{{ $d->fs_bahasa }}</option>
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
                                        <option value="{{ $d->fs_agama }}">{{ $d->fs_agama }}</option>
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
                                    <select name="fs_pekerjaan" id="fs_pekerjaan" class="form-control"
                                        style="width:100%;">
                                        <option value="{{ $d->fs_pekerjaan }}">{{ $d->fs_pekerjaan }}</option>
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
                                        <option value="{{ $d->fs_pendidikan }}">{{ $d->fs_pendidikan }}</option>
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
                                        <option value="{{ $d->fs_status_kawin }}">{{ $d->fs_status_kawin }}</option>
                                        <option value="Belum kawin">Belum kawin</option>
                                        <option value="Kawin">Kawin</option>
                                        <option value="Janda">Janda</option>
                                        <option value="Duda">Duda</option>
                                        <option value="Tidak Diketahui">Tidak Diketahui</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Alergi Pasien</label>
                                    <input type="text" class="form-control" name="fs_alergi"
                                        placeholder="Alergi Obat / Makanan Pasien" value="{{ $d->fs_alergi }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Nomor Telephone</label>
                                    <input type="number" class="form-control" name="fs_no_hp"
                                        placeholder="Nomor Telephone/WA Pasien" value="{{ $d->fs_no_hp }}">
                                </div>
                                <div class="">
                                    <i class="text-danger">Last Save By {{ $d->fs_user }}</i>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> &nbsp;
                                Update</button>
                        </div>
                </div>
                </form>
            </div>
        </div>


        <div class="modal fade" id="Delete{{ $d->fs_mr }}" tabindex="-1" role="dialog"
            aria-labelledby="modalLabelLarge" aria-hidden="true">
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
                                    value="Hapus Data RM Pasien : {{ $d->fs_nama }} ?" readonly>
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
    @endforeach
@endsection
@push('scripts')
    <script>
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
    </script>
@endpush
