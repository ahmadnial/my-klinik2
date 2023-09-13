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
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>No.MR</th>
                                <th>Nama</th>
                                <th>Tgl Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>No.Hp</th>
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
                                    <td>{{ $item->fs_no_hp }}</td>
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>

    <!-- The modal -->
    <div class="modal fade" id="TambahPasien" tabindex="-1" role="dialog" aria-labelledby="modalLabelLarge"
        aria-hidden="true">
        <div class="modal-dialog">
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
                        <div class="form-group">
                            <label for="">No. Rekam Medis</label>
                            <input type="text" class="form-control" name="fs_mr" value="{{ $mr }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="fs_nama" placeholder="Nama Pasien">
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="fs_tgl_lahir"
                                placeholder="Tanggal Lahir Pasien">
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <select name="fs_jenis_kelamin" id="fs_jenis_kelamin" class="form-control">
                                <option value="Laki-laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea type="date" class="form-control" name="fs_alamat"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Telephone</label>
                            <input type="text" class="form-control" name="fs_no_hp"
                                placeholder="Nomor Telephone/WA Pasien">
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> &nbsp; Save</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
@endsection
