@extends('pages.master')

@section('konten')
    <div class="mb-4">
        <button type="button" class="btn btn-success mb-4 pull-right" data-toggle="modal"
            data-target="#TambahLayanan">Tambah</button>
    </div>
    {{-- <br>  --}}
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Master Layanan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="table1" class="table table-bordered table-hover">
                        <thead class="bg-success">
                            <tr>
                                <th>Kode Layanan</th>
                                <th>Layanan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td></td>
                            <td></td>
                            <td><button class="btn btn-xs btn-success">Edit</button>
                                <button class="btn btn-xs btn-danger">Hapus</button>
                            </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- The modal -->
    <div class="modal fade" id="TambahLayanan" aria-labelledby="modalLabelLarge" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-sm">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modalLabelLarge">Tambah Layanan</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm">
                        <label for="">Kode Layanan</label>
                        <input type="text" class="form-control" name="fm_kd_layanan" readonly value="">
                    </div>
                    <div class="form-group col-sm">
                        <label for="">Nama Layanan</label>
                        <input type="text" class="form-control" name="fm_nm_layanan" id="fm_nm_layanan"
                            placeholder="Nama Layanan">
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}
                    {{-- <form> --}}
                    {{-- <div class="col-sm-12"> --}}
                    <button type="submit" id="buat" class="btn btn-success"><i class="fa fa-save"></i> &nbsp;
                        Save</button>
                    {{-- </div> --}}
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

    <script>
        $(document).ready(function() {

            $('#buat').on('click', function() {
                // alert('tes');
                var fm_nm_layanan = $('#fm_nm_layanan').val();
                if (fm_nm_layanan != "") {
                    // alert(fm_nm_layanan);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('add-mstr-layanan') }}",
                        type: "POST",
                        data: {
                            type: 1,
                            fm_nm_layanan: fm_nm_layanan,
                        },
                        cache: false,
                        success: function(dataResult) {

                            $('.close').click();
                            document.getElementById("fm_nm_layanan").value = "";
                        }
                    });
                } else {
                    alert('Please fill all the field !');
                }
            });
        });
    </script>
@endpush
