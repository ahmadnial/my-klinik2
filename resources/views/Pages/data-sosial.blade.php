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
                            @foreach ($isdatasosial as $item)
                                <tr>
                                    <td>{{ $item->fs_mr }}</td>
                                    <td>{{ $item->fs_nama }}</td>
                                    <td>{{ $item->fs_tgl_lahir }}</td>
                                    <td>{{ $item->fs_jenis_kelamin }}</td>
                                    <td>{{ $item->fs_alamat }}</td>
                                    {{-- <td>{{ $item->fs_no_hp }}</td> --}}
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
                            <div class="form-group col-sm-6">
                                <label for="">Alamat</label>
                                <textarea type="date" class="form-control" name="fs_alamat"></textarea>
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
                                    <option value="Janda">Janda</option>
                                    <option value="Duda">Duda</option>
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
                                    <label for="">Alamat</label>
                                    <textarea type="date" class="form-control" name="fs_alamat">{{ $d->fs_alamat }}</textarea>
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
    </script>
@endpush
