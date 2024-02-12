@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahSupplier">Tambah Supplier</button>
                <h3 class="card-title">MSTR SUPPLIER</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Kode Supplier</th>
                                <th>Supplier</th>
                                <th>Email</th>
                                <th>No.Tlp</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Kode POS</th>
                                <th>NPWP</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $tz)
                                <td id="">{{ $tz->fm_kd_supplier }}</td>
                                <td id="">{{ $tz->fm_nm_supplier }}</td>
                                <td id="">{{ $tz->fm_email }}</td>
                                <td id="">{{ $tz->fm_no_tlp }}</td>
                                <td id="">{{ $tz->fm_alamat }}</td>
                                <td id="">{{ $tz->fm_kota }}</td>
                                <td id="">{{ $tz->fm_kd_pos }}</td>
                                <td id="">{{ $tz->fm_npwp }}</td>
                                <td><button class="btn btn-xs btn-success" data-toggle="modal"
                                        data-target="#EditSupplier{{ $tz->fm_kd_supplier }}">Edit</button>
                                    <button class="btn btn-xs btn-danger" data-toggle="modal"
                                        data-target="#DeleteSupplier{{ $tz->fm_kd_supplier }}">Hapus</button>
                                </td>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- The modal Create -->
    <div class="modal fade" id="TambahSupplier">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Kode Supplier</label>
                            <input type="text" class="form-control" name="fm_kd_supplier" id="fm_kd_supplier" readonly
                                value="{{ $kd_supplier }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Supplier</label>
                            <input type="text" class="form-control" name="fm_nm_supplier" id="fm_nm_supplier"
                                value="" placeholder="Input Nama Supplier" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="fm_email" id="fm_email" value=""
                                placeholder="Input Email">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">No. Telephone</label>
                            <input type="number" class="form-control" name="fm_no_tlp" id="fm_no_tlp" value=""
                                placeholder="Input Nomor Telephone">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Alamat</label>
                            <textarea class="form-control" name="fm_alamat" id="fm_alamat" value="" rows="2"></textarea>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Kota</label>
                            <input type="text" class="form-control" name="fm_kota" id="fm_kota" value=""
                                placeholder="Input Kota">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Kode POS</label>
                            <input type="text" class="form-control" name="fm_kd_pos" id="fm_kd_pos" value=""
                                placeholder="Input Kode POS">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">NPWP</label>
                            <input type="text" class="form-control" name="fm_npwp" id="fm_npwp" value=""
                                placeholder="NPWP">
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


            @foreach ($supplier as $tz)
                <!-- The modal Edit -->
                <div class="modal fade" id="EditSupplier{{ $tz->fm_kd_supplier }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit Satuan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group col-sm">
                                    <label for="">Nama Satuan</label>
                                    <input type="text" class="form-control" name="fm_nm_satuan" id="fm_nm_satuan"
                                        value="">
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="" class=""></button> --}}
                                <button type="button" id="edits" class="btn btn-success float-right"><i
                                        class="fa fa-save"></i>
                                    &nbsp;
                                    Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Modal --}}

                <!-- The modal Delete -->
                <div class="modal fade" id="DeleteSupplier{{ $tz->fm_kd_supplier }}">
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
                                    Hapus data Supplier : <b> {{ $tz->fm_nm_supplier }} </b> ?
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="" class=""></button> --}}
                                <form class="d-inline" action="{{ url('destroy-mstr-supplier', [$tz->fm_kd_supplier]) }}"
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
                $(document).ready(function() {
                    $('#buat').on('click', function() {
                        var fm_kd_supplier = $('#fm_kd_supplier').val();
                        var fm_nm_supplier = $('#fm_nm_supplier').val();
                        var fm_email = $('#fm_email').val();
                        var fm_no_tlp = $('#fm_no_tlp').val();
                        var fm_alamat = $('#fm_alamat').val();
                        var fm_kota = $('#fm_kota').val();
                        var fm_kd_pos = $('#fm_kd_pos').val();
                        var fm_npwp = $('#fm_npwp').val();
                        if (fm_nm_supplier != "") {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "{{ route('add-mstr-supplier') }}",
                                type: "POST",
                                data: {
                                    type: 2,
                                    fm_kd_supplier: fm_kd_supplier,
                                    fm_nm_supplier: fm_nm_supplier,
                                    fm_email: fm_email,
                                    fm_no_tlp: fm_no_tlp,
                                    fm_alamat: fm_alamat,
                                    fm_kota: fm_kota,
                                    fm_kd_pos: fm_kd_pos,
                                    fm_npwp: fm_npwp
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
                                    return window.location.href = "{{ url('mstr-supplier') }}";
                                }
                            });
                        } else {
                            alert('Please fill all the field !');
                        }
                    });
                });
            </script>
        @endpush
