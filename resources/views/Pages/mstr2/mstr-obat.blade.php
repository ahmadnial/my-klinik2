@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal" data-target="#TambahObat">Tambah
                    Obat</button>
                <h3 class="card-title">MSTR BARANG / OBAT</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Obat</th>
                                <th>Kategori</th>
                                <th>Supplier</th>
                                <th>Sat. Beli</th>
                                <th>Sat. Jual</th>
                                <th>Hrg Beli</th>
                                <th>Hrg Jual Non-resep</th>
                                <th>Hrg Jual Resep</th>
                                <th>Hrg Jual Nakes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($obatView as $tz)
                                <tr>
                                    <td id="">{{ $tz->fm_kd_obat }}</td>
                                    <td id="">{{ $tz->fm_nm_obat }}</td>
                                    <td id="">{{ $tz->fm_kategori }}</td>
                                    <td id="">{{ $tz->fm_supplier }}</td>
                                    <td id="">{{ $tz->fm_satuan_pembelian }}</td>
                                    <td id="">{{ $tz->fm_satuan_jual }}</td>
                                    <td id="">@currency($tz->fm_hrg_beli)</td>
                                    <td id="">@currency($tz->fm_hrg_jual_non_resep)</td>
                                    <td id="">@currency($tz->fm_hrg_jual_resep)</td>
                                    <td id="">@currency($tz->fm_hrg_jual_nakes)</td>
                                    <td><button class="btn btn-xs btn-success" data-toggle="modal"
                                            data-target="#EditObat{{ $tz->fm_kd_obat }}">Edit</button>
                                        <button class="btn btn-xs btn-danger" data-toggle="modal"
                                            data-target="#DeleteSupplier{{ $tz->fm_kd_supplier }}">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

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
                                placeholder="Input Nama Supplier">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Kategori</label>
                            <select class="form-control-pasien" id="fm_kategori" style="width: 100%;" name="fm_kategori">
                                <option value="">--Select--</option>
                                @foreach ($kategori as $kt)
                                    <option value="{{ $kt->fm_nm_kategori_produk }}">{{ $kt->fm_nm_kategori_produk }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Supplier</label>
                            <select class="form-control-pasien" id="fm_supplier" style="width: 100%;" name="fm_supplier">
                                <option value="">--Select--</option>
                                @foreach ($supplier as $sp)
                                    <option value="{{ $sp->fm_nm_supplier }}">{{ $sp->fm_nm_supplier }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Satuan Pembelian</label>
                            <select class="form-control-pasien" id="fm_satuan_pembelian" style="width: 100%;"
                                name="fm_satuan_pembelian">
                                <option value="">--Select--</option>
                                @foreach ($satuanBeli as $sb)
                                    <option value="{{ $sb->fm_nm_satuan }}">{{ $sb->fm_nm_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Isi Satuan Pembelian | Satuan :<input style="border:none" type="text"
                                    id="isiSatuanBeli" class="text-danger text-bold col-4" readonly> </label>
                            <input type="text" class="form-control" name="fm_isi_satuan_pembelian"
                                id="fm_isi_satuan_pembelian" value="" placeholder="Input Isi Satuan Pembelian">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Satuan Jual</label>
                            <select class="form-control-pasien" id="fm_satuan_jual" style="width: 100%;"
                                name="fm_satuan_jual">
                                <option value="">--Select--</option>
                                @foreach ($satuanBeli as $sb)
                                    <option value="{{ $sb->fm_nm_satuan }}">{{ $sb->fm_nm_satuan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Harga Beli Per <input style="border:none" type="text"
                                    id="hrgBeliPer" class="text-danger text-bold" readonly></label>
                            <input type="text" class="autocurrency form-control" name="fm_hrg_beli" id="fm_hrg_beli"
                                value="" placeholder="HNA+PPN">
                            <div class="">
                                <label for="">Hrga Beli Per<input style="border:none" type="text"
                                        id="hrgBeliPerDetail" class="text-danger text-bold col-4" readonly>
                                </label>
                                <input type="text" class="form-control" name="fm_hrg_beli_detail"
                                    id="fm_hrg_beli_detail" value="" placeholder="Input Isi Satuan Pembelian">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Harga Jual Non-Resep</label>
                            <input type="text" class="autocurrency form-control" name="fm_hrg_jual_non_resep"
                                id="fm_hrg_jual_non_resep" value=""
                                placeholder="Input Harga Jual Reguler / Non-Resep">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Harga Jual Resep</label>
                            <input type="text" class="autocurrency form-control" name="fm_hrg_jual_resep"
                                id="fm_hrg_jual_resep" value="" placeholder="Input Harga Jual Resep">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Harga Jual Nakes</label>
                            <input type="text" class="autocurrency form-control" name="fm_hrg_jual_nakes"
                                id="fm_hrg_jual_nakes" value="" placeholder="Input Harga Jual Nakes">
                        </div>
                        <div class="">
                            <div class="custom-control custom-checkbox col-md ml-3">
                                <input type="hidden" value="0" id="isActive[0]" name="isActive[0]">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="isActive" name="isActive" value="1">
                                <label for="isActive" class="custom-control-label">Aktif</label>
                            </div>
                            <div class="custom-control custom-checkbox col-md ml-3">
                                <input type="hidden" value="0" id="isOpenPrice[0]" name="isOpenPrice">
                                <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                    id="isOpenPrice[0]" name="isOpenPrice" value="1">
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


        <!-- The modal Edit -->
        @foreach ($obatView as $tz)
            <div class="modal fade" id="EditObat{{ $tz->fm_kd_obat }}">
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
                                    <input type="text" class="form-control" name="fm_kd_obat" id="fm_kd_obat"
                                        readonlyobat">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Obat</label>
                                    <input type="text" class="form-control" name="fm_nm_obat" id="fm_nm_obat"
                                        value="" placeholder="Input Nama Supplier">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Kategori</label>
                                    <select class="form-control-pasien" id="fm_kategori" style="width: 100%;"
                                        name="fm_kategori">
                                        <option value="">--Select--</option>
                                        @foreach ($kategori as $kt)
                                            <option value="{{ $kt->fm_nm_kategori_produk }}">
                                                {{ $kt->fm_nm_kategori_produk }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Supplier</label>
                                    <select class="form-control-pasien" id="fm_supplier" style="width: 100%;"
                                        name="fm_supplier">
                                        <option value="">--Select--</option>
                                        @foreach ($supplier as $sp)
                                            <option value="{{ $sp->fm_nm_supplier }}">{{ $sp->fm_nm_supplier }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Satuan Pembelian</label>
                                    <select class="form-control-pasien" id="fm_satuan_pembelian" style="width: 100%;"
                                        name="fm_satuan_pembelian">
                                        <option value="">--Select--</option>
                                        @foreach ($satuanBeli as $sb)
                                            <option value="{{ $sb->fm_nm_satuan }}">{{ $sb->fm_nm_satuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Isi Satuan Pembelian <input style="border:none" type="text"
                                            id="isiSatuanBeli" class="text-danger text-bold col-4" readonly> </label>
                                    <input type="text" class="form-control" name="fm_isi_satuan_pembelian"
                                        id="fm_isi_satuan_pembelian" value=""
                                        placeholder="Input Isi Satuan Pembelian">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Satuan Jual</label>
                                    <select class="form-control-pasien" id="fm_satuan_jual" style="width: 100%;"
                                        name="fm_satuan_jual">
                                        <option value="">--Select--</option>
                                        @foreach ($satuanBeli as $sb)
                                            <option value="{{ $sb->fm_nm_satuan }}">{{ $sb->fm_nm_satuan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Harga Beli Per <input style="border:none" type="text"
                                            id="hrgBeliPer" class="text-danger text-bold" readonly></label>
                                    <input type="text" class="autocurrency form-control" name="fm_hrg_beli"
                                        id="fm_hrg_beli" value="" placeholder="HNA+PPN">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="">Harga Jual Non-Resep</label>
                                    <input type="text" class="autocurrency form-control" name="fm_hrg_jual_non_resep"
                                        id="fm_hrg_jual_non_resep" value=""
                                        placeholder="Input Harga Jual Reguler / Non-Resep">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Harga Jual Resep</label>
                                    <input type="text" class="autocurrency form-control" name="fm_hrg_jual_resep"
                                        id="fm_hrg_jual_resep" value="" placeholder="Input Harga Jual Resep">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Harga Jual Nakes</label>
                                    <input type="text" class="autocurrency form-control" name="fm_hrg_jual_nakes"
                                        id="fm_hrg_jual_nakes" value="" placeholder="Input Harga Jual Nakes">
                                </div>
                                <div class="">
                                    <div class="custom-control custom-checkbox col-md ml-3">
                                        <input class="custom-control-input custom-control-input-danger" type="checkbox"
                                            id="isActive" name="isActive" value="1">
                                        <label for="isActive" class="custom-control-label">Aktif</label>
                                    </div>
                                    <div class="custom-control custom-checkbox col-md ml-3">
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
                {{-- End Modal --}}

                <!-- The modal Delete -->
                <div class="modal fade" id="DeleteSupplier{{ $tz->fm_kd_obat }}">
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
                                    Hapus data Supplier : <b> {{ $tz->fm_nm_obat }} </b> ?
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form class="d-inline" action="{{ url('destroy-mstr-supplier', [$tz->fm_kd_obat]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" value="DELETE" name="_method">
                                    <button type="submit" id="Delete" value="Delete"
                                        class="btn btn-danger float-right">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
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

            $('#fm_satuan_pembelian').select2({
                placeholder: 'Satuan Pembelian Produk',
            });

            $('#fm_satuan_jual').select2({
                placeholder: 'Satuan Jual Terkecil',
            });

            // Auto Currency
            var rupiah1 = document.getElementById("fm_hrg_beli");
            // var rupiah = document.getElementById('fm_hrg_jual_resep');
            rupiah1.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
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

            var rupiah2 = document.getElementById("fm_hrg_jual_non_resep");
            // var rupiah = document.getElementById('fm_hrg_jual_resep');
            rupiah2.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah2.value = formatRupiah(this.value, 'Rp. ');
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
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah3.value = formatRupiah(this.value, 'Rp. ');
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
            // var rupiah = document.getElementById('fm_hrg_jual_resep');
            rupiah4.addEventListener('keyup', function(e) {
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah4.value = formatRupiah(this.value, 'Rp. ');
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
                    var fm_supplier = $('#fm_supplier').val();
                    var fm_satuan_pembelian = $('#fm_satuan_pembelian').val();
                    var fm_isi_satuan_pembelian = $('#fm_isi_satuan_pembelian').val();
                    var fm_satuan_jual = $('#fm_satuan_jual').val();
                    var fm_hrg_beli = $('#fm_hrg_beli').val();
                    var fm_hrg_beli_detail = $('#fm_hrg_beli_detail').val();
                    var fm_hrg_jual_non_resep = $('#fm_hrg_jual_non_resep').val();
                    var fm_hrg_jual_resep = $('#fm_hrg_jual_resep').val();
                    var fm_hrg_jual_nakes = $('#fm_hrg_jual_nakes').val();
                    var isActive = $('#isActive').val();
                    var isOpenPrice = $('#isOpenPrice').val();
                    var user = $('#user').val();

                    // ubah currency ke string biasa
                    var sfm_hrg_beli = parseInt(fm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
                    // var sfm_hrg_beli = parseInt(fm_hrg_beli.replace(/,.*|[^0-9]/g, ''), 10);
                    var sfm_hrg_jual_non_resep = parseInt(fm_hrg_jual_non_resep.replace(/,.*|[^0-9]/g, ''), 10);
                    var sfm_hrg_jual_resep = parseInt(fm_hrg_jual_resep.replace(/,.*|[^0-9]/g, ''), 10);
                    var sfm_hrg_jual_nakes = parseInt(fm_hrg_jual_nakes.replace(/,.*|[^0-9]/g, ''), 10);

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
                                fm_satuan_pembelian: fm_satuan_pembelian,
                                fm_isi_satuan_pembelian: fm_isi_satuan_pembelian,
                                fm_hrg_beli: sfm_hrg_beli,
                                fm_hrg_beli_detail: fm_hrg_beli_detail,
                                fm_satuan_jual: fm_satuan_jual,
                                fm_hrg_jual_non_resep: sfm_hrg_jual_non_resep,
                                fm_hrg_jual_resep: sfm_hrg_jual_resep,
                                fm_hrg_jual_nakes: sfm_hrg_jual_nakes,
                                isActive: isActive,
                                isOpenPrice: isOpenPrice,
                                user: user
                            },
                            cache: false,
                            success: function(dataResult) {
                                // $('.close').click();
                                // document.getElementById("fm_nm_kategori_produk").value = "";
                                toastr.success('Saved!', 'Your fun', {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                                return window.location.href = "{{ url('mstr-obat') }}";
                            }
                        });
                    } else {
                        alert('Please fill all the field !');
                    }
                });
            });

            // Custom Harga Beli Perxxx
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
        </script>
    @endpush