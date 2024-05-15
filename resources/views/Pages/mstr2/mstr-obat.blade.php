@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#TambahObat"><i class="fa fa-plus"></i>&nbsp;Tambah
                    Obat</button>
                <h3 class="card-title">MSTR BARANG / OBAT</h3>
            </div>

            <div class="card-body">
                <table id="example1" class="table table-striped table-hover">
                    <thead class="">
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Obat</th>
                            <th>Kategori</th>
                            <th>Golongan</th>
                            <th>Supplier</th>
                            <th>Sat. Beli</th>
                            <th>Sat. Jual</th>
                            <th>Hrg Beli</th>
                            <th>Hrg Jual Non-resep</th>
                            <th>Hrg Jual Resep</th>
                            <th>Hrg Jual Nakes</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($obatView as $tz)
                            <tr>
                                <td id="">{{ $tz->fm_kd_obat }}</td>
                                <td id="">{{ $tz->fm_nm_obat }}</td>
                                <td id="">{{ $tz->fm_kategori }}</td>
                                <td id="">{{ $tz->fm_golongan_obat }}</td>
                                <td id="">{{ $tz->fm_supplier }}</td>
                                <td id="">{{ $tz->fm_satuan_pembelian }}</td>
                                <td id="">{{ $tz->fm_satuan_jual }}</td>
                                {{-- <td id="">{{ $tz->fm_hrg_beli }}</td> --}}
                                <td id="">@currency($tz->fm_hrg_beli)</td>
                                <td id="">@currency($tz->fm_hrg_jual_non_resep)</td>
                                <td id="">{{ $tz->fm_hrg_jual_resep }}</td>
                                {{-- <td id="">@currency($tz->fm_hrg_jual_resep)</td> --}}
                                <td id="">@currency($tz->fm_hrg_jual_nakes)</td>
                                <td id="">
                                    @if ($tz->isActive == '1')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-primary">Non-Active</span>
                                    @endif
                                </td>
                                <td><button class="btn btn-xs btn-info" data-toggle="modal" data-target=""
                                        data-id="{{ $tz->fm_kd_obat }}" data-nmobat="{{ $tz->fm_nm_obat }}"
                                        data-kategori="{{ $tz->fm_kategori }}" data-supplier="{{ $tz->fm_supplier }}"
                                        data-satuan_pembelian="{{ $tz->fm_satuan_pembelian }}"
                                        data-satuan_penjualan="{{ $tz->fm_satuan_jual }}"
                                        data-isi_sat_beli="{{ $tz->fm_isi_satuan_pembelian }}"
                                        data-isi_satuan_beli="{{ $tz->st_isi_pembelian }}"
                                        data-hrg_beli_per1="{{ $tz->st_hrg_beli_per1 }}"
                                        data-hrg_beli_per2="{{ $tz->st_hrg_beli_per2 }}"
                                        data-hrg_beli_terbesar="{{ $tz->fm_hrg_beli }}"
                                        data-hrg_beli_terkecil="{{ $tz->fm_hrg_beli_detail }}"
                                        data-hrg_jual_reg="{{ $tz->fm_hrg_jual_non_resep }}"
                                        data-hrg_jual_resep="{{ $tz->fm_hrg_jual_resep }}"
                                        data-hrg_jual_nakes="{{ $tz->fm_hrg_jual_nakes }}"
                                        data-hrg_jual_reg_persen="{{ $tz->fm_hrg_jual_non_resep_persen }}"
                                        data-hrg_jual_resep_persen="{{ $tz->fm_hrg_jual_resep_persen }}"
                                        data-isactive="{{ $tz->isActive }}"
                                        data-hrg_jual_nakes_persen="{{ $tz->fm_hrg_jual_nakes_persen }}" id="editObat"
                                        onClick="getIDObat(this)"><i class="fa fa-edit"></i></button>
                                    {{-- <button class="btn btn-xs btn-danger" data-toggle="modal"
                                        data-target="#DeleteSupplier{{ $tz->fm_kd_supplier }}">Hapus</button> --}}
                                    {{-- <button class="btn btn-danger btn-xs" data-id="{{ $tz->fm_kd_obat }}"
                                        data-nmobat="{{ $tz->fm_nm_obat }}" onClick="delObat(this)"><i
                                            class="fa fa-trash"></i>Delete</button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    {{-- modal delete --}}
    <div class="modal fade" id="deleteModalObat" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="kd_obat_del" id="kd_obat_del">
                    apakah yakin akan menghapus <span class="text-danger" id="obatNameToDel"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="execDelObat()">Delete</button>
                </div>
            </div>
        </div>
    </div>
    {{-- end modal delete --}}

    <!-- The modal Edit -->
    <div class="modal fade" id="EditObatModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-nial">
                    <h4 class="modal-title">Edit Barang / Obat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Kode Obat</label>
                            <input type="text" class="form-control" name="efm_kd_obat" id="efm_kd_obat" readonly
                                value="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Obat</label>
                            <input type="text" class="form-control" name="efm_nm_obat" id="efm_nm_obat"
                                value="" placeholder="Input Nama Obat">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Kategori</label>
                            <select class="efm_kategori form-control" id="efm_kategori" style="width: 100%;"
                                name="efm_kategori">
                                {{-- <option value=""></option> --}}
                                @foreach ($kategori as $kt)
                                    <option value="{{ $kt->fm_nm_kategori_produk }}">
                                        {{ $kt->fm_nm_kategori_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Golongan</label>
                            <select class="efm_golongan_obat form-control" id="efm_golongan_obat" style="width: 100%;"
                                name="efm_golongan_obat">
                                <option value=""></option>
                                @foreach ($golongan as $gol)
                                    <option value="{{ $gol->fm_nm_jenis_obat }}">
                                        {{ $gol->fm_nm_jenis_obat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Supplier</label>
                            <select class="efm_supplier form-control" id="efm_supplier" style="width: 100%;"
                                name="efm_supplier">
                                @foreach ($supplier as $sp)
                                    <option value="{{ $sp->fm_nm_supplier }}">
                                        {{ $sp->fm_nm_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Satuan Pembelian</label>
                            <select class="efm_satuan_pembelian form-control" id="efm_satuan_pembelian"
                                style="width: 100%;" name="efm_satuan_pembelian">
                                <option value="">
                                </option>
                                @foreach ($satuanBeli as $sb)
                                    <option value="{{ $sb->fm_nm_satuan }}">
                                        {{ $sb->fm_nm_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Isi Satuan Pembelian | Satuan: <input style="border:none"
                                    type="text" id="eisiSatuanBeli" class="eisiSatuanBeli text-danger text-bold col-4"
                                    readonly>
                            </label>
                            <input type="text" class="efm_isi_satuan_pembelian form-control"
                                name="efm_isi_satuan_pembelian" id="efm_isi_satuan_pembelian" value=""
                                placeholder="Input Isi Satuan Pembelian">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Satuan Jual</label>
                            <select class="efm_satuan_jual form-control" id="efm_satuan_jual" style="width: 100%;"
                                name="efm_satuan_jual">
                                <option value=""></option>
                                @foreach ($satuanBeli as $sb)
                                    <option value="{{ $sb->fm_nm_satuan }}">
                                        {{ $sb->fm_nm_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Harga Beli Per <input style="border:none" type="text"
                                    id="ehrgBeliPer" class="ehrgBeliPer text-danger text-bold" readonly></label>
                            <input type="text" class="efm_hrg_beli autocurrency form-control" name="efm_hrg_beli"
                                id="efm_hrg_beli" value="" placeholder="HNA+PPN">
                            <div class="">
                                <label for="">Hrga Beli Per<input style="border:none" type="text"
                                        id="ehrgBeliPerDetail" class="ehrgBeliPerDetail text-danger text-bold col-4"
                                        readonly>
                                </label>
                                <input type="text" class="efm_hrg_beli_detail form-control" name="efm_hrg_beli_detail"
                                    id="efm_hrg_beli_detail" value="" placeholder="Input Isi Satuan Pembelian">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group form-inline col-6">
                            <div class="row ">
                                <div class="col-5">
                                    <label for="">Non-Resep (Rp.)</label>
                                    <input type="text" class="efm_hrg_jual_non_resep autocurrency form-control"
                                        name="efm_hrg_jual_non_resep" id="efm_hrg_jual_non_resep" value=""
                                        placeholder=" Reguler / Non-Resep">
                                </div>
                                <div class="col-5">
                                    <label for="">Non-Resep (%)</label>
                                    <input type="text" class="efm_hrg_jual_non_resep_persen autocurrency form-control"
                                        name="efm_hrg_jual_non_resep_persen" id="efm_hrg_jual_non_resep_persen"
                                        value="" placeholder=" Reguler / Non-Resep">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-inline col-6">
                            <div class="row ">
                                <div class="col-5">
                                    <label for="">Hrg Resep (Rp.)</label>
                                    <input type="text" class="autocurrency efm_hrg_jual_resep form-control"
                                        name="efm_hrg_jual_resep" id="efm_hrg_jual_resep" value=""
                                        placeholder="Resep">
                                </div>
                                <div class="col-5">
                                    <label for="">Hrg Resep (%)</label>
                                    <input type="text" class="autocurrency efm_hrg_jual_resep_persen form-control"
                                        name="efm_hrg_jual_resep_persen" id="efm_hrg_jual_resep_persen" value=""
                                        placeholder="Resep">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-inline col-6">
                            <div class="row ">
                                <div class="col-5">
                                    <label for="">Hrg Nakes</label>
                                    <input type="text" class="autocurrency efm_hrg_jual_nakes form-control"
                                        name="efm_hrg_jual_nakes" id="efm_hrg_jual_nakes" value=""
                                        placeholder="Nakes">
                                </div>
                                <div class="col-5">
                                    <label for="">Hrg Nakes</label>
                                    <input type="text" class="autocurrency efm_hrg_jual_nake_persens form-control"
                                        name="efm_hrg_jual_nakes_persen" id="efm_hrg_jual_nakes_persen" value=""
                                        placeholder="Nakes">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-checkbox col-md ml-3">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="eisActive" name="eisActive">
                                <label for="eisActive" class="custom-control-label">Aktif</label>
                            </div>
                            <div class="custom-control custom-checkbox col-md ml-3">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="eisOpenPrice" name="eisOpenPrice" value="1">
                                <label for="isOpenPrice" class="custom-control-label">Open
                                    Price</label>
                            </div>
                        </div>
                        <input type="hidden" id="euser" name="user" value="tes">
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="" class=""></button> --}}
                        <button type="button" id="editXObat" class="btn btn-success float-right"><i
                                class="fa fa-save"></i>
                            &nbsp;
                            Update</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End Modal --}}

    <!-- The modal Create -->
    <div class="modal fade" id="TambahObat">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang / Obat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Kode Obat</label>
                            <input type="text" class="form-control" name="fm_kd_obat" id="fm_kd_obat" readonly
                                value="{{ $kd_obat }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Obat</label>
                            <input type="text" class="form-control" name="fm_nm_obat" id="fm_nm_obat" value=""
                                placeholder="Input Nama Obat" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Kategori</label>
                            <select class="fm_kategori form-control-pasien" id="fm_kategori" style="width: 100%;"
                                name="fm_kategori" required>
                                <option value="">--Select--</option>
                                @foreach ($kategori as $kt)
                                    <option value="{{ $kt->fm_nm_kategori_produk }}">{{ $kt->fm_nm_kategori_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Golongan</label>
                            <select class="fm_golongan_obat form-control" id="fm_golongan_obat" style="width: 100%;"
                                name="fm_golongan_obat">
                                <option value=""></option>
                                @foreach ($golongan as $gol)
                                    <option value="{{ $gol->fm_nm_jenis_obat }}">
                                        {{ $gol->fm_nm_jenis_obat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Supplier</label>
                            <select class="fm_supplier form-control-pasien" id="fm_supplier" style="width: 100%;"
                                name="fm_supplier" required>
                                <option value="">--Select--</option>
                                @foreach ($supplier as $sp)
                                    <option value="{{ $sp->fm_nm_supplier }}">{{ $sp->fm_nm_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Satuan Pembelian</label>
                            <select class="fm_satuan_pembelian form-control-pasien" id="fm_satuan_pembelian"
                                style="width: 100%;" name="fm_satuan_pembelian" required>
                                <option value="">--Select--</option>
                                @foreach ($satuanBeli as $sb)
                                    <option value="{{ $sb->fm_nm_satuan }}">{{ $sb->fm_nm_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Isi Satuan Pembelian | Satuan :<input style="border:none"
                                    type="text" id="isiSatuanBeli" class="isiSatuanBeli text-danger text-bold col-4"
                                    readonly>
                            </label>
                            <input type="text" class="fm_isi_satuan_pembelian form-control"
                                name="fm_isi_satuan_pembelian" id="fm_isi_satuan_pembelian" value=""
                                placeholder="Input Isi Satuan Pembelian" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Satuan Jual</label>
                            <select class="fm_satuan_jual form-control-pasien" id="fm_satuan_jual" style="width: 100%;"
                                name="fm_satuan_jual">
                                <option value="">--Select--</option>
                                @foreach ($satuanBeli as $sb)
                                    <option value="{{ $sb->fm_nm_satuan }}">{{ $sb->fm_nm_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Harga Beli Per <input style="border:none" type="text"
                                    id="hrgBeliPer" class="hrgBeliPer text-danger text-bold" readonly></label>
                            <input type="text" class="fm_hrg_beli autocurrency form-control" name="fm_hrg_beli"
                                id="fm_hrg_beli" value="" placeholder="HNA+PPN">
                            <div class="">
                                <label for="">Hrga Beli Per<input style="border:none" type="text"
                                        id="hrgBeliPerDetail" class="hrgBeliPerDetail text-danger text-bold col-4"
                                        readonly>
                                </label>
                                <input type="text" class="fm_hrg_beli_detail form-control" name="fm_hrg_beli_detail"
                                    id="fm_hrg_beli_detail" value="" placeholder="Input Isi Satuan Pembelian">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group form-inline col-6">
                            <div class="row ">
                                <div class="col-5">
                                    <label for="">Non-Resep (Rp.)</label>
                                    <input type="text" class="fm_hrg_jual_non_resep autocurrency form-control"
                                        name="fm_hrg_jual_non_resep" id="fm_hrg_jual_non_resep" value=""
                                        placeholder=" Reguler / Non-Resep">
                                </div>
                                <div class="col-5">
                                    <label for="">Non-Resep (%)</label>
                                    <input type="text" class="fm_hrg_jual_non_resep_persen autocurrency form-control"
                                        name="fm_hrg_jual_non_resep_persen" id="fm_hrg_jual_non_resep_persen"
                                        value="" placeholder=" Reguler / Non-Resep">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-inline col-6">
                            <div class="row ">
                                <div class="col-5">
                                    <label for="">Hrg Resep (Rp.)</label>
                                    <input type="text" class="autocurrency fm_hrg_jual_resep form-control"
                                        name="fm_hrg_jual_resep" id="fm_hrg_jual_resep" value=""
                                        placeholder="Resep">
                                </div>
                                <div class="col-5">
                                    <label for="">Hrg Resep (%)</label>
                                    <input type="text" class="autocurrency fm_hrg_jual_resep_persen form-control"
                                        name="fm_hrg_jual_resep_persen" id="fm_hrg_jual_resep_persen" value=""
                                        placeholder="Resep">
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-inline col-6">
                            <div class="row ">
                                <div class="col-5">
                                    <label for="">Hrg Nakes (Rp.)</label>
                                    <input type="text" class="autocurrency fm_hrg_jual_nakes form-control"
                                        name="fm_hrg_jual_nakes" id="fm_hrg_jual_nakes" value=""
                                        placeholder="Nakes">
                                </div>
                                <div class="col-5">
                                    <label for="">Hrg Nakes (%)</label>
                                    <input type="text" class="autocurrency fm_hrg_jual_nake_persens form-control"
                                        name="fm_hrg_jual_nakes_persen" id="fm_hrg_jual_nakes_persen" value=""
                                        placeholder="Nakes">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-checkbox col-md ml-3">
                                {{-- <input type="hidden" value="0" id="isActive[0]" name="isActive[0]"> --}}
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="isActive" name="isActive">
                                <label for="isActive" class="custom-control-label">Aktif</label>
                            </div>
                            <div class="custom-control custom-checkbox col-md ml-3">
                                {{-- <input type="hidden" value="0" id="isOpenPrice[0]" name="isOpenPrice"> --}}
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="isOpenPrice" name="isOpenPrice" value="1">
                                <label for="isOpenPrice" class="custom-control-label">Open Price</label>
                            </div>
                        </div>
                        <input type="hidden" id="user" name="user" value="tes">
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="" class=""></button> --}}
                        <button type="button" id="buat" class="btn btn-success float-right"><i
                                class="fa fa-save"></i>
                            &nbsp;
                            Save</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- The modal Delete -->
        <div class="modal fade" id="DeleteSupplier">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            {{-- Hapus data Supplier : <b> {{ $tz->fm_nm_obat }} </b> ? --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <form class="d-inline" action="{{ url('destroy-mstr-', [$tz->fm_kd_obat]) }}" method="POST"> --}}
                        @csrf
                        <input type="hidden" value="DELETE" name="_method">
                        <button type="submit" id="Delete" value="Delete" class="btn btn-danger float-right">
                            <i class="fa fa-trash"></i>
                        </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            // Select2 call
            $('#fm_supplier').select2({
                placeholder: 'Supplier',
            });

            $('#fm_kategori').select2({
                placeholder: 'Kategori Produk',
            });

            $('#fm_golongan_obat').select2({
                placeholder: 'Golongan Obat',
            });

            $('#efm_golongan_obat').select2({
                placeholder: 'Golongan Obat',
            });

            $('#fm_satuan_pembelian').select2({
                placeholder: 'Satuan Pembelian Produk',
            });

            $('#fm_satuan_jual').select2({
                placeholder: 'Satuan Jual Terkecil',
            });

            // Select2 call Edit
            $('#efm_supplier').select2({
                placeholder: 'Supplier',
            });

            $('#efm_kategori').select2({
                placeholder: 'Kategori Produk',
            });

            $('#efm_satuan_pembelian').select2({
                placeholder: 'Satuan Pembelian Produk',
            });

            $('#efm_satuan_jual').select2({
                placeholder: 'Satuan Jual Terkecil',
            });

            // Custom Harga Beli Perxxx create
            $(document).ready(function() {
                $('#fm_satuan_pembelian').on('change', function() {
                    var sat_beli = $(this).val();
                    // alert(sat_beli);
                    if (sat_beli) {
                        $('#hrgBeliPer').val(sat_beli);
                    }
                });

            });

            // Custom Isi Satuan Pembelian
            $(document).ready(function() {
                $('#fm_satuan_jual').on('change', function() {
                    var sat_jual = $(this).val();
                    // alert(sat_jual);
                    if (sat_jual) {
                        $('#isiSatuanBeli').val(sat_jual);
                        $('#hrgBeliPerDetail').val(sat_jual);
                    }
                });
            });


            // Custom Harga Beli Perxxx Edit
            $(document).ready(function() {
                $('#efm_satuan_pembelian').on('change', function() {
                    var sat_beli = $(this).val();
                    // alert(sat_beli);
                    if (sat_beli) {
                        $('#ehrgBeliPer').val(sat_beli);
                    }
                });

            });

            // Custom Isi Satuan Pembelian Edit
            $(document).ready(function() {
                $('#efm_satuan_jual').on('change', function() {
                    var sat_jual = $(this).val();
                    // alert(sat_jual);
                    if (sat_jual) {
                        $('#eisiSatuanBeli').val(sat_jual);
                        $('#ehrgBeliPerDetail').val(sat_jual);
                    }
                });
            });

            $('#fm_hrg_jual_non_resep_persen').on('input', function() {
                // alert('gogogo')
                hrgPersen();

                function hrgPersen() {
                    var hrg_reg = $('#fm_hrg_jual_non_resep_persen').val();
                    var hrg_beli = $('#fm_hrg_beli_detail').val();
                    var hrg_regInt = parseInt(hrg_reg.replace(/,.*|[^0-9]/g, ''));
                    var calc = (hrg_regInt / 100) * hrg_beli;
                    var result = calc.toFixed(2);
                    var ttl = parseInt(hrg_beli) + parseInt(result);

                    $('#fm_hrg_jual_non_resep').val(ttl);
                }
            });

            $('#fm_hrg_jual_non_resep').on('input', function() {
                // alert('gogogo')
                hrgRp();

                function hrgRp() {
                    var hrg_reg = $('#fm_hrg_jual_non_resep').val();
                    var hrg_beli = $('#fm_hrg_beli_detail').val();
                    var pengurangan = (hrg_reg - hrg_beli);
                    var calc = (pengurangan / hrg_beli) * 100;
                    var result = calc.toFixed(2);

                    $('#fm_hrg_jual_non_resep_persen').val(result);
                }
            });

            // Resep
            $('#fm_hrg_jual_resep_persen').on('input', function() {
                // alert('gogogo')
                hrgPersen();

                function hrgPersen() {
                    var hrg_reg = $('#fm_hrg_jual_resep_persen').val();
                    var hrg_beli = $('#fm_hrg_beli_detail').val();
                    var hrg_regInt = parseInt(hrg_reg.replace(/,.*|[^0-9]/g, ''));
                    var calc = (hrg_regInt / 100) * hrg_beli;
                    var result = calc.toFixed(2);
                    var ttl = parseInt(hrg_beli) + parseInt(result);

                    $('#fm_hrg_jual_resep').val(ttl);
                }
            });

            $('#fm_hrg_jual_resep').on('input', function() {
                // alert('gogogo')
                hrgRp();

                function hrgRp() {
                    var hrg_reg = $('#fm_hrg_jual_resep').val();
                    var hrg_beli = $('#fm_hrg_beli_detail').val();
                    var pengurangan = (hrg_reg - hrg_beli);
                    var calc = (pengurangan / hrg_beli) * 100;
                    var result = calc.toFixed(2);
                    $('#fm_hrg_jual_resep_persen').val(result);
                }
            });

            // Nakes
            $('#fm_hrg_jual_nakes_persen').on('input', function() {
                // alert('gogogo')
                hrgPersen();

                function hrgPersen() {
                    var hrg_reg = $('#fm_hrg_jual_nakes_persen').val();
                    var hrg_beli = $('#fm_hrg_beli_detail').val();
                    var calc = (hrg_reg / 100) * hrg_beli;
                    var result = calc.toFixed(2);
                    var ttl = parseInt(hrg_beli) + parseInt(result);
                    $('#fm_hrg_jual_nakes').val(ttl);
                }
            });

            $('#fm_hrg_jual_nakes').on('input', function() {
                // alert('gogogo')
                hrgRp();

                function hrgRp() {
                    var hrg_reg = $('#fm_hrg_jual_nakes').val();
                    var hrg_beli = $('#fm_hrg_beli_detail').val();
                    var pengurangan = (hrg_reg - hrg_beli);
                    // if (event.keyCode == 13) {
                    var calc = (pengurangan / hrg_beli) * 100;
                    var result = calc.toFixed(2);

                    $('#fm_hrg_jual_nakes_persen').val(result);
                }
            });


            // HARGA JUAL EDIT
            $('#efm_hrg_jual_non_resep_persen').on('input', function() {
                // alert('gogogo')
                hrgPersen();

                function hrgPersen() {
                    var hrg_reg = $('#efm_hrg_jual_non_resep_persen').val();
                    var hrg_beli = $('#efm_hrg_beli_detail').val();
                    var hrg_regInt = parseInt(hrg_reg.replace(/,.*|[^0-9]/g, ''));
                    var calc = (hrg_regInt / 100) * hrg_beli;
                    var result = calc.toFixed(2);
                    var ttl = parseInt(hrg_beli) + parseInt(result);

                    $('#efm_hrg_jual_non_resep').val(ttl);
                }
            });

            $('#efm_hrg_jual_non_resep').on('input', function() {
                // alert('gogogo')
                hrgRp();

                function hrgRp() {
                    var hrg_reg = $('#efm_hrg_jual_non_resep').val();
                    var hrg_beli = $('#efm_hrg_beli_detail').val();
                    var pengurangan = (hrg_reg - hrg_beli);
                    var calc = (pengurangan / hrg_beli) * 100;
                    var result = calc.toFixed(2);

                    $('#efm_hrg_jual_non_resep_persen').val(result);
                }
            });

            // Resep
            $('#efm_hrg_jual_resep_persen').on('input', function() {
                // alert('gogogo')
                hrgPersen();

                function hrgPersen() {
                    var hrg_reg = $('#efm_hrg_jual_resep_persen').val();
                    var hrg_beli = $('#efm_hrg_beli_detail').val();
                    var hrg_regInt = parseInt(hrg_reg.replace(/,.*|[^0-9]/g, ''));
                    var calc = (hrg_regInt / 100) * hrg_beli;
                    var result = calc.toFixed(2);
                    var ttl = parseInt(hrg_beli) + parseInt(result);

                    $('#efm_hrg_jual_resep').val(ttl);
                }
            });

            $('#efm_hrg_jual_resep').on('input', function() {
                // alert('gogogo')
                hrgRp();

                function hrgRp() {
                    var hrg_reg = $('#efm_hrg_jual_resep').val();
                    var hrg_beli = $('#efm_hrg_beli_detail').val();
                    var pengurangan = (hrg_reg - hrg_beli);
                    var calc = (pengurangan / hrg_beli) * 100;
                    var result = calc.toFixed(2);
                    $('#efm_hrg_jual_resep_persen').val(result);
                }
            });

            // Nakes
            $('#efm_hrg_jual_nakes_persen').on('input', function() {
                // alert('gogogo')
                hrgPersen();

                function hrgPersen() {
                    var hrg_reg = $('#efm_hrg_jual_nakes_persen').val();
                    var hrg_beli = $('#efm_hrg_beli_detail').val();
                    var calc = (hrg_reg / 100) * hrg_beli;
                    var result = calc.toFixed(2);
                    var ttl = parseInt(hrg_beli) + parseInt(result);
                    $('#efm_hrg_jual_nakes').val(ttl);
                }
            });

            $('#efm_hrg_jual_nakes').on('input', function() {
                // alert('gogogo')
                hrgRp();

                function hrgRp() {
                    var hrg_reg = $('#efm_hrg_jual_nakes').val();
                    var hrg_beli = $('#efm_hrg_beli_detail').val();
                    var pengurangan = (hrg_reg - hrg_beli);
                    // if (event.keyCode == 13) {
                    var calc = (pengurangan / hrg_beli) * 100;
                    var result = calc.toFixed(2);

                    $('#efm_hrg_jual_nakes_persen').val(result);
                }
            });


            function delObat(dx) {
                var ids = $(dx).data('id');
                var obatName = $(dx).data('nmobat');

                $('#deleteModalObat').modal('show');
                $('#obatNameToDel').text(obatName)
                $('#kd_obat_del').val(ids)
            }

            function execDelObat() {
                var kd_obat = $('#kd_obat_del').val()

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('deleteObat') }}/" + kd_obat,
                    type: "POST",
                    data: {
                        fm_kd_obat: kd_obat,
                    },

                    success: function(response) {
                        if (response.success) {
                            toastr.success('Saved!', `${response.message}`, {
                                timeOut: 2000,
                                preventDuplicates: true,
                                positionClass: 'toast-top-right',
                            });
                            return window.location.href = "{{ url('mstr-obat') }}";
                        } else {
                            toastr.error('Saved!', 'Error!', {
                                timeOut: 2000,
                                preventDuplicates: true,
                                positionClass: 'toast-top-right',
                            });
                        }
                        // error: function(xhr, status, error) {
                        //     toastr.success('Saved!', status, {
                        //         timeOut: 2000,
                        //         preventDuplicates: true,
                        //         positionClass: 'toast-top-right',
                        //     });
                        // },
                    }

                });
            }
            // modal Edit
            function getIDObat(tx) {
                var ids = $(tx).data('id');
                var nmobat = $(tx).data('nmobat');
                var kategori = $(tx).data('kategori');
                var golongan = $(tx).data('golongan');
                var supplier = $(tx).data('supplier');
                var satBeli = $(tx).data('satuan_pembelian');
                var satJual = $(tx).data('satuan_penjualan');
                var isiSatuanBeli = $(tx).data('isi_sat_beli');
                var isistbeli = $(tx).data('isi_satuan_beli');
                var hrgBeliPer1 = $(tx).data('hrg_beli_per1');
                var hrgBeliPer2 = $(tx).data('hrg_beli_per2');
                var hrgBeliTerbesar = $(tx).data('hrg_beli_terbesar');
                var hrgBeliTerkecil = $(tx).data('hrg_beli_terkecil');
                var hrgJualReg = $(tx).data('hrg_jual_reg');
                var hrgJualResep = $(tx).data('hrg_jual_resep');
                var hrgJualNakes = $(tx).data('hrg_jual_nakes');
                var isActive = $(tx).data('isactive');

                if (isActive == 1) {
                    $('#eisActive').attr("checked", "checked");
                }

                var hrgJualRegPersen = $(tx).data('hrg_jual_reg_persen');
                var hrgJualResepPersen = $(tx).data('hrg_jual_resep_persen');
                var hrgJualNakesPersen = $(tx).data('hrg_jual_nakes_persen');

                // alert(ids);
                $('#EditObatModal').modal('show');
                $('#efm_kd_obat').val(ids);
                $('#efm_nm_obat').val(nmobat);
                $('#efm_kategori').append(`<option value="${kategori}" selected>${kategori}</option>`);
                $('#efm_kategori').append(`<option value="${golongan}" selected>${golongan}</option>`);
                $('#efm_supplier').append(`<option value="${supplier}" selected>${supplier}</option>`);
                $('#efm_satuan_pembelian').append(`<option value="${satBeli}" selected>${satBeli}</option>`);
                $('#efm_satuan_jual').append(`<option value="${satJual}" selected>${satJual}</option>`);
                $('#efm_isi_satuan_pembelian').val(isiSatuanBeli);
                $('#eisiSatuanBeli').val(isistbeli);
                $('#ehrgBeliPer').val(hrgBeliPer1);
                $('#ehrgBeliPerDetail').val(hrgBeliPer2);
                $('#efm_hrg_beli').val(hrgBeliTerbesar);
                $('#efm_hrg_beli_detail').val(hrgBeliTerkecil);
                $('#efm_hrg_jual_non_resep').val(hrgJualReg);
                $('#efm_hrg_jual_resep').val(hrgJualResep);
                $('#efm_hrg_jual_nakes').val(hrgJualNakes);

                $('#efm_hrg_jual_non_resep_persen').val(hrgJualRegPersen);
                $('#efm_hrg_jual_nakes_persen').val(hrgJualNakesPersen);
                $('#efm_hrg_jual_resep_persen').val(hrgJualResepPersen);
            };

            // Pembagian detail harga beli
            $(document).ready(function() {
                $('#fm_hrg_beli').on('keyup', function() {
                    var hrg_beli1 = $(this).val();
                    var hrg_beli2 = parseInt(hrg_beli1.replace(/,.*|[^0-9]/g, ''), 10);
                    var satuan_beli_terkecil = $('#fm_isi_satuan_pembelian').val();
                    var detail_hrg = (hrg_beli2 / satuan_beli_terkecil);
                    // console.log(detail_hrg);
                    if (detail_hrg) {
                        $('#fm_hrg_beli_detail').val(detail_hrg);
                    }
                });
            });

            // Pembagian detail harga beli Edit
            $(document).ready(function() {
                $('#efm_hrg_beli').on('keyup', function() {
                    var hrg_beli1 = $(this).val();
                    var hrg_beli2 = parseInt(hrg_beli1.replace(/,.*|[^0-9]/g, ''), 10);
                    var satuan_beli_terkecil = $('#efm_isi_satuan_pembelian').val();
                    var detail_hrg = (hrg_beli2 / satuan_beli_terkecil);
                    // console.log(detail_hrg);
                    if (detail_hrg) {
                        $('#efm_hrg_beli_detail').val(detail_hrg);
                    }
                });
            });

            // Auto Currency
            var rupiah1 = document.getElementById("fm_hrg_beli");
            rupiah1.addEventListener('keyup', function(e) {
                rupiah1.value = formatRupiah(this.value, 'Rp. ');
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah1 = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah1 += separator + ribuan.join('.');
                }

                rupiah1 = split[1] != undefined ? rupiah1 + ',' + split[1] : rupiah1;
                return prefix == undefined ? rupiah1 : (rupiah1 ? 'Rp. ' + rupiah1 : '');
            };

            // var rupiah2 = $("#fm_hrg_jual_non_resep").val();
            var rupiah2 = document.getElementById("fm_hrg_jual_non_resep");
            rupiah2.addEventListener('input', function(
                e) {
                rupiah2.value = formatRupiah(this.value);
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah2 = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah2 += separator + ribuan.join('.');
                }

                rupiah2 = split[1] != undefined ? rupiah1 + ',' + split[1] : rupiah2;
                return prefix == undefined ? rupiah2 : (rupiah2 ? 'Rp. ' + rupiah2 : '');
            }

            var rupiah3 = document.getElementById("fm_hrg_jual_resep");
            // var rupiah = document.getElementById('fm_hrg_jual_resep');
            rupiah3.addEventListener('keyup', function(e) {
                rupiah3.value = formatRupiah(this.value);
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah3 = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah3 += separator + ribuan.join('.');
                }

                rupiah3 = split[1] != undefined ? rupiah3 + ',' + split[1] : rupiah3;
                return prefix == undefined ? rupiah3 : (rupiah3 ? 'Rp. ' + rupiah3 : '');
            }

            var rupiah4 = document.getElementById("fm_hrg_jual_nakes");
            rupiah4.addEventListener('keyup', function(e) {
                rupiah4.value = formatRupiah(this.value);
                // rupiah4.value = formatRupiah(this.value, 'Rp. ');
            });

            /* Fungsi formatRupiah */
            function formatRupiah(angka, prefix) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah4 = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                // tambahkan titik jika yang di input sudah menjadi angka ribuan
                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah4 += separator + ribuan.join('.');
                }

                rupiah4 = split[1] != undefined ? rupiah4 + ',' + split[1] : rupiah4;
                return prefix == undefined ? rupiah4 : (rupiah4 ? 'Rp. ' + rupiah4 : '');
            }

            // $(document).ready(function() {
            //     $('#buat').on('click', function() {
            //         var fm_hrg_beli = $('#fm_hrg_beli').val();
            //         var show = parseInt(fm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
            //         alert(show);
            //     })
            // });

            // Create 
            $(document).ready(function() {
                $('#buat').on('click', function() {
                    var fm_kd_obat = $('#fm_kd_obat').val();
                    var fm_nm_obat = $('#fm_nm_obat').val();
                    var fm_kategori = $('#fm_kategori').val();
                    var fm_golongan_obat = $('#fm_golongan_obat').val();
                    var fm_supplier = $('#fm_supplier').val();
                    var fm_satuan_pembelian = $('#fm_satuan_pembelian').val();
                    var fm_isi_satuan_pembelian = $('#fm_isi_satuan_pembelian').val();
                    var fm_satuan_jual = $('#fm_satuan_jual').val();
                    var fm_hrg_beli = $('#fm_hrg_beli').val();
                    var fm_hrg_beli_detail = $('#fm_hrg_beli_detail').val();
                    var fm_hrg_jual_non_resep = $('#fm_hrg_jual_non_resep').val();
                    var fm_hrg_jual_resep = $('#fm_hrg_jual_resep').val();
                    var fm_hrg_jual_nakes = $('#fm_hrg_jual_nakes').val();
                    var st_isi_pembelian = $('#isiSatuanBeli').val();
                    var st_hrg_beli_per1 = $('#hrgBeliPer').val();
                    var st_hrg_beli_per2 = $('#hrgBeliPerDetail').val();
                    var fm_hrg_jual_non_resep_persen = $('#fm_hrg_jual_non_resep_persen').val();
                    var fm_hrg_jual_resep_persen = $('#fm_hrg_jual_resep_persen').val();
                    var fm_hrg_jual_nakes_persen = $('#fm_hrg_jual_nakes_persen').val();
                    if (document.getElementById('isActive').checked) {
                        var isActive = 1;
                    } else {
                        var isActive = 0;
                    }

                    if (document.getElementById('isOpenPrice').checked) {
                        var isOpenPrice = 1;
                    } else {
                        var isOpenPrice = 0;
                    }

                    var user = $('#user').val();

                    // ubah currency ke int
                    var sfm_hrg_beli = parseInt(fm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
                    // var sfm_hrg_beli = parseInt(fm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
                    var sfm_hrg_jual_non_resep = parseInt(fm_hrg_jual_non_resep.replace(
                            /,.*|[^0-9]/g, ''),
                        10);
                    var sfm_hrg_jual_resep = parseInt(fm_hrg_jual_resep.replace(/,.*|[^0-9]/g, ''),
                        10);
                    var sfm_hrg_jual_nakes = parseInt(fm_hrg_jual_nakes.replace(/,.*|[^0-9]/g, ''),
                        10);

                    if (fm_nm_obat != "") {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('add-mstr-obat') }}",
                            type: "POST",
                            data: {
                                type: 2,
                                fm_kd_obat: fm_kd_obat,
                                fm_nm_obat: fm_nm_obat,
                                fm_kategori: fm_kategori,
                                fm_supplier: fm_supplier,
                                fm_golongan_obat: fm_golongan_obat,
                                fm_satuan_pembelian: fm_satuan_pembelian,
                                fm_isi_satuan_pembelian: fm_isi_satuan_pembelian,
                                fm_hrg_beli: sfm_hrg_beli,
                                fm_hrg_beli_detail: fm_hrg_beli_detail,
                                fm_satuan_jual: fm_satuan_jual,
                                fm_hrg_jual_non_resep: sfm_hrg_jual_non_resep,
                                fm_hrg_jual_resep: sfm_hrg_jual_resep,
                                fm_hrg_jual_nakes: sfm_hrg_jual_nakes,
                                st_isi_pembelian: st_isi_pembelian,
                                st_hrg_beli_per1: st_hrg_beli_per1,
                                st_hrg_beli_per2: st_hrg_beli_per2,
                                fm_hrg_jual_non_resep_persen: fm_hrg_jual_non_resep_persen,
                                fm_hrg_jual_resep_persen: fm_hrg_jual_resep_persen,
                                fm_hrg_jual_nakes_persen: fm_hrg_jual_nakes_persen,
                                isActive: isActive,
                                isOpenPrice: isOpenPrice,
                                user: user
                            },
                            cache: false,
                            success: function(dataResult) {
                                // $('.close').click();
                                // document.getElementById("fm_nm_kategori_produk").value = "";
                                // toastr.success('Saved!', 'Your fun', {
                                //     timeOut: 2000,
                                //     preventDuplicates: true,
                                //     positionClass: 'toast-top-right',
                                // });
                                return window.location.href = "{{ url('mstr-obat') }}";
                                // return window.location.href = "{{ url('mstr-obat') }}";
                            }
                        });
                    } else {
                        toastr.info('Data Belum Lengkap', {
                            timeOut: 2000,
                            preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                    }
                });
            });

            // Edit
            $(document).ready(function() {
                $('#editXObat').on('click', function() {
                    var efm_kd_obat = $('#efm_kd_obat').val();
                    var efm_nm_obat = $('#efm_nm_obat').val();
                    var efm_kategori = $('#efm_kategori').val();
                    var efm_golongan_obat = $('#efm_golongan_obat').val();
                    var efm_supplier = $('#efm_supplier').val();
                    var efm_satuan_pembelian = $('#efm_satuan_pembelian').val();
                    var efm_isi_satuan_pembelian = $('#efm_isi_satuan_pembelian').val();
                    var efm_satuan_jual = $('#efm_satuan_jual').val();
                    var efm_hrg_beli = $('#efm_hrg_beli').val();
                    var efm_hrg_beli_detail = $('#efm_hrg_beli_detail').val();
                    var efm_hrg_jual_non_resep = $('#efm_hrg_jual_non_resep').val();
                    var efm_hrg_jual_resep = $('#efm_hrg_jual_resep').val();
                    var efm_hrg_jual_nakes = $('#efm_hrg_jual_nakes').val();
                    var est_isi_pembelian = $('#eisiSatuanBeli').val();
                    var est_hrg_beli_per1 = $('#ehrgBeliPer').val();
                    var est_hrg_beli_per2 = $('#ehrgBeliPerDetail').val();
                    var efm_hrg_jual_non_resep_persen = $('#efm_hrg_jual_non_resep_persen').val();
                    var efm_hrg_jual_resep_persen = $('#efm_hrg_jual_resep_persen').val();
                    var efm_hrg_jual_nakes_persen = $('#efm_hrg_jual_nakes_persen').val();
                    if (document.getElementById('eisActive').checked) {
                        var eisActive = '1';
                    } else {
                        var eisActive = '0';
                    }
                    var eisOpenPrice = $('#eisOpenPrice').val();
                    // var euser = $('#euser').val();

                    // ubah currency ke int
                    var esfm_hrg_beli = parseInt(efm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
                    // var sfm_hrg_beli = parseInt(fm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
                    var esfm_hrg_jual_non_resep = parseInt(efm_hrg_jual_non_resep.replace(
                            /,.*|[^0-9]/g, ''),
                        10);
                    var esfm_hrg_jual_resep = parseInt(efm_hrg_jual_resep.replace(/,.*|[^0-9]/g, ''),
                        10);
                    var esfm_hrg_jual_nakes = parseInt(efm_hrg_jual_nakes.replace(/,.*|[^0-9]/g, ''),
                        10);


                    var efmkdobat = $('#efm_kd_obat').val();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('edit-mstr-obat') }}/" + efmkdobat,
                        type: "POST",
                        data: {
                            fm_kd_obat: efm_kd_obat,
                            fm_nm_obat: efm_nm_obat,
                            fm_kategori: efm_kategori,
                            fm_golongan_obat: efm_golongan_obat,
                            fm_supplier: efm_supplier,
                            fm_satuan_pembelian: efm_satuan_pembelian,
                            fm_isi_satuan_pembelian: efm_isi_satuan_pembelian,
                            fm_hrg_beli: esfm_hrg_beli,
                            fm_hrg_beli_detail: efm_hrg_beli_detail,
                            fm_satuan_jual: efm_satuan_jual,
                            fm_hrg_jual_non_resep: esfm_hrg_jual_non_resep,
                            fm_hrg_jual_resep: esfm_hrg_jual_resep,
                            fm_hrg_jual_nakes: esfm_hrg_jual_nakes,
                            st_isi_pembelian: est_isi_pembelian,
                            st_hrg_beli_per1: est_hrg_beli_per1,
                            st_hrg_beli_per2: est_hrg_beli_per2,
                            fm_hrg_jual_non_resep_persen: efm_hrg_jual_non_resep_persen,
                            fm_hrg_jual_resep_persen: efm_hrg_jual_resep_persen,
                            fm_hrg_jual_nakes_persen: efm_hrg_jual_nakes_persen,
                            isActive: eisActive,
                            isOpenPrice: eisOpenPrice,
                            // user: euser
                        },

                        success: function(response) {
                            if (response.success) {
                                toastr.success('Saved!', `${response.message}`, {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                                return window.location.href = "{{ url('mstr-obat') }}";
                            } else {
                                toastr.error('Saved!', 'Error!', {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                            }
                            // error: function(xhr, status, error) {
                            //     toastr.success('Saved!', status, {
                            //         timeOut: 2000,
                            //         preventDuplicates: true,
                            //         positionClass: 'toast-top-right',
                            //     });
                            // },
                        }

                    });
                });
            });
        </script>
    @endpush
