@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahKategori">Tambah Kategori</button>
                <h3 class="card-title"></h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Kategori</th>
                                {{-- <th></th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($katprod as $tz)
                                {{-- <td id="">{{ $tz->fm_kd_jaminan }}</td> --}}
                                <td id="">{{ $tz->fm_nm_kategori_produk }}</td>
                                <td><button class="btn btn-xs btn-success"
                                        data-toggle="modal"data-target="#EditLayanan{{ $tz->id }}">Edit</button>
                                    <button class="btn btn-xs btn-danger">Hapus</button>
                                </td>

                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- The modal Create -->
    <div class="modal fade" id="TambahKategori">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <div class="form-group col-sm">
                        <label for="">Kode </label>
                        <input type="text" class="form-control" name="fm_kd_jenis_obat" id="fm_kd_jenis_obat"
                            value="">
                    </div> --}}
                    <div class="form-group col-sm">
                        <label for="">Kategori Produk</label>
                        <input type="text" class="form-control" name="fm_nm_kategori_produk" id="fm_nm_kategori_produk"
                            placeholder="Masukan Kategori Produk">
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="" class=""></button> --}}
                    <button type="button" id="buat" class="btn btn-success float-right"><i class="fa fa-save"></i>
                        &nbsp;
                        Save</button>
                </div>
            </div>
        </div>
    </div>
    @foreach ($katprod as $tz)
        <!-- The modal Create -->
        <div class="modal fade" id="EditLayanan{{ $tz->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Kategori</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-sm">
                            <label for="">Nama Kategori</label>
                            <input type="text" class="form-control" name="fm_nm_kategori_produk"
                                id="fm_nm_kategori_produk" value="{{ $tz->fm_nm_kategori_produk }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="" class=""></button> --}}
                        <button type="button" id="edits" class="btn btn-success float-right"><i class="fa fa-save"></i>
                            &nbsp;
                            Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- End Modal --}}
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#buat').on('click', function() {
                var fm_nm_kategori_produk = $('#fm_nm_kategori_produk').val();
                // alert(fm_nm_layanan);
                if (fm_nm_kategori_produk != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('add-mstr-kategori-produk') }}",
                        type: "POST",
                        data: {
                            type: 2,
                            fm_nm_kategori_produk: fm_nm_kategori_produk,
                        },
                        cache: false,
                        success: function(dataResult) {
                            // $('.close').click();
                            // document.getElementById("fm_nm_kategori_produk").value = "";
                            toastr.success('Saved!', 'Your fun', {
                                timeOut: 1000,
                                preventDuplicates: true,
                                positionClass: 'toast-top-right',
                            });
                            return window.location.href = "{{ url('mstr-kategori-produk') }}";
                        }
                    });
                } else {
                    alert('Please fill all the field !');
                }
            });
        });
    </script>
@endpush
