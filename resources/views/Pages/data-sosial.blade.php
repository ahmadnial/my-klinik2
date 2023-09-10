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
            <!-- /.card-header -->
            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>No</th>
                                <th>BED</th>
                                <th>Nama</th>
                                <th>Pasien ID</th>
                                <th>DPJD</th>
                                <th>Diet</th>
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
                            <td></td>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalLabelLarge">Data Pasien Baru</h4>
                </div>
                <form action="{{ url('/create-dasos') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">No. Rekam Medis</label>
                            <input type="text" class="form-control" name="fs_mr" value="{{ $no_mr }}" readonly>
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
